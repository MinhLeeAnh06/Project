<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cart\CartController;

use App\Http\Controllers\Front\{
    HomeController,
    ShopController,
    CheckOutController,
    AccountController
};


use App\Http\Controllers\Admin\{
    UserController,
    ProductCategoryController,
    BrandController,
    ProductImageController,
    ProductDetailController,
    ProductController,
    OrderController,
    Statistic,
    BlogDetails,
    BlogImages,
};


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/',[HomeController::class,'index']);
Route::get('blog',[Blog::class,'index']);
Route::get('blog/{id}',[Blog::class,'show']);
Route::prefix('shop')->group(function (){
    Route::get('/',[ShopController::class,'index']);
    Route::get('product/{id}',[ShopController::class,'show']);
    Route::post('product/{id}',[ShopController::class,'postComment']);
    Route::get('',[ShopController::class,'index']);

    Route::get('category/{categoryName}',[ShopController::class,'category']);
});

Route::prefix('cart')->name('cart.')->group(function (){
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('add-cart', [CartController::class, 'store'])->name('store');
    Route::delete('delete/{id}', [CartController::class, 'destroy'])->name('delete');
    Route::put('{id}/update', [CartController::class, 'actionCart'])->name('update');
});

//
//Route::prefix('cart')->group(function (){
//    Route::get('add',[\App\Http\Controllers\Front\CartController::class,'add']);
//    Route::get('/',[\App\Http\Controllers\Front\CartController::class,'index']);
//    Route::get('delete',[\App\Http\Controllers\Front\CartController::class,'delete']);
//    Route::get('destroy',[\App\Http\Controllers\Front\CartController::class,'destroy']);
//    Route::get('update',[\App\Http\Controllers\Front\CartController::class,'update']);
//});

Route::prefix('checkout')->group(function (){
    Route::get('/',[CheckOutController::class , 'index']);
    Route::post('/',[CheckOutController::class , 'addOrder']);
    Route::get('/result',[CheckOutController::class , 'result']);
    Route::get('/vnPayCheck',[CheckOutController::class , 'vnPayCheck']);
});
Route::prefix('account')->group(function (){
    Route::get('login',[AccountController::class , 'login']);
    Route::post('login',[AccountController::class , 'checkLogin']);
    Route::get('logout',[AccountController::class , 'logout']);
    Route::get('register',[AccountController::class , 'register']);
    Route::post('register',[AccountController::class , 'postRegister']);
    Route::prefix('my-order')->middleware('CheckMemberLogin')->group(function (){
        Route::get('/',[AccountController::class, 'myOrderIndex']);
        Route::get('{id}',[AccountController::class, 'myOrderShow']);
    });
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/
Route::prefix('admin')->middleware('CheckAdminLogin')->group(function (){
    Route::redirect('','admin/user');
    Route::resource('user',UserController::class);
    Route::resource('category',ProductCategoryController::class);
    Route::resource('brand',BrandController::class);
    Route::resource('product/{product_id}/image',ProductImageController::class);
    Route::resource('product/{product_id}/detail',ProductDetailController::class);
    Route::resource('product',ProductController::class);
    Route::resource('order',OrderController::class);
    Route::resource('statistical',Statistic::class);
    Route::resource('blog',BlogDetails::class);
    Route::resource('blog/{blogDetail}/image',BlogImages::class);

    Route::prefix('login')->group(function (){
        Route::get('',[\App\Http\Controllers\Admin\HomeController::class, 'getLogin'])->withoutMiddleware('CheckAdminLogin');
        Route::post('',[\App\Http\Controllers\Admin\HomeController::class, 'postLogin'])->withoutMiddleware('CheckAdminLogin');
        });
    Route::get('logout',[\App\Http\Controllers\Admin\HomeController::class, 'logout']);
});

