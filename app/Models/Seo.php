<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model {
    use HasFactory;
    protected $table        = 'seo';
    protected $fillable     = [
        'title', 
        'description', 
        'image',
        'level', 
        'parent', 
        'ordering',
        'topic', 
        'seo_title', 
        'seo_description',
        'seo_alias', 
        'rating_author_name', 
        'rating_author_star',
        'rating_aggregate_count', 
        'rating_aggregate_star',
        'created_at',
        'updated_at',
    ];

    public static function insertItem($params){
        $id             = 0;
        if(!empty($params)){
            $model      = new Seo();
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
            /* mỗi lần cập nhật lại slug thì phải build lại seo_alias_full của toàn bộ children */
            if($flag==true){
                $childs = self::select('id', 'level', 'parent', 'seo_alias')
                            ->where('parent', $id)
                            ->get();
                foreach($childs as $child){
                    $urlNew         = self::buildFullUrl($child->seo_alias, $child->level, $child->parent);
                    $paramsUpdate   = ['seo_alias_full' => $urlNew];
                    self::updateItem($child->id, $paramsUpdate);
                }
            }
        }
        return $flag;
    }

    public static function buildFullUrl($seoAlias, $level, $parent){
        $url    = null;
        if(!empty($seoAlias)){
            $infoSeo    = self::select('id', 'seo_alias', 'parent')
                            ->get();
            $url        = $seoAlias;
            for($i=1;$i<$level;++$i){
                foreach($infoSeo as $item){
                    if($item->id==$parent) {
                        $url    = $item->seo_alias.'/'.$url;
                        $parent = $item->parent;
                        break;
                    }
                }
            }
        }
        return $url;
    }
}
