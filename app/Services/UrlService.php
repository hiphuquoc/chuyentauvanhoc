<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Seo;
use App\Models\Blog;

use App\Helpers\Url;
use Illuminate\Support\Facades\Redirect;

class UrlService {

    public static function checkUrlExists($arrayUrl){
        $urlEnd     = end($arrayUrl);
        $infoPage   = Seo::select('*')
                        ->where('seo_alias', $urlEnd)
                        ->first();
        return $infoPage;
    }
}