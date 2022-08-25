<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\AdminImageController;
use App\Http\Controllers\AdminSliderController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SitemapController;
/* ADMIN */
use App\Http\Controllers\CategoryAdminController;
use App\Http\Controllers\BlogAdminController;
use App\Http\Controllers\Admin\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'home'])->name('home.index');

Route::prefix('admin')->group(function(){
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('admin.showLoginForm');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth'])->group(function () {
        Route::prefix('category')->group(function(){
            Route::get('/', [CategoryAdminController::class, 'list'])->name('admin.category.list');
            Route::get('/view', [CategoryAdminController::class, 'view'])->name('admin.category.view');
            Route::post('/create', [CategoryAdminController::class, 'create'])->name('admin.category.create');
            Route::post('/update', [CategoryAdminController::class, 'update'])->name('admin.category.update');
            Route::get('/delete', [CategoryAdminController::class, 'delete'])->name('admin.category.delete');
        });

        Route::prefix('blog')->group(function(){
            Route::get('/', [BlogAdminController::class, 'list'])->name('admin.blog.list');
            Route::get('/view', [BlogAdminController::class, 'view'])->name('admin.blog.view');
            Route::post('/create', [BlogAdminController::class, 'create'])->name('admin.blog.create');
            Route::post('/update', [BlogAdminController::class, 'update'])->name('admin.blog.update');
            Route::get('/delete', [BlogAdminController::class, 'delete'])->name('admin.blog.delete');
        });

        /* ===== IMAGE ===== */
        Route::prefix('image')->group(function(){
            Route::get('/', [AdminImageController::class, 'list'])->name('admin.image.list');
            Route::post('/uploadImages', [AdminImageController::class, 'uploadImages'])->name('admin.image.uploadImages');
            Route::post('/loadImage', [AdminImageController::class, 'loadImage'])->name('admin.image.loadImage');
            Route::post('/loadModal', [AdminImageController::class, 'loadModal'])->name('admin.image.loadModal');
            Route::post('/changeName', [AdminImageController::class, 'changeName'])->name('admin.image.changeName');
            Route::post('/changeImage', [AdminImageController::class, 'changeImage'])->name('admin.image.changeImage');
            Route::post('/removeImage', [AdminImageController::class, 'removeImage'])->name('admin.image.removeImage');
        });
        /* ===== IMAGE ===== */
        Route::prefix('slider')->group(function(){
            Route::get('/', [AdminSliderController::class, 'list'])->name('admin.slider.list');
            Route::post('/uploadImages', [AdminSliderController::class, 'uploadImages'])->name('admin.slider.uploadImages');
            Route::post('/loadImage', [AdminSliderController::class, 'loadImage'])->name('admin.slider.loadImage');
            Route::post('/loadModal', [AdminSliderController::class, 'loadModal'])->name('admin.slider.loadModal');
            Route::post('/changeName', [AdminSliderController::class, 'changeName'])->name('admin.slider.changeName');
            Route::post('/changeImage', [AdminSliderController::class, 'changeImage'])->name('admin.slider.changeImage');
            Route::post('/removeImage', [AdminSliderController::class, 'removeImage'])->name('admin.slider.removeImage');
        });
    });
});
Route::post('/buildTocContent', [BlogController::class, 'buildTocContent'])->name('main.blog.buildTocContent');
Route::get('/exportPdfBlog', [BlogController::class, 'exportPdf'])->name('main.blog.exportPdf');

Route::get('sitemap.xml', [SitemapController::class, 'mainSitemap'])->name('sitemap.main');
Route::get('sitemap/category.xml', [SitemapController::class, 'childSitemap'])->name('sitemap.category');
Route::get('sitemap/article.xml', [SitemapController::class, 'childSitemap'])->name('sitemap.article');
Route::get('sitemap/product.xml', [SitemapController::class, 'childSitemap'])->name('sitemap.product');
Route::get('sitemap/page.xml', [SitemapController::class, 'childSitemap'])->name('sitemap.page');

Route::get("/{slug}/{slug2?}/{slug3?}/{slug4?}/{slug5?}", [RoutingController::class, 'routing'])->name('routing');

// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
