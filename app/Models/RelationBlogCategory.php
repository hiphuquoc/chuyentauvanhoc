<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RelationBlogCategory extends Model {
    use HasFactory;
    protected $table        = 'relation_blog_category';
    protected $fillable     = [
        'blog_info_id', 
        'category_info_id'
    ];
    public $timestamps      = false;

    public static function deleteAndInsertItem($data){
        $flag               = false;
        if(!empty($data)){
            $dataIdBlog     = [];
            foreach($data as $d){
                if(!in_array($d['blog_info_id'], $dataIdBlog)) $dataIdBlog[] = $d['blog_info_id'];
            }
            // delete relation trước đó
            DB::table('relation_blog_category')->whereIn('blog_info_id', $dataIdBlog)->delete();
            // insert
            foreach($data as $d){
                $model  = new RelationBlogCategory();
                foreach($d as $key => $value) $model->{$key}  = $value;
                $model->save();
            }
            $flag           = true;
        }
        return $flag;
    }

    public function infoCategory() {
        return $this->hasOne(\App\Models\Category::class, 'id', 'category_info_id');
    }

}
