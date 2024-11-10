<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\MenberController;
use App\Http\Controllers\Api\MemberProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     //return $request->user();
    

// // // });
// Route::middleware(['auth:sanctum'])->group(function() {
        
    Route::get('/blog',[BlogController::class, 'list']);
    Route::get('/blog/detail/{id}',[BlogController::class, 'show']);


    Route::get('/product',[ProductController::class, 'index']);
    Route::get('/product/detail/{id}',[ProductController::class, 'show']);
   
// });

Route::post('/login', [MenberController::class, 'postlogin']); 
Route::post('/register', [MenberController::class, 'postregister']); 

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/member/account', [MemberController::class, 'account']);
    Route::post('/member/account', [MemberController::class, 'update'])->name('member.update');

    Route::get('/member/account/my-product', [MemberProductController::class, 'index'])->name('frontend.member.my-product');
    Route::get('/member/account/add-product', [MemberProductController::class, 'add'])->name('products.add');
    Route::post('/member/account/add-product', [MemberProductController::class, 'insert'])->name('products.insert');
    Route::get('/member/account/edit-product/{id}', [MemberProductController::class, 'edit'])->name('products.edit');
    Route::post('/member/account/edit-product/{id}', [MemberProductController::class, 'update'])->name('products.update');
    Route::get('/member/account/delete-product/{id}', [MemberProductController::class, 'delete'])->name('products.delete');
    
});

