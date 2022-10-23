<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Category;
use App\Models\RelationBlog;
use App\Models\Seo;
use App\Models\Blog;
use App\Models\RelationBlogCategory;

use App\Services\BuildModelService;
use App\Helpers\Upload;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BlogRequest;

class BlogAdminController extends Controller {

    public function __construct(BuildModelService $BuildModelService){
        $this->BuildModelService    = $BuildModelService;
    }

    public function list(Request $request){
        $params             = [];
        /* Search theo tên blog */
        if(!empty($request->get('search_name'))) $params['search_name'] = $request->get('search_name');
        /* Search theo category */
        if(!empty($request->get('search_category'))) $params['search_category'] = $request->get('search_category');
        $list               = Blog::getListAdmin($params);
        $categories         = Category::all();
        // dd($list->toArray());
        return view('admin.blog.list', compact('list', 'categories', 'params'));
    }

    public function view(Request $request){
        /* Category cho selectbox */
        $id                 = $request->get('id') ?? 0;
        $parents            = Category::select('*')
                                ->with('pages')
                                ->get();
        /* Thông tin blog */
        $item               = Blog::select('*')
                                ->where('id', $id)
                                ->with('pages', 'relationBlog')
                                ->first();
        /* Category của blog */
        $category           = [];
        if(!empty($item->id)) $category   = Category::getListCategoryByBlogId($item->id);
        $arrayIdCategory    = [];
        foreach($category as $cate) $arrayIdCategory[]  = $cate->id;
        $blogInCategory      = Blog::select('id', 'name')
                                ->whereHas('category', function($query) use($id, $arrayIdCategory){
                                    $query->whereIn('category_info_id', $arrayIdCategory)
                                    ->where('blog_info_id', '!=', $id);
                                })
                                ->get();
        /* type */
        $type               = !empty($item) ? 'edit' : 'create';
        $type               = $request->get('type') ?? $type;
        return view('admin.blog.view', compact('category', 'parents', 'item', 'type', 'blogInCategory'));
    }

    public function create(BlogRequest $request){
        try {
            DB::beginTransaction();
            /* upload image */
            $dataPath           = [];
            if($request->hasFile('image')) {
                $name           = !empty($request->get('seo_alias')) ? $request->get('seo_alias') : time();
                $dataPath       = Upload::uploadThumnail($request->file('image'), $name);
            }
            /* insert seo */
            $insertPage         = $this->BuildModelService->buildArrayInsertUpdateTablePages($request->all(), 'blogs_info', $dataPath);
            $pageId             = Seo::insertItem($insertPage);

            /* insert blog_info */
            $insertBlog         = $this->BuildModelService->buildArrayInsertUpdateTableBlogsInfo($request->all(), $pageId);
            $idBlog             = Blog::insertItem($insertBlog);

            /* insert relateion_blog_category */
            $insertRelation     = $this->BuildModelService->buildArrayInsertUpdateTableRelationBlogCategory($request->all(), $idBlog);
            if(!empty($insertRelation)) RelationBlogCategory::deleteAndInsertItem($insertRelation);

            DB::commit();
            /* Message */
            $message        = [
                'type'      => 'success',
                'message'   => '<strong>Thành công!</strong> Đã tạo bài viết mới'
            ];
        } catch (\Exception $exception){
            DB::rollBack();
            /* Message */
            $message        = [
                'type'      => 'danger',
                'message'   => '<strong>Thất bại!</strong> Có lỗi xảy ra, vui lòng thử lại'
            ];
        }
        $request->session()->put('message', $message);
        return redirect()->route('admin.blog.view', ['id' => $idBlog]);
    }

    public function update(BlogRequest $request){
        try {
            DB::beginTransaction();
            $idBlog             = $request->get('id');
            /* upload image */
            $dataPath           = [];
            if(!empty($request->file('image'))) {
                $name           = !empty($request->get('seo_alias')) ? $request->get('seo_alias') : time();
                $dataPath       = Upload::uploadThumnail($request->file('image'), $name);
            }
            /* update seo */
            $updatePage         = $this->BuildModelService->buildArrayInsertUpdateTablePages($request->all(), 'blogs_info', $dataPath);
            Seo::updateItem($request->get('seo_id'), $updatePage);

            /* update blog_info */
            $updateBlog         = $this->BuildModelService->buildArrayInsertUpdateTableBlogsInfo($request->all());
            Blog::updateItem($idBlog, $updateBlog);

            /* update relation_blog */
            RelationBlog::select('*')
                        ->where('blog_info_id', $idBlog)
                        ->delete();
            if(!empty($request->get('relation_blog'))){
                foreach($request->get('relation_blog') as $relation){
                    $insertRelationBlog = [
                        'blog_info_id'          => $idBlog,
                        'blog_relation_id'      => $relation,
                    ];
                    RelationBlog::insertItem($insertRelationBlog);
                }
            }

            /* update relateion_blog_category */
            $updateRelation     = $this->BuildModelService->buildArrayInsertUpdateTableRelationBlogCategory($request->all(), $request->get('id'));
            if(!empty($updateRelation)) RelationBlogCategory::deleteAndInsertItem($updateRelation);

            DB::commit();
            /* Message */
            $message        = [
                'type'      => 'success',
                'message'   => '<strong>Thành công!</strong> Các thay đổi đã được lưu'
            ];
        } catch (\Exception $exception){
            DB::rollBack();
            /* Message */
            $message        = [
                'type'      => 'danger',
                'message'   => '<strong>Thất bại!</strong> Có lỗi xảy ra, vui lòng thử lại'
            ];
        }
        $request->session()->put('message', $message);
        return redirect()->route('admin.blog.view', ['id' => $idBlog]);
    }

    public function delete(Request $request){
        if(!empty($request->get('id'))){
            try {
                DB::beginTransaction();
                $id         = $request->get('id');
                $info       = Blog::select('*')
                                ->where('id', $id)
                                ->with('pages')
                                ->first();
                /* delete bảng seo */
                Seo::find($info->pages->id)->delete();
                /* xóa ảnh đại diện trong thư mục */
                $imageSmallPath     = Storage::path(config('admin.images.folderUpload').basename($info->pages->image_small));
                if(file_exists($imageSmallPath)) @unlink($imageSmallPath);
                $imagePath          = Storage::path(config('admin.images.folderUpload').basename($info->pages->image));
                if(file_exists($imagePath)) @unlink($imagePath);
                /* xóa blog */
                $info->delete();
                DB::commit();
                return true;
            } catch (\Exception $exception){
                DB::rollBack();
                return false;
            }
        }
    }

}
