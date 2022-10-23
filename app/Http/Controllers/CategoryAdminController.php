<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Upload;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Seo;
use App\Services\BuildModelService;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CategoryAdminController extends Controller {

    public function __construct(BuildModelService $BuildModelService){
        $this->BuildModelService  = $BuildModelService;
    }

    public function list(Request $request){
        $list               = Category::getAllCategoryByTree();
        return view('admin.category.list', compact('list'));
    }

    public function view(Request $request){
        $id             = $request->get('id') ?? 0;
        $parents        = Category::select('*')
                            ->with('pages')
                            ->get();
        $item           = Category::select('*')
                            ->where('id', $id)
                            ->with('pages')
                            ->first();
        /* type */
        $type           = !empty($item) ? 'edit' : 'create';
        $type           = $request->get('type') ?? $type;
        return view('admin.category.view', compact('parents', 'item', 'type'));
    }

    public function create(CategoryRequest $request){
        try {
            DB::beginTransaction();
            /* upload image */
            $dataPath           = [];
            if($request->hasFile('image')) {
                $name           = !empty($request->get('seo_alias')) ? $request->get('seo_alias') : time();
                $dataPath       = Upload::uploadThumnail($request->file('image'), $name);
            }
            /* insert page */
            $insertPage         = $this->BuildModelService->buildArrayInsertUpdateTablePages($request->all(), 'categories_info', $dataPath);
            $pageId             = Seo::insertItem($insertPage);
            /* insert categories_info */
            $insertCategory     = $this->BuildModelService->buildArrayInsertUpdateTableCategoriesInfo($request->all(), $pageId);
            $idCategory         = Category::insertItem($insertCategory);
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
        return redirect()->route('admin.category.view', ['id' => $idCategory]);
    }

    public function update(CategoryRequest $request){
        try {
            DB::beginTransaction();
            $idCategory         = $request->get('id');
            /* upload image */
            $dataPath           = [];
            if($request->hasFile('image')) {
                $name           = !empty($request->get('seo_alias')) ? $request->get('seo_alias') : time();
                $dataPath       = Upload::uploadThumnail($request->file('image'), $name);
            }
            /* update page */
            $updatePage         = $this->BuildModelService->buildArrayInsertUpdateTablePages($request->all(), 'categories_info', $dataPath);
            $flagUpdatePage     = Seo::updateItem($request->get('seo_id'), $updatePage);
            /* update category */
            $updateCategory     = $this->BuildModelService->buildArrayInsertUpdateTableCategoriesInfo($request->all());
            
            $flagUpdateCate     = Category::updateItem($idCategory, $updateCategory);
            /* update cột level của child */
            $this->updateLevelChild($request->get('seo_id'));
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
        return redirect()->route('admin.category.view', ['id' => $idCategory]);
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
                /* update tiếp phẩn tử con */
                $this->updateLevelChild($item->id);
            }
        }
    }

    public function delete(Request $request){
        if(!empty($request->get('id'))){
            try {
                DB::beginTransaction();
                $id         = $request->get('id');
                $info       = Category::select('*')
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
