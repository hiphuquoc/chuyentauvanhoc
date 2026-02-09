<?php

namespace App\Http\Controllers;

use App\Models\Seo;
use App\Helpers\Url;
use App\Services\HtmlCacheService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public static function home(){
        $xhtml = app(HtmlCacheService::class)->getOrRender('trang-chu', function () {
            $info   = Seo::select('*')
                        ->where('seo_alias', '/')
                        ->first();
            return view('main.home.home', compact('info'))->render();
        });
        echo $xhtml;
    }

    public static function downloads(){
        $xhtml = app(HtmlCacheService::class)->getOrRender('tai-tai-lieu', function () {
            $info   = Seo::select('*')
                ->where('seo_alias', '/tai-tai-lieu')
                ->first();
            $breadcrumb = Url::buildArrayBreadcrumb($info);
            $list   = \App\Models\Blog::select('*')
                        ->where('download', 1)
                        ->orderBy('id', 'DESC')
                        ->get();
            return view('main.home.downloads', compact('info', 'breadcrumb', 'list'))->render();
        });
        echo $xhtml;
    }
}
