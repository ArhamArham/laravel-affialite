<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CouponSortingController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\FrontendBlogController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteSettingController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend;

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

Route::get('clear_cache', function () {
    Cache::flush();
});

Route::get('/login', [Auth\LoginController::class, 'showLoginForm'])
    ->name('login')->middleware('guest:admin');
Route::post('/login', [Auth\LoginController::class, 'login']);
Route::post('logout', [Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/password_request', [Auth\ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request')->middleware('guest:admin');
Route::post('/password_email', [Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset/{token}/{email}', [Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset', [Auth\ResetPasswordController::class, 'reset'])->name('password.update');

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::group(['prefix' => 'image', 'as' => 'image.'], static function () {
        Route::get('/fetch', [FileUploadController::class, 'fetchGallery'])->name('gallery.fetch');
        Route::post('/upload', [FileUploadController::class, 'storeGallery'])->name('gallery.upload');
        Route::delete('/delete', [FileUploadController::class, 'removeGallery'])->name('gallery.remove');
    });


    Route::group(['prefix' => 'userManagement', 'as' => 'userManagement.'], static function () {
        Route::resource('role', RoleController::class);
        Route::resource('user', UserController::class);
    });


    Route::group(['prefix' => 'market', 'as' => 'market.'], function () {
        Route::resource('category', CategoryController::class);
        Route::resource('network', NetworkController::class);
    });

    Route::group(['prefix' => 'affiliate', 'as' => 'affiliate.'], function () {
        Route::resource('store', StoreController::class);
        Route::resource('coupon', CouponController::class)->except('show');
        Route::get('coupon/sorting', [CouponSortingController::class, 'index'])->name('coupon.sorting.index');
        Route::post('coupon/sorting', [CouponSortingController::class, 'store'])->name('coupon.sorting.store');
    });

    Route::group(['prefix' => 'advertisement', 'as' => 'advertisement.'], function () {
        Route::resource('deal', DealController::class);
        Route::resource('blog', BlogController::class);
        Route::resource('page', PageController::class);
    });

    Route::group(['prefix' => 'setting', 'as' => 'setting.'], static function () {
        Route::group(['prefix' => 'website', 'as' => 'website.'], static function () {
            Route::get('/', [WebsiteSettingController::class, 'index'])->name('index');
            Route::post('/', [WebsiteSettingController::class, 'store'])->name('store');
        });
    });
});

Route::group(['as' => 'frontend.'], static function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/search', SearchController::class)->name('search.post');

    Route::group(['prefix' => 'category', 'as' => 'category.'], static function () {
        Route::get('/', [Frontend\CategoryController::class, 'index'])->name('index');
        Route::get('/{category:slug}', [Frontend\CategoryController::class, 'show'])->name('show');
    });

    Route::group(['prefix' => 'store', 'as' => 'store.'], static function () {
        Route::get('/', [Frontend\StoreController::class, 'index'])->name('index');
        Route::get('/{store:slug}', [Frontend\StoreController::class, 'show'])->name('show');
    });

    Route::get('/blog', [FrontendBlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{blog:slug}', [FrontendBlogController::class, 'show'])->name('blog.show');

    Route::get('{page:slug}', [Frontend\HomeController::class, 'page'])->name('page');
});
