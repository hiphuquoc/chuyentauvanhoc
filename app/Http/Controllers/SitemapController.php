<?php 

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Blog;

/**
 * Definitions Back-end Controller
 */

class SitemapController extends Controller {
    private static $data   = [
        'category',
        'article'
    ];

    public static function mainSitemap(){     
        dd(123);  
        $sitemapXhtml       = '<urlset xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        foreach(self::$data as $item){
            $sitemapXhtml   .= self::rowMainSitemap($item);
        }
        $sitemapXhtml       .= '</urlset>';
        
        return response()->make($sitemapXhtml)->header('Content-Type', 'application/xml');
    }

    public static function childSitemap(){
        $sitemapName        = pathinfo($_SERVER['REQUEST_URI'])['filename'];
        if(in_array($sitemapName, self::$data)){
            $sitemapXhtml   = '<urlset xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
            switch($sitemapName){
                case 'category': 
                    $data   = Category::select('*')
                                ->with('seo')
                                ->get();
                    foreach($data as $item) $sitemapXhtml   .= self::rowChildSitemap($item, 'tin-tuc');
                    break;
                case 'article': 
                    /* Blog */
                    $data   = Blog::select('*')
                                ->with('seo')
                                ->get();
                    foreach($data as $item) {
                        $sitemapXhtml   .= self::rowChildSitemapHaveImage($item, 'tin-tuc/'.$item->category_slug);
                    }
                    break;
                default:
                    break;
            }
            $sitemapXhtml   .= '</urlset>';
            return response()->make($sitemapXhtml)->header('Content-Type', 'application/xml');
        }
    }

    private static function rowMainSitemap($nameSitemap){
        $url        = env('APP_URL').'/sitemap/'.$nameSitemap.'.xml';
        $mk         = time() - rand(3600, 259200);
        $result     = '<url>
                            <loc>'.$url.'</loc>
                            <lastmod>'.date('c', $mk).'</lastmod>
                            <changefreq>weekly</changefreq>
                            <priority>0.8</priority>
                        </url>';
        return $result;
    }

    private static function rowChildSitemapHaveImage($item = null, $prefix = null){
        $result     = null;
        if(!empty($item)){
            /* URL */
            switch($item->slug){
                case '/': // trang chủ
                    $url    = env('APP_URL');
                    break;
                case 'chu-de':
                case 'vi-tri':
                    $url    = env('APP_URL').'/thai-minh-inside/'.$item->slug;
                    break;
                default:
                    $url    = env('APP_URL').'/'.$item->slug;
                    if(!empty($prefix)) $url = env('APP_URL').'/'.$prefix.'/'.$item->slug;
                    break;
            }
            /* Image */
            $imagePath  = self::buildUrlImage($item->image_name);
            $result = '<url>
                            <loc>'.$url.'</loc>
                            <lastmod>'.date('c', strtotime($item->updated_at)).'</lastmod>
                            <changefreq>daily</changefreq>
                            <priority>0.8</priority>
                            <image:image>
                                <image:loc>'.$imagePath.'</image:loc>
                                <image:title>'.self::replaceSpecialCharactorXml($item->title).'</image:title>
                            </image:image>
                        </url>';
        }
        return $result;
    }

    private static function rowChildSitemap($item = null, $prefix = null){
        $result     = null;
        if(!empty($item)){
            /* URL */
            $url    = env('APP_URL').'/'.$item->slug;
            if(!empty($prefix)) $url    = env('APP_URL').'/'.$prefix.'/'.$item->slug;
            $result = '<url>
                            <loc>'.$url.'</loc>
                            <lastmod>'.date('c', strtotime($item->updated_at)).'</lastmod>
                            <changefreq>daily</changefreq>
                            <priority>0.8</priority>
                        </url>';
        }
        return $result;
    }

    private static function buildUrlImage($imageName = null){
        $result = null;
        if(!empty($imageName)){
            $result = env('APP_URL').'/storage/app/uploads/public/';
            $result .= substr($imageName, 0, 3).'/'.substr($imageName, 3, 3).'/'.substr($imageName, 6, 3).'/'.$imageName;
        }
        return $result;
    }

    public static function replaceSpecialCharactorXml($str){
        $output         = null;
        if(!empty($str)){
            $dataEscape = [
                '&' => '&amp;',
                '<' => '&lt;',
                '>' => '&gt;',
                '"' => '&quot;',
                "'" => '&apos;'
            ];
            $output     = $str;
            foreach($dataEscape as $key => $value){
                $output = preg_replace('#'.$key.'#imsU', $value, $output);
            }
        }
        return $output;
    }
}