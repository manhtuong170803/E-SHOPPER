<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;


use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\MemberController;
use App\Http\Controllers\Frontend\FrontendBlogController;
use App\Http\Controllers\Frontend\RateController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\MemberProductController;
use App\Http\Controllers\Frontend\ReplayController;
use App\Http\Controllers\Frontend\FroductDetailsController;
use App\Http\Controllers\Frontend\HomeCartController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\MailController;
use App\Http\Controllers\Frontend\SearchAdvancedController;
use App\Http\Controllers\Frontend\PriceRangeController;
use App\Http\Controllers\Frontend\PriceLeftController;
use App\Http\Controllers\Frontend\OnePageController;
use App\Http\Controllers\Frontend\CategoriesController;
use App\Http\Controllers\Frontend\BrandsController;
use App\Http\Controllers\Frontend\WishlistController;



// use App\Http\Controllers\Admin\HomeController;
// return view('dashboard');
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


Route::group([
    // 'prefix' => 'admin', //add "admin" before link
    'middleware' => ['admin']
], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name( 'home' );
    Route::get('/adminpage', [App\Http\Controllers\DemoController::class, 'demo']);
    
    Route::get('/admin/dashboard', [DashboardController::class, 'index']); //->middleware('admin:1')
    

    Route::get('/admin/profile', [UserController::class, 'index'])->name('profile.user');
    Route::post('/admin/profile', [UserController::class, 'update'])->name('profile.update');
    Route::get('/admin/logout', [UserController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/country', [CountryController::class, 'index'])->name('country.list');
    Route::get('/admin/country/add', [CountryController::class, 'add'])->name('country.add');
    Route::post('/admin/country/add', [CountryController::class, 'insert'])->name('country.insert');
    Route::get('/admin/country/delete/{id}', [CountryController::class, 'delete'])->name('country.delete');


    Route::get('/admin/category', [CategoryController::class, 'index'])->name('category.list');
    Route::get('/admin/category/add', [CategoryController::class, 'add'])->name('category.add');
    Route::post('/admin/category/add', [CategoryController::class, 'insert'])->name('category.insert');
    Route::get('/admin/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');


    Route::get('/admin/brand', [BrandController::class, 'index'])->name('brand.list');
    Route::get('/admin/brand/add', [BrandController::class, 'add'])->name('brand.add');
    Route::post('/admin/brand/add', [BrandController::class, 'insert'])->name('brand.insert');
    Route::get('/admin/brand/delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');


    Route::get('/admin/blog', [BlogController::class, 'index'])->name('blog.list');

    Route::get('/admin/blog/add', [BlogController::class, 'add'])->name('blog.add');
    Route::post('/admin/blog/add', [BlogController::class, 'insert'])->name('blog.insert');

    Route::get('/admin/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('/admin/blog/edit/{id}', [BlogController::class, 'update'])->name('blog.update');

    Route::get('/admin/blog/delete/{id}', [BlogController::class, 'delete'])->name('blog.delete');

    // -------------------------------------------------------------------------------------------------------------------

});


Route::group([
    'middlewares' => ['member']
], function () {

    Route::get('/frontend/home', [HomeController::class, 'index'])->name('frontend.home');

    Route::get('/frontend/product/details/{id}', [FroductDetailsController::class, 'show'])->name('product.detail');

    Route::get('/member/register', [MemberController::class, 'showregister']);
    Route::post('/member/register', [MemberController::class, 'postregister']);

    Route::get('/member/login', [MemberController::class, 'showlogin']);
    Route::post('/member/login', [MemberController::class, 'postlogin']);

    Route::get('/member/logout', [MemberController::class, 'logout']);




    Route::get('/frontend/blog', [FrontendBlogController::class, 'index'])->name('blog.list');
    Route::get('/frontend/blog/detail/{id}', [FrontendBlogController::class, 'show'])->name('blogs.show');


    Route::post('/blog/rate/ajax', [RateController::class, 'store']);
    Route::get('/blog/rate/ajax/{id}', [RateController::class, 'show'])->name('blog.show');


    Route::post('/blog/comment/ajax', [CommentController::class, 'ajaxCmt']);

    Route::post('/blog/comment/reply', [ReplayController::class, 'ajaxReply']); 





    Route::get('/member/account', [MemberController::class, 'account']);
    Route::post('/member/account', [MemberController::class, 'update'])->name('member.update');

    Route::get('/member/account/my-product', [MemberProductController::class, 'index'])->name('frontend.member.my-product');
    Route::get('/member/account/add-product', [MemberProductController::class, 'add'])->name('products.add');
    Route::post('/member/account/add-product', [MemberProductController::class, 'insert'])->name('products.insert');
    Route::get('/member/account/edit-product/{id}', [MemberProductController::class, 'edit'])->name('products.edit');
    Route::post('/member/account/edit-product/{id}', [MemberProductController::class, 'update'])->name('products.update');
    Route::get('/member/account/delete-product/{id}', [MemberProductController::class, 'delete'])->name('products.delete');



    Route::post('/home/cart/ajax', [HomeCartController::class, 'ajaxCart']);

    Route::post('/home/wishlist', [HomeCartController::class, 'ajaxWishlist']);

    Route::post('/home/wishlist/remove', [HomeCartController::class, 'remove'])->name('wishlist.remove');



    Route::get('/frontend/cart', [CartController::class, 'index']);

    Route::post('/cart/update_cart/ajax', [CartController::class, 'ajaxUpdateCart']);


    Route::get('/frontend/cart/checkout', [CheckoutController::class, 'index']);



    Route::get('/frontend/cart/mail', [MailController::class, 'sendOrderEmail'])->middleware('auth');
    Route::post('/frontend/cart/mail', [MailController::class, 'sendOrderEmail'])->middleware('auth');
    //Route::get('/test', [MailController::class, 'index']);

    Route::get('/frontend/search/list', [HomeCartController::class, 'search'])->name('search');


    Route::get('/frontend/search/advanced', [SearchAdvancedController::class, 'index']);
    Route::post('/frontend/search/advanced', [SearchAdvancedController::class, 'index']);


    Route::post('/price-range/ajax', [PriceRangeController::class, 'ajaxPriceRange']);

    Route::get('/frontend/contact', [OnePageController::class, 'contact']);
    Route::get('/frontend/404', [OnePageController::class, 'error']);



    Route::get('/frontend/category/{id}', [CategoriesController::class, 'showByCategory'])->name('category.show');

    Route::get('/frontend/brand/{id}', [BrandsController::class, 'showByBrand'])->name('brand.show');




    Route::get('/frontend/wishlist', [WishlistController::class, 'index']);

    

});


// Route::get('/member/login', function () {
//     return view('/member.login'); 
// })->middleware('memberNotLogin');


// Route::get('/member/register', function () {
//     return view('/member.register'); 
// })->middleware('memberNotLogin');


// Route::get('/member/account', function () {
//     return view('/member/account'); 
// })->middleware('memberNotLogin');


// Route::group([
//     'middlewaress' => ['memberNotLogin']
// ], function () {


//     Route::get('/member/login', [MemberController::class, 'showlogin']);

    
//     Route::get('/member/register', [MemberController::class, 'showregister']);
// });





















