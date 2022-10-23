<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Blog extends Model {
    use HasFactory;
    protected $table        = 'blogs_info';
    protected $fillable     = [
        'name', 
        'description', 
        'page_id',
        'note'
    ];
    public $timestamps      = true;

    /* ============= ADMIN */
    public static function getListAdmin($params = null){
        $outstanding        = $params['outstanding'] ?? 0;
        $searchName         = $params['search_name'] ?? null;
        $searchCategory     = $params['search_category'] ?? null;
        $result             = self::select('*')
                                ->when($searchName, function($query) use($searchName){
                                    $query->where('name', 'like', '%'.$searchName.'%');
                                })
                                ->when($searchCategory, function($query) use($searchCategory){
                                    $query->whereHas('category', function($q) use($searchCategory){
                                        $q->where('category_info_id', $searchCategory);
                                    });
                                })
                                ->when($outstanding, function($query) use($outstanding){
                                    $query->where('outstanding', $outstanding);
                                })
                                ->with('pages', 'category.infoCategory')
                                ->orderBy('created_at', 'DESC')
                                ->get();
        return $result;
    }
    /* ============= FRONTEND */
    public static function getList($params = null){
        $searchName         = $params['search_name'] ?? null;
        $paginate           = $params['paginate'] ?? 0;
        $outstanding        = $params['outstanding'] ?? null;
        $download           = $params['download'] ?? null;
        $limit              = $params['limit'] ?? 0;
        $result             = Blog::select('*')
                                /* tìm kiếm theo tên bài viết */
                                ->where('name', 'like', '%'.$searchName.'%')
                                /* bài viết nổi bật */
                                ->when($outstanding, function($query) use($outstanding){
                                    $query->where('outstanding', $outstanding);
                                })
                                /* bài viết được phép download */
                                ->when($download, function($query) use($download){
                                    $query->where('download', $download);
                                })
                                ->when($limit, function($query) use($limit){
                                    $query->limit($limit);
                                })
                                ->with('pages', 'category.infoCategory')
                                ->orderBy('id', 'DESC')
                                ->paginate($paginate);
        return $result;
    }
    
    public static function getListWithFullSlug($params = null){
        $paginate           = $params['paginate'] ?? null;
        $outstanding        = $params['outstanding'] ?? null;
        $limit              = $params['limit'] ?? 0;
        $result             = DB::table('seo')
                                ->join('blogs_info', 'blogs_info.page_id', '=', 'seo.id')
                                ->select(array_merge(config('column.blogs_info'), config('column.seo')))
                                /* bài viết nổi bật */
                                ->when($outstanding, function($query) use($outstanding){
                                    $query->where('blogs_info.outstanding', '1');
                                })
                                ->orderBy('seo.ordering', 'ASC')
                                ->orderBy('seo.created_at', 'DESC')
                                ->when($paginate, function($query) use ($paginate){
                                    $query->paginate($paginate);
                                })
                                ->when($limit, function($query) use($limit){
                                    $query->limit($limit);
                                })
                                ->get();
        return $result;
    }

    public static function getListBySeoAliasCategory($seoAlias, $params = null){
        $result             = null;
        if(!empty($seoAlias)){
            $paginate       = $params['paginate'] ?? 50;
            $result     = Blog::select('*')
                            ->whereHas('category.infoCategory.pages', function($query) use($seoAlias){
                                $query->where('seo_alias', $seoAlias);
                            })
                            ->with('pages')
                            ->orderBy('id', 'DESC')
                            ->paginate($paginate);
        }
        return $result;
    }

    public static function getListByArrayIdCategory($arrayId, $params = null){
        $result             = null;
        if(!empty($arrayId)){
            $paginate       = $params['paginate'] ?? null;
            $searchName     = $params['search_name'] ?? null;
            $arrayIdNot     = $params['arrayIdNot'] ?? [];
            $result         = Blog::select('*')
                                /* tìm kiếm theo tên bài viết */
                                ->where('name', 'like', '%'.$searchName.'%')
                                ->whereHas('category.infoCategory', function($query) use($arrayId){
                                    $query->whereIn('id', $arrayId);
                                })
                                ->when($arrayIdNot, function($query) use($arrayIdNot){
                                    $query->whereNotIn('id', $arrayIdNot);
                                })
                                ->with('pages', 'category.infoCategory')
                                ->orderBy('id', 'DESC')
                                ->orderBy('ordering', 'DESC')
                                ->paginate($paginate);
        }
        return $result;
    }

    public static function getInfoBySeoAlias($seoAlias){
        $result             = [];
        if(!empty($seoAlias)){
            $result         = Blog::select('*')
                                ->whereHas('pages', function($query) use($seoAlias){
                                    $query->where('seo_alias', $seoAlias);
                                })
                                ->with('pages')
                                ->first();
        }
        return $result;
    }

    public static function getListSpecialById($id){
        $result = [];
        if(!empty($id)){
            $result = DB::table('blogs_info')
                    ->join('seo', 'seo.id', '=', 'blogs_info.page_id')
                    ->join('relation_blog', 'relation_blog.blog_relation_id', '=', 'blogs_info.id')
                    ->select(array_merge(config('column.blogs_info'), config('column.seo')))
                    ->where('relation_blog.blog_info_id', $id)
                    ->get();
        }
        return $result;
    }

    public static function insertItem($params){
        $id             = 0;
        if(!empty($params)){
            $model      = new Blog();
            foreach($params as $key => $value) $model->{$key}  = $value;
            $model->save();
            $id         = $model->id;
        }
        return $id;
    }

    public static function updateItem($id, $params){
        $flag           = false;
        if(!empty($id)&&!empty($params)){
            $model      = Blog::find($id);
            foreach($params as $key => $value) $model->{$key}  = $value;
            $flag       = $model->update();
        }
        return $flag;
    }

    public function pages() {
        return $this->hasOne(\App\Models\Seo::class, 'id', 'page_id');
    }

    public function category() {
        return $this->hasMany(\App\Models\RelationBlogCategory::class, 'blog_info_id', 'id');
    }

    public function relationBlog() {
        return $this->hasMany(\App\Models\RelationBlog::class, 'blog_info_id', 'id');
    }

}
