<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Seo;

class BuildModelService {
    public static function buildArrayInsertUpdateTablePages($dataForm, $dataPath = null){
        /* update page_info
            + title
            + description
            + image (null => update)
            + image_small (null => update)
            + level
            + parent
            + ordering
            + topic
            + seo_title
            + seo_description
            + seo_alias
            + rating_author_name
            + rating_author_star
            + rating_aggregate_count
            + rating_aggregate_star
        */
        $result                                 = [];
        if(!empty($dataForm)){
            $result['title']                    = $dataForm['title'] ?? null;
            $result['description']              = $dataForm['description'] ?? null;
            if(!empty($dataPath['filePathNormal'])) $result['image']           = $dataPath['filePathNormal'];
            if(!empty($dataPath['filePathSmall']))  $result['image_small']     = $dataPath['filePathSmall'];
            /* page level */
            $pageLevel                          = 1;
            $pageParent                         = 0;
            if(!empty($dataForm['parent'])){
                $infoPageParent                 = Seo::select('*')
                                                    ->where('id', $dataForm['parent'])
                                                    ->first();
                $pageLevel                      = !empty($infoPageParent->level) ? ($infoPageParent->level+1) : $pageLevel;
                $pageParent                     = $infoPageParent->id ?? $pageParent;
            }
            $result['level']                    = $pageLevel;
            $result['parent']                   = $pageParent;
            $result['ordering']                 = $dataForm['ordering'] ?? null;
            $result['topic']                    = null;
            $result['seo_title']                = $dataForm['seo_title'] ?? $dataForm['title'] ?? null;
            $result['seo_description']          = $dataForm['seo_description'] ?? $dataForm['description'] ?? null;
            $result['seo_alias']                = $dataForm['seo_alias'];
            /* slug full */
            $result['seo_alias_full']           = Seo::buildFullUrl($dataForm['seo_alias'], $pageLevel, $pageParent);
            $result['rating_author_name']       = 1;
            $result['rating_author_star']       = 5;
            $result['rating_aggregate_count']   = $dataForm['rating_aggregate_count'] ?? 0;
            $result['rating_aggregate_star']    = $dataForm['rating_aggregate_star'] ?? null;
            $result['created_by']               = 1;
        }
        return $result;
    }

    public static function buildArrayInsertUpdateTableCategoriesInfo($dataForm, $pageId = null){
        /* upload category_info
            + name
            + description
            + page_id
        */
        $result                             = [];
        if(!empty($dataForm)){
            $result['name']                 = $dataForm['title'] ?? null;
            $result['description']          = $dataForm['description'] ?? null;
            if(!empty($pageId)) $result['page_id'] = $pageId;
        }
        return $result;
    }

    public static function buildArrayInsertUpdateTableBlogsInfo($dataForm, $pageId = null){
        /* upload category_info
            + name
            + description
            + page_id
            + note
            + content
            + outstanding
            + ordering
            + download
        */
        $result                             = [];
        if(!empty($dataForm)){
            $result['name']                 = $dataForm['title'] ?? null;
            $result['description']          = $dataForm['description'] ?? null;
            if(!empty($pageId)) $result['page_id'] = $pageId;
            $result['note']                 = $dataForm['note'] ?? null;
            $result['content']              = $dataForm['content'] ?? null;
            $result['outstanding']          = 0;
            if(!empty($dataForm['outstanding'])) {
                if($dataForm['outstanding']=='on') $result['outstanding'] = 1;
            }
            $result['ordering']             = $dataForm['ordering'] ?? null;
            $result['download']             = 0;
            if(!empty($dataForm['download'])) {
                if($dataForm['download']=='on') $result['download'] = 1;
            }
        }
        return $result;
    }

    public static function buildArrayInsertUpdateTableRelationBlogCategory($dataForm, $idBlog){
        $result     = null;
        if(!empty($dataForm['category'])&&!empty($idBlog)){
            $i      = 0;
            foreach($dataForm['category'] as $categoryId){
                $result[$i]['blog_info_id']     = $idBlog;
                $result[$i]['category_info_id'] = $categoryId;
                ++$i;
            }
        }
        return $result;
    }
}