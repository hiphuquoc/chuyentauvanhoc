<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Blog;
use App\Services\UrlService;
use App\Services\HtmlCacheService;
use App\Helpers\Url;
use App\Models\Redirect;

class RoutingController extends Controller {
    public function __construct(UrlService $UrlService, HtmlCacheService $htmlCacheService){
        $this->UrlService       = $UrlService;
        $this->htmlCacheService = $htmlCacheService;
    }

    public function routing($slug, $slug2 = null, $slug3 = null, $slug4 = null, $slug5 = null){
        $tmpSlug        = [$slug, $slug2, $slug3, $slug4, $slug5];
        // loại bỏ phần tử rỗng
        $arraySlug      = [];
        foreach($tmpSlug as $slug) if(!empty($slug)) $arraySlug[] = $slug;
        // handle redirects without querying in routes/web.php
        $fullPath       = implode('/', $arraySlug);
        $redirect       = Redirect::where('url_old', $fullPath)
                            ->orWhere('url_old', '/'.$fullPath)
                            ->first();
        if(!empty($redirect)) {
            return redirect()->to($redirect->url_new, 301);
        }
        // check url có tồn tại?
        $result         = $this->UrlService->checkUrlExists($arraySlug);
        if(!empty($result)){
            /* kiểm tra xem truy cập có đúng hoàn toàn url không */
            $url        = implode('/', $arraySlug);
            if($url==$result->seo_alias_full) {
                /* truy cập đúng => trả kết quả */
                if($result->type=='categories_info'){   // ====== CATEGORY =============================
                    $cacheOfPage            = request("page") ?? 0;
                    $nameCache              = self::buildNameCacheBySeoAlias($result->seo_alias_full).'-page-'.$cacheOfPage;
                    $xhtml = $this->htmlCacheService->getOrRender($nameCache, function () use ($result) {
                        $params             = [];
                        $params['paginate'] = 10;
                        $searchName         = request('search_name') ?? null;
                        $params['search_name']  = $searchName;
                        $info               = Category::select('*')
                                                ->where('page_id', $result->id)
                                                ->first();
                        $idCate             = $info->id;
                        $breadcrumb         = Url::buildArrayBreadcrumb($result);
                        $arrayCategoryId    = Category::getArrayCategoryChildById($info->id, $info->pages->id);
                        $list               = Blog::getListByArrayIdCategory($arrayCategoryId, $params);
                        $outstanding        = Blog::select('*')
                                                ->where('outstanding', 1)
                                                ->orderBy('id', 'DESC')
                                                ->skip(0)->take(7)
                                                ->get();
                        $category           = Category::getAllCategoryByTree();
                        return view('main.blog.list', compact('breadcrumb', 'list', 'info', 'category', 'outstanding', 'searchName'))->render();
                    }, $result->seo_alias !== 'tim-kiem');
                    echo $xhtml;
                }else if($result->type=='blogs_info'){ // ====== BLOG =============================
                    $nameCache              = self::buildNameCacheBySeoAlias($result->seo_alias_full);
                    $xhtml = $this->htmlCacheService->getOrRender($nameCache, function () use ($result) {
                        $info               = Blog::select('*')
                                                ->where('page_id', $result->id)
                                                ->first();
                        $idBlog             = $info->id;
                        $breadcrumb         = Url::buildArrayBreadcrumb($result);
                        $outstanding        = Blog::select('*')
                                                ->where('outstanding', 1)
                                                ->orderBy('id', 'DESC')
                                                ->skip(0)->take(7)
                                                ->get();
                        $category           = Category::getAllCategoryByTree();
                        $special            = Blog::getListSpecialById($idBlog);
                        $listCategory       = Category::getListCategoryByBlogId($idBlog);
                        $arrayCategoryId    = [];
                        foreach($listCategory as $item) $arrayCategoryId[]  = $item->id;
                        $params = ['arrayIdNot' => [$idBlog]];
                        foreach($special as $s) $params['arrayIdNot'][] = $s->id;
                        $related            = Blog::getListByArrayIdCategory($arrayCategoryId, $params);
                        return view('main.blog.detail', compact('breadcrumb', 'info', 'category', 'outstanding', 'special', 'related'))->render();
                    }, true);
                    echo $xhtml;
                }
            }else {
                /* truy cập sai parent => redirect về cho đúng */
                return redirect()->to('/'.$result->seo_alias_full);
            }
        }else {
            /* 404 */
            $xhtml = $this->htmlCacheService->getOrRender('404', function () {
                return view('main.error.404')->render();
            }, true);
            echo $xhtml;
        }
    }

    public static function buildNameCacheBySeoAlias($seoAlias){
        $result     = null;
        if(!empty($seoAlias)){
            $tmp    = explode('/', $seoAlias);
            $result = implode('-', $tmp);
        }
        return $result;
    }

}
