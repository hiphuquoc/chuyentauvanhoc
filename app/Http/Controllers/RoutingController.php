<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Blog;
use App\Services\UrlService;

use App\Helpers\Url;

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
        $checkExists    = $this->UrlService->checkUrlExists($arraySlug);
        if(!empty($checkExists)){
            /* Xử lý tiếp */
            $result     = $this->UrlService->checkUrlType($arraySlug);
            if($result['type']=='category'){   // ====== CATEGORY =============================
                $params             = [];
                $params['paginate'] = 10;
                $searchName         = request('search_name') ?? null;
                $params['search_name']  = $searchName;
                $idCate             = $result['info']->id;
                $info               = $result['info'] ?? [];
                $info               = Url::buildFullLinkOne($info);
                $type               = $result['type'];
                /* lấy thông tin breadcrumd */
                $breadcrumb         = Url::buildArrayBreadcrumb($info, $type);
                /* tạo mảng array category parent + child of child */
                $arrayCategoryId    = Category::getArrayCategoryChildById($idCate);
                /* Lấy danh sách blog */
                $list               = Blog::getListByArrayIdCategory($arrayCategoryId, $params);
                /* Lấy blog nổi bật */
                $outstanding        = Blog::getList(['outstanding' => 1]);
                /* Lấy danh sách category phân cấp theo tree */
                $category           = Category::getAllCategoryByTree();
                return view('main.blog.list', compact('breadcrumb', 'list', 'info', 'category', 'outstanding', 'searchName'));
            }else if($result['type']==='blog'){ // ====== BLOG =============================
                $idBlog             = $result['info']->id;
                $info               = $result['info'] ?? [];
                $info               = Url::buildFullLinkOne($info);
                $type               = $result['type'];
                /* lấy thông tin breadcrumd */
                $breadcrumb         = Url::buildArrayBreadcrumb($info, $type);
                /* Lấy blog nổi bật */
                $outstanding        = Blog::getList(['outstanding' => 1]);
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
                return view('main.blog.detail', compact('breadcrumb', 'info', 'category', 'outstanding', 'special', 'related'));
            }
        }else {
            /* Error 404 */
            // return view('main.error.404');

            // return view('main.blog.detail');
        }
    }

    

}
