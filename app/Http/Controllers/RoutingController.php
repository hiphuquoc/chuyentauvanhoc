<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Blog;
use App\Services\UrlService;

use App\Helpers\Url;
use App\Models\Redirect;

class RoutingController extends Controller {
    public function __construct(UrlService $UrlService){
        $this->UrlService  = $UrlService;
    }

    public function routing($slug, $slug2 = null, $slug3 = null, $slug4 = null, $slug5 = null){
        $tmpSlug        = [$slug, $slug2, $slug3, $slug4, $slug5];
        // loại bỏ phần tử rỗng
        $arraySlug      = [];
        foreach($tmpSlug as $slug) if(!empty($slug)) $arraySlug[] = $slug;
        // check url có tồn tại?
        $result         = $this->UrlService->checkUrlExists($arraySlug);
        if(!empty($result)){
            /* kiểm tra xem truy cập có đúng hoàn toàn url không */
            $url        = implode('/', $arraySlug);
            if($url==$result->seo_alias_full) {
                /* truy cập đúng => trả kết quả */
                if($result->type=='categories_info'){   // ====== CATEGORY =============================
                    /* cache */
                    $cacheOfPage            = request("page") ?? 0;
                    $nameCache              = self::buildNameCacheBySeoAlias($result->seo_alias_full).'-page-'.$cacheOfPage.'.'.config('admin.cache.extension');
                    $pathCache              = Storage::path(config('admin.cache.folderSave')).$nameCache;
                    $cacheTime    	        = 1800;
                    if(file_exists($pathCache)&&$cacheTime>(time() - filectime($pathCache))){
                        $xhtml = file_get_contents($pathCache);
                    }else {
                        $params             = [];
                        $params['paginate'] = 10;
                        $searchName         = request('search_name') ?? null;
                        $params['search_name']  = $searchName;
                        $info               = Category::select('*')
                                                ->where('page_id', $result->id)
                                                ->first();
                        $idCate             = $info->id;
                        /* lấy thông tin breadcrumd */
                        $breadcrumb         = Url::buildArrayBreadcrumb($result);
                        /* tạo mảng array category parent + child of child */
                        $arrayCategoryId    = Category::getArrayCategoryChildById($info->id, $info->pages->id);
                        /* Lấy danh sách blog */
                        $list               = Blog::getListByArrayIdCategory($arrayCategoryId, $params);
                        /* Lấy blog nổi bật */
                        $outstanding        = Blog::select('*')
                                                ->where('outstanding', 1)
                                                ->orderBy('id', 'DESC')
                                                ->skip(0)->take(7)
                                                ->get();
                        /* Lấy danh sách category phân cấp theo tree */
                        $category           = Category::getAllCategoryByTree();
                        $xhtml              = view('main.blog.list', compact('breadcrumb', 'list', 'info', 'category', 'outstanding', 'searchName'))->render();
                        if($result->seo_alias!='tim-kiem') Storage::put(config('admin.cache.folderSave').$nameCache, $xhtml);
                    }
                    echo $xhtml;
                }else if($result->type=='blogs_info'){ // ====== BLOG =============================
                    /* cache */
                    $nameCache              = self::buildNameCacheBySeoAlias($result->seo_alias_full).'.'.config('admin.cache.extension');
                    $pathCache              = Storage::path(config('admin.cache.folderSave')).$nameCache;
                    $cacheTime    	        = 1800;
                    if(file_exists($pathCache)&&$cacheTime>(time() - filectime($pathCache))){
                        $xhtml = file_get_contents($pathCache);
                    }else {
                        $info               = Blog::select('*')
                                                ->where('page_id', $result->id)
                                                ->first();
                        $idBlog             = $info->id;
                        /* lấy thông tin breadcrumd */
                        $breadcrumb         = Url::buildArrayBreadcrumb($result);
                        /* Lấy blog nổi bật */
                        $outstanding        = Blog::select('*')
                                                ->where('outstanding', 1)
                                                ->orderBy('id', 'DESC')
                                                ->skip(0)->take(7)
                                                ->get();
                        /* Lấy danh sách category phân cấp theo tree */
                        $category           = Category::getAllCategoryByTree();
                        /* lấy bài viết liên quan đặc biệt */
                        $special            = Blog::getListSpecialById($idBlog);
                        /* lấy danh sách category của bài viết hiện tại */
                        $listCategory       = Category::getListCategoryByBlogId($idBlog);
                        $arrayCategoryId    = [];
                        foreach($listCategory as $item) $arrayCategoryId[]  = $item->id;
                        /* loại trừ blog hiện tại + blog special */
                        $params['arrayIdNot'][] = $idBlog;
                        foreach($special as $s) $params['arrayIdNot'][] = $s->id;
                        /* lấy bài viết liên quan */
                        $related            = Blog::getListByArrayIdCategory($arrayCategoryId, $params);
                        $xhtml              = view('main.blog.detail', compact('breadcrumb', 'info', 'category', 'outstanding', 'special', 'related'))->render();
                        Storage::put(config('admin.cache.folderSave').$nameCache, $xhtml);
                    }
                    echo $xhtml;
                }
            }else {
                /* truy cập sai parent => redirect về cho đúng */
                return redirect()->to('/'.$result->seo_alias_full);
            }
        }else {
            /* 404 */
            /* cache */
            $nameCache              = '404.'.config('admin.cache.extension');
            $pathCache              = Storage::path(config('admin.cache.folderSave')).$nameCache;
            $cacheTime    	        = 1800;
            if(file_exists($pathCache)&&$cacheTime>(time() - filectime($pathCache))){
                $xhtml              = file_get_contents($pathCache);
            }else {
                $xhtml              = view('main.error.404')->render();
                Storage::put(config('admin.cache.folderSave').$nameCache, $xhtml);
            }
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
