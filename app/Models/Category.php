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

    public static function getInfoBySeoAlias($value){
        $result         = [];
        if(!empty($value)){
            $result     = DB::table('categories_info')
                        ->join('seo', 'seo.id', '=', 'categories_info.page_id')
                        ->select(array_merge(config('column.categories_info'), config('column.seo')))
                        ->where('seo.seo_alias', $value)
                        ->first();
        }
        return $result;
    }

    public static function getArrayCategoryChildById($idCate){
        $result         = [];
        if(!empty($idCate)){
            /* phần tử đầu tiên là Category cha */
            $result[]   = $idCate;
            $child1     = self::getInfoCategoryChildById($idCate);
            if(!empty($child1)){
                foreach($child1 as $c1){
                    /* cho phần tử con cấp tiếp theo (c1) vào mảng */
                    $result[]   = $c1['id'];
                    $child2     = self::getInfoCategoryChildById($c1['id']);
                    if(!empty($child2)){
                        /* cho phần tử con cấp tiếp theo (c2) vào mảng */
                        foreach($child2 as $c2) {
                            $result[]   = $c2['id'];
                            $child3     = self::getInfoCategoryChildById($c2['id']);
                            if(!empty($child3)){
                                foreach($child3 as $c3){
                                    $result[]   = $c3['id'];
                                }
                            }
                        }
                    } 
                    /* lấy 3 cấp category tiếp theo */
                }
            }
        }
        return $result;
    }

    private static function getInfoCategoryChildById($idCate){
        $result         = [];
        if(!empty($idCate)){
            $result     = self::select('*')
                            ->where('category_parent', $idCate)
                            ->get()
                            ->toArray();
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
