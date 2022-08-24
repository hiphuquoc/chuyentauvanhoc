<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Upload;

use App\Models\Category;
use App\Models\Seo;
use App\Services\BuildModelService;

// use App\Helpers\Url;

class CategoryAdminController extends Controller {

    public function __construct(BuildModelService $BuildModelService){
        $this->BuildModelService  = $BuildModelService;
    }

    public function list(Request $request){
        $list               = Category::getAllCategoryByTree();
        return view('admin.category.list', compact('list'));
    }

    public function viewEdit(Request $request, $id){
        if(!empty($id)){
            $category       = Category::all();
            $item           = Category::select('*')
                                            ->where('id', $id)
                                            ->with('pages')
                                            ->get();
            $item           = $item[0] ?? [];
            $type           = 'edit';
            if(!empty($request->get('type'))) $type = $request->get('type');
            if(!empty($item)) return view('admin.category.view', compact('category', 'item', 'type'));

        }
        return redirect()->route('admin.category.list');
    }

    public function viewInsert(Request $request){
        $category           = Category::all();
        $type               = 'create';
        return view('admin.category.view', compact('category', 'type'));
    }

    public function create(Request $request){
        /* upload image */
        $dataPath           = [];
        if($request->hasFile('image')) {
            $name           = !empty($request->get('seo_alias')) ? $request->get('seo_alias') : time();
            $dataPath       = Upload::uploadThumnail($request->file('image'), $name);
        }
        /* insert page */
        $insertPage         = $this->BuildModelService->buildArrayInsertUpdateTablePages($request->all(), $dataPath);
        $pageId             = Seo::insertItem($insertPage);
        /* insert categories_info */
        $insertCategory     = $this->BuildModelService->buildArrayInsertUpdateTableCategoriesInfo($request->all(), $pageId);
        $idCategory         = Category::insertItem($insertCategory);
        /* Message */
        return redirect()->route('admin.category.list');
    }

    public function update(Request $request){
        /* upload image */
        $dataPath           = [];
        if($request->hasFile('image')) {
            $name           = !empty($request->get('seo_alias')) ? $request->get('seo_alias') : time();
            $dataPath       = Upload::uploadThumnail($request->file('image'), $name);
        }
        /* update page */
        $updatePage         = $this->BuildModelService->buildArrayInsertUpdateTablePages($request->all(), $dataPath);
        $flagUpdatePage     = Seo::updateItem($request->get('seo_id'), $updatePage);
        /* update category */
        $updateCategory     = $this->BuildModelService->buildArrayInsertUpdateTableCategoriesInfo($request->all());
        $flagUpdateCate     = Category::updateItem($request->get('id'), $updateCategory);
        /* update cột level của child */
        $this->updateLevelChild($request->get('seo_id'));

        return redirect()->route('admin.category.list');
    }

    private function updateLevelChild($idPage){
        $child          = Seo::select('id')->where('parent', $idPage)->get();
        if(!empty($child)){
            $infoParent = Seo::select('level')->where('id', $idPage)->firstOrFail();
            $level      = $infoParent->level;
            $levelChild = $level + 1;
            foreach($child as $item){
                /* update level bảng seo */
                Seo::updateItem($item->id, ['level' => $levelChild]);
                /* update level bảng category_info */
                Category::select('*')->where('page_id', $item->id)->update(['category_level' => $levelChild]);
                /* update tiếp phẩn tử con */
                $this->updateLevelChild($item->id);
            }
        }
    }
}
