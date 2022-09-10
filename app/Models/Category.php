<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Helpers\Url;

class Category extends Model {
    use HasFactory;
    protected $table        = 'categories_info';
    protected $fillable     = [
        'name', 
        'description', 
        'page_id',
    ];
    public $timestamps      = false;

    public static function getList($params = null){
        $paginate   = $params['paginate'] ?? null;
        $result     = self::select('*')
                        ->with('pages')
                        ->paginate($paginate);
        return $result;
    }

    public static function getInfoBySeoAlias($seoAlias){
        $result         = [];
        if(!empty($seoAlias)){
            $result     = Category::select('*')
                            ->whereHas('pages', function($query) use($seoAlias){
                                $query->where('seo_alias', $seoAlias);
                            })
                            ->with('pages')
                            ->first();
        }
        return $result;
    }

    public static function getArrayCategoryChildById($idCate, $idPage){
        $result                 = [];
        if(!empty($idPage)){
            /* phần tử đầu tiên là Category cha */
            $result[]           = $idCate;
            $childs1            = self::getInfoCategoryChildById($idPage);
            if($childs1->isNotEmpty()){
                foreach($childs1 as $child1){
                    $result[]   = $child1->id;
                    $childs2    = self::getInfoCategoryChildById($child1->pages->id);
                    if($childs2->isNotEmpty()){
                        foreach($childs2 as $child2){
                            $result[]   = $child2->id;
                            $childs3    = self::getInfoCategoryChildById($child2->pages->id);
                            if($childs3->isNotEmpty()){
                                foreach($childs3 as $child3) $result[]  = $child3->id;
                            }
                        }
                    }
                }
            }
        }
        return array_unique($result);
    }

    private static function getInfoCategoryChildById($idPage){
        $result         = [];
        if(!empty($idPage)){
            $result     = self::select('*')
                            ->whereHas('pages', function($query) use($idPage){
                                $query->where('parent', $idPage);
                            })
                            ->with('pages')
                            ->get();
        }
        return $result;
    }

    public static function getAllCategoryFullInfo(){
        $result = DB::table('categories_info')
                    ->join('seo', 'seo.id', '=', 'categories_info.page_id')
                    ->select(array_merge(config('column.categories_info'), config('column.seo')))
                    ->orderBy('seo.id', 'ASC')
                    ->get()
                    ->toArray();
        return $result;
    }

    public static function getAllCategoryByTree(){
        /* Lấy danh sách category */
        $result         = Category::getAllCategoryFullInfo();
        /* lấy phần tử level 1 build cây thư mục category */
        $data           = [];
        foreach($result as $r){
            if($r->level==1) $data[] = Url::buildParentChild($r, $result);
        }
        return $data;
    }

    public static function getListCategoryByBlogId($idBlog){
        $result = [];
        if(!empty($idBlog)){
            $result     = DB::table('categories_info')
                            ->join('seo', 'seo.id', '=', 'categories_info.page_id')
                            ->join('relation_blog_category', 'relation_blog_category.category_info_id', '=', 'categories_info.id')
                            ->join('blogs_info', 'blogs_info.id', '=', 'relation_blog_category.blog_info_id')
                            ->select(array_merge(config('column.categories_info'), config('column.seo')))
                            ->where('blogs_info.id', $idBlog)
                            ->get()
                            ->toArray();
        }
        return $result;
    }

    public static function insertItem($params){
        $id             = 0;
        if(!empty($params)){
            $model      = new Category();
            foreach($params as $key => $value) $model->{$key}  = $value;
            $model->save();
            $id         = $model->id;
        }
        return $id;
    }

    public static function updateItem($id, $params){
        $flag           = false;
        if(!empty($id)&&!empty($params)){
            $model      = self::find($id);
            foreach($params as $key => $value) $model->{$key}  = $value;
            $flag       = $model->update();
        }
        return $flag;
    }

    public function pages() {
        return $this->hasOne(\App\Models\Seo::class, 'id', 'page_id')->orderBy('ordering', 'ASC');
    }

}
