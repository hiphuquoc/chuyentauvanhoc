<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Seo;

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
    public function home()
    {
         /* cache */
         $nameCache = 'trang-chu'.'.'.config('admin.cache.extension');
         $pathCache = Storage::path(config('admin.cache.folderSave')).$nameCache;
         $cacheTime = 1800;
         if(file_exists($pathCache)&&$cacheTime>(time() - filectime($pathCache))){
             $xhtml = file_get_contents($pathCache);
         }else {
            $info   = Seo::select('*')
                        ->where('seo_alias', '/')
                        ->first();
            $xhtml  = view('main.home.home', compact('info'))->render();
            Storage::put(config('admin.cache.folderSave').$nameCache, $xhtml);
        }
        echo $xhtml;
    }
}
