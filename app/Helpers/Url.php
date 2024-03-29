<?php

namespace App\Helpers;

use App\Models\Seo;
use Illuminate\Support\Facades\DB;

class Url {

    public static function buildArrayBreadcrumb($data){
        $result         = [];
        if(!empty($data)){
            $result[]   = $data;
            $infoSeo    = Seo::select('*')
                            ->get();
            $parent                 = $data->parent;
            for($i=1;$i<$data->level;++$i){
                foreach($infoSeo as $page){
                    if($page->id==$parent) {
                        $parent     = $page->parent;
                        $result[]   = $page;
                        break;
                    }
                }
            }
            /* sắp xếp theo level */
            $price = array();
            foreach ($result as $key => $row){
                $price[$key] = $row->level;
            }
            array_multisort($price, SORT_ASC, $result);
        }
        return $result;

    }

    public static function buildParentChild($item, $arrayData){
        foreach($arrayData as $data){
            if($item->page_id==$data->parent) {
                // check đệ quy
                $flagNext           = false;
                foreach($arrayData as $d) {
                    if($data->page_id==$d->parent){
                        $flagNext   = true;
                        break;
                    }
                }
                // trả dữ liệu
                if($flagNext==true){
                    $item->child[]  = self::buildParentChild($data, $arrayData);
                }else {
                    $item->child[]  = $data;
                }
            }
        }
        return $item;
    }
}