<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\AdminImageController;
use App\Http\Controllers\AdminSliderController;
use App\Http\Controllers\AdminCacheController;
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

Route::get('/thu-trung-thu-bac-viet-cho-thieu-nhi', function(){ 
    return Redirect::to('/nghi-luan-van-hoc/nang-cao/thu-trung-thu-bac-viet-cho-thieu-nhi', 301); 
});
Route::get('/luyen-de-van-hoc-va-qua-trinh-tiep-nhan', function(){ 
    return Redirect::to('/nghi-luan-van-hoc/nang-cao/luyen-de-van-hoc-va-qua-trinh-tiep-nhan', 301); 
});
Route::get('/lam-moi-phan-lien-he-mo-rong-bai-tho-tay-tien-phan-1', function(){ 
    return Redirect::to('/nghi-luan-van-hoc/van-trung-hoc-pho-thong/lop-12/lam-moi-phan-lien-he-mo-rong-bai-tho-tay-tien-phan-1', 301); 
});
Route::get('/lam-moi-phan-lien-he-mo-rong-bai-tho-tay-tien-phan-2', function(){ 
    return Redirect::to('/nghi-luan-van-hoc/van-trung-hoc-pho-thong/lop-12/lam-moi-phan-lien-he-mo-rong-bai-tho-tay-tien-phan-2', 301); 
});
Route::get('/phan-tich-kho-cuoi-bai-tho-dong-chi-cua-chinh-huu', function(){ 
    return Redirect::to('/nghi-luan-van-hoc/van-trung-hoc-co-so/lop-9/phan-tich-kho-cuoi-bai-tho-dong-chi-cua-chinh-huu', 301); 
});
Route::get('/phan-tich-tam-trang-nhan-vat-anh-cu-trang-vao-buoi-sang-ngay-hom-sau', function(){ 
    return Redirect::to('/nghi-luan-van-hoc/van-trung-hoc-pho-thong/lop-12/phan-tich-tam-trang-nhan-vat-anh-cu-trang-vao-buoi-sang-ngay-hom-sau', 301); 
});
Route::get('/phan-tich-qua-trinh-hoi-sinh-cua-chi-pheo', function(){ 
    return Redirect::to('/nghi-luan-van-hoc/van-trung-hoc-pho-thong/lop-11/phan-tich-qua-trinh-hoi-sinh-cua-chi-pheo', 301); 
});
Route::get('/mot-so-dinh-nghia-thuong-xuat-hien-trong-li-luan-van-hoc', function(){ 
    return Redirect::to('/tai-lieu-van-hoc/li-luan-van-hoc/mot-so-dinh-nghia-thuong-xuat-hien-trong-li-luan-van-hoc', 301); 
});
Route::get('/dan-chung-trich-dan-hay-ve-hanh-phuc', function(){ 
    return Redirect::to('/nghi-luan-xa-hoi/dan-chung-trich-dan-hay-ve-hanh-phuc', 301); 
});
Route::get('/ke-ve-trai-nghiem-cua-em-voi-thay-co-ban-be', function(){ 
    return Redirect::to('/nghi-luan-van-hoc/van-trung-hoc-co-so/lop-6/ke-ve-trai-nghiem-cua-em-voi-thay-co-ban-be', 301); 
});
Route::get('/bai-hoc-rut-ra-tu-hai-buc-tranh-minh-hoa-trong-to-bao-o-anh', function(){ 
    return Redirect::to('/nghi-luan-xa-hoi/bai-hoc-rut-ra-tu-hai-buc-tranh-minh-hoa-trong-to-bao-o-anh', 301); 
});
Route::get('/doan-van-nlxh-200-chu-vai-tro-cua-loi-noi-doi-dep-de-trong-cuoc-song', function(){ 
    return Redirect::to('/nghi-luan-xa-hoi/doan-van-nlxh-200-chu-vai-tro-cua-loi-noi-doi-dep-de-trong-cuoc-song', 301); 
});
Route::get('/de-phan-doc-hieu-khong-con-la-kho-khan', function(){ 
    return Redirect::to('/doc-hieu-van-hoc/de-phan-doc-hieu-khong-con-la-kho-khan', 301); 
});
Route::get('/nuyen-tuan-nguoi-giu-hon-dan-toc-tren-nhung-to-hoa', function(){ 
    return Redirect::to('/tai-lieu-van-hoc/tac-gia/nuyen-tuan-nguoi-giu-hon-dan-toc-tren-nhung-to-hoa', 301); 
});
Route::get('/nhan-dien-phuong-thuc-bieu-dat', function(){ 
    return Redirect::to('/doc-hieu-van-hoc/nhan-dien-phuong-thuc-bieu-dat', 301); 
});
Route::get('/mo-bai-hay-cho-cac-tac-pham-trong-chuong-trinh-van-9', function(){ 
    return Redirect::to('/nghi-luan-van-hoc/van-trung-hoc-co-so/lop-9/mo-bai-hay-cho-cac-tac-pham-trong-chuong-trinh-van-9', 301); 
});
Route::get('/y-nghia-cua-viec-dung-day-sau-vap-nga-doi-voi-moi-nguoi-trong-cuoc-song', function(){ 
    return Redirect::to('/nghi-luan-xa-hoi/y-nghia-cua-viec-dung-day-sau-vap-nga-doi-voi-moi-nguoi-trong-cuoc-song', 301); 
});
Route::get('/ke-ve-mot-lan-mac-loi-khien-bo-me-phai-phien-long', function(){ 
    return Redirect::to('/nghi-luan-van-hoc/van-trung-hoc-co-so/lop-8/ke-ve-mot-lan-mac-loi-khien-bo-me-phai-phien-long', 301); 
});
Route::get('/kim-lan-viet-tu-nhung-dieu-gan-ruot', function(){ 
    return Redirect::to('/tai-lieu-van-hoc/tac-gia/kim-lan-viet-tu-nhung-dieu-gan-ruot', 301); 
});
Route::get('/nhan-dien-phong-cach-ngon-ngu', function(){ 
    return Redirect::to('/doc-hieu-van-hoc/nhan-dien-phong-cach-ngon-ngu', 301); 
});
Route::get('/mot-so-y-kien-tiep-nhan-truyen-kieu-nguyen-du', function(){ 
    return Redirect::to('/nghi-luan-van-hoc/nang-cao/mot-so-y-kien-tiep-nhan-truyen-kieu-nguyen-du', 301); 
});
Route::get('/nhung-van-tho-than-thuong-ve-bac', function(){ 
    return Redirect::to('/nghi-luan-van-hoc/nang-cao/nhung-van-tho-than-thuong-ve-bac', 301); 
});
Route::get('/phan-tich-canh-doi-tau-trong-hai-dua-tre-cua-thach-lam', function(){ 
    return Redirect::to('/nghi-luan-van-hoc/van-trung-hoc-pho-thong/lop-11/phan-tich-canh-doi-tau-trong-hai-dua-tre-cua-thach-lam', 301); 
});
Route::get('/phan-tich-nhan-vat-phung-trong-truyen-ngan-chiec-thuyen-ngoai-xa-cua-nguyen-minh-chau', function(){ 
    return Redirect::to('/nghi-luan-van-hoc/van-trung-hoc-pho-thong/lop-12/phan-tich-nhan-vat-phung-trong-truyen-ngan-chiec-thuyen-ngoai-xa-cua-nguyen-minh-chau', 301); 
});

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
        /* ===== CACHE ===== */
        Route::prefix('cache')->group(function(){
            Route::get('/clearCacheAllPage', [AdminCacheController::class, 'clearCacheAllPage'])->name('admin.cache.clearCacheAllPage');
        });
    });
});
Route::get('/buildTocContent', [BlogController::class, 'buildTocContent'])->name('main.blog.buildTocContent');
Route::get('/exportPdfBlog', [BlogController::class, 'exportPdf'])->name('main.blog.exportPdf');

Route::get('sitemap.xml', [SitemapController::class, 'mainSitemap'])->name('sitemap.main');
Route::get('sitemap/category.xml', [SitemapController::class, 'childSitemap'])->name('sitemap.category');
Route::get('sitemap/article.xml', [SitemapController::class, 'childSitemap'])->name('sitemap.article');
Route::get('sitemap/product.xml', [SitemapController::class, 'childSitemap'])->name('sitemap.product');
Route::get('sitemap/page.xml', [SitemapController::class, 'childSitemap'])->name('sitemap.page');

Route::get("/{slug}/{slug2?}/{slug3?}/{slug4?}/{slug5?}", [RoutingController::class, 'routing'])->name('routing');

// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
