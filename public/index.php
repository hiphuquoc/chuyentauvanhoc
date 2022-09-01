<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__.'/../vendor/autoload.php';

function seo_redirect (\Illuminate\Http\Request $request) {
    // $url            = $_SERVER['REQUEST_URI'];
    // // $url            = preg_replace('#\?.*$#imsU', '', $url);
    // $domain         = env('APP_URL');
    // dd($domain);
    // // xóa dấu / cuối APP_URL (nếu có)
    // if(substr($domain, -1)==='/') $domain = substr($domain, 0, -1);
    // // redirect nhiều / về một /
    // if(preg_match('#\/\/+#imsU', $url)===1){
    //     $url        = removeCharactor($url);
    //     $fullUrl    = $domain.$url;
    //     header("HTTP/1.1 301 Moved Permanently");
    //     header("Location: " . $fullUrl);
    //     exit();
    // }
    // redirect theo danh sách tùy biến
	// $redirectUrls   = App\Http\Controllers\RedirectController::getDataRedirect();
    // if(!empty($redirectUrls)) {
    //     foreach ($redirectUrls as $urlOld => $urlNew) {
    //         if($urlOld===$url){
    //             $fullUrlNew    = $domain.$urlNew;
    //             header("HTTP/1.1 301 Moved Permanently");
    //             header("Location: " . $fullUrlNew);
    //             exit();
    //         }
    //     }
    // }
}

function removeCharactor($string){
    if(preg_match('#\/\/+#imsU', $string)===1){
        $string = str_replace('//', '/', $string);
        $string = removeCharactor($string);
    }
    if(preg_match('#\/\/+#imsU', $string)===0) return $string;
}

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';



$kernel = $app->make(Kernel::class);



$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
