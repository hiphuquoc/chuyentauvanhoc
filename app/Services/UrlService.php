<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Seo;
use App\Models\Blog;

use App\Helpers\Url;

class UrlService {

    public static function checkUrlExists($arrayUrl){
        $result         = null;
        if(!empty($arrayUrl)){
            $urlFull    = implode('/', $arrayUrl);
            /* Check Category */
            $tmp        = Category::getInfoBySeoAlias(end($arrayUrl));
            if(!empty($tmp)&&$tmp->pages->seo_alias_full==$urlFull) {
                $result['type'] = 'category';
                $result['info'] = $tmp;
                return $result;
            }
            /* Check Blog */
            $tmp        = Blog::getInfoBySeoAlias(end($arrayUrl));
            if(!empty($tmp)&&$tmp->pages->seo_alias_full==$urlFull) {
                $result['type'] = 'blog';
                $result['info'] = $tmp;
                return $result;
            }
        }
        return $result;
    }

    public static function buildFullUrlFormUrl($urlEnd){
        $result     = null;
        if(!empty($urlEnd)){
            $tmp                = Seo::select('*')
                                    ->where('seo_alias', $urlEnd)
                                    ->first();
            if(!empty($tmp)){
                $result         = $urlEnd;
                for($i=$tmp->level;$i>1;--$i){
                    $tmp        = Seo::select('*')
                                    ->where('id', $tmp->parent)
                                    ->first();
                    if(!empty($tmp)) {
                        $result = $tmp->seo_alias.'/'.$result;
                    }else {
                        return null;
                    }
                }
            }
        }
        return $result;
    }
    
}