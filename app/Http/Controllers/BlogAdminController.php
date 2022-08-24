<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic;

use App\Models\Category;
use App\Models\RelationBlog;
use App\Models\Seo;
use App\Models\Blog;
use App\Models\RelationBlogCategory;

use App\Services\BuildModelService;
use App\Helpers\Upload;

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
        return view('admin.blog.list', compact('list', 'categories', 'params'));
    }

    public function viewEdit(Request $request, $id){
        if(!empty($id)){
            /* Category cho selectbox */
            $categoryAll    = Category::all();
            /* Thông tin blog */
            $item           = Blog::select('*')
                                ->where('id', $id)
                                ->with('pages', 'relationBlog')
                                ->first();
            /* Category của blog */
            $category               = [];
            if(!empty($item->id)) $category   = Category::getListCategoryByBlogId($item->id);
            $arrayIdCategory        = [];
            foreach($category as $cate) $arrayIdCategory[]  = $cate->id;
            $blogInCategory         = Blog::select('id', 'name')
                                        ->whereHas('category', function($query) use($item, $arrayIdCategory){
                                            $query->whereIn('category_info_id', $arrayIdCategory)
                                            ->where('blog_info_id', '!=', $item->id);
                                        })
                                        ->get();
            /* Type Edit - Copy */
            $type           = 'edit';
            if(!empty($request->get('type'))) $type = $request->get('type');
            if(!empty($item)) return view('admin.blog.view', compact('categoryAll', 'category', 'item', 'type', 'blogInCategory'));
        }
        return redirect()->route('admin.blog.list');
    }

    public function viewInsert(Request $request){
        $categoryAll        = Category::all();
        $type               = 'create';
        return view('admin.blog.view', compact('categoryAll', 'type'));
    }

    public function create(Request $request){
        /* upload image */
        $dataPath           = [];
        if($request->hasFile('image')) {
            $name           = !empty($request->get('seo_alias')) ? $request->get('seo_alias') : time();
            $dataPath       = Upload::uploadThumnail($request->file('image'), $name);
        }
        /* insert seo */
        $insertPage         = $this->BuildModelService->buildArrayInsertUpdateTablePages($request->all(), $dataPath);
        $pageId             = Seo::insertItem($insertPage);

        /* insert blog_info */
        $insertBlog         = $this->BuildModelService->buildArrayInsertUpdateTableBlogsInfo($request->all(), $pageId);
        $idBlog             = Blog::insertItem($insertBlog);

        /* insert relateion_blog_category */
        $insertRelation     = $this->BuildModelService->buildArrayInsertUpdateTableRelationBlogCategory($request->all(), $idBlog);
        if(!empty($insertRelation)) RelationBlogCategory::deleteAndInsertItem($insertRelation);

        /* Message */
        return redirect()->route('admin.blog.list');
    }

    public function update(Request $request){
        /* upload image */
        $dataPath           = [];
        if(!empty($request->file('image'))) {
            $name           = !empty($request->get('seo_alias')) ? $request->get('seo_alias') : time();
            $dataPath       = Upload::uploadThumnail($request->file('image'), $name);
        }
        /* update seo */
        $updatePage         = $this->BuildModelService->buildArrayInsertUpdateTablePages($request->all(), $dataPath);
        $flagUpdatePage     = Seo::updateItem($request->get('seo_id'), $updatePage);

        /* update blog_info */
        $updateBlog         = $this->BuildModelService->buildArrayInsertUpdateTableBlogsInfo($request->all());
        $flagUpdateBlog     = Blog::updateItem($request->get('id'), $updateBlog);

        /* update relation_blog */
        RelationBlog::select('*')
                    ->where('blog_info_id', $request->get('id'))
                    ->delete();
        if(!empty($request->get('relation_blog'))){
            foreach($request->get('relation_blog') as $relation){
                $insertRelationBlog = [
                    'blog_info_id'     => $request->get('id'),
                    'blog_relation_id'     => $relation,
                ];
                RelationBlog::insertItem($insertRelationBlog);
            }
        }

        /* update relateion_blog_category */
        $updateRelation     = $this->BuildModelService->buildArrayInsertUpdateTableRelationBlogCategory($request->all(), $request->get('id'));
        if(!empty($updateRelation)) RelationBlogCategory::deleteAndInsertItem($updateRelation);

        /* Message */
        return redirect()->route('admin.blog.viewEdit', ['id' => $request->get('id')]);
    }

}
