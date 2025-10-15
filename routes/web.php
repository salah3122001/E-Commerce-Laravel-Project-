<?php

use App\Http\Controllers\CartController;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreProduct;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\UserController;
use App\Models\Category;

use SimpleSoftwareIO\QrCode\Facades\QrCode;


Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/qr', function () {
    $url = url('https://elross.com');
    return view('qr', compact('url'));
});



Route::get('producttable', [ProductController::class, 'productTable'])->name('prodtable');

// الصفحات العامة - أي حد يقدر يدخلها
Route::get('/', [CategoryController::class, 'getCategories'])->name('mainPage');

Route::group(['prefix' => 'product'], function () {
    Route::get('/', [ProductController::class, 'getAllProducts'])->name('allproducts');
    Route::get('/{category_id}', [ProductController::class, 'getProducts'])->name('cat_prods');
    Route::get('/ProdutDetails/{id}', [ProductController::class, 'ProdutDetails'])->name('ProdutDetails');
});

Route::get('/category', [CategoryController::class, 'AllCategories'])->name('categories');
Route::post('/search', [ProductController::class, 'search'])->name('search');

Route::get('/reviews', [ReviewsController::class, 'getReviews'])->name('getreviews');
Route::post('/storereview', [ReviewsController::class, 'storeReview'])->name('storereviews');

// الصفحات اللي محتاجة تسجيل دخول
Route::middleware(['auth', 'isUser', 'verified'])->group(function () {
    Route::get('/cart', [CartController::class, 'cart'])->name('cart');
    Route::post('/addcart/{id?}', [CartController::class, 'addcart'])->name('addcart');
    Route::get('/deletecart/{id?}', [CartController::class, 'deleteFromCart'])->name('deletecart');
    Route::post('/editcart/{id?}', [CartController::class, 'editCart'])->name('editcart');

    Route::get('/completeOrder', [OrderController::class, 'completeOrder'])->name('completeOrder');
    Route::post('/StoreOrder', [OrderController::class, 'StoreOrder'])->name('StoreOrder');
    Route::get('/previousorders', [OrderController::class, 'previousorders'])->name('previousorders');
    Route::get('/profile/{id?}', [UserController::class, 'profile'])->name('userProfile');
    Route::get('/editProfile/{id?}', [UserController::class, 'editProfile'])->name('editProfile');
    Route::post('/updateProfile/{id?}', [UserController::class, 'updateProfile'])->name('updateProfile');

    Route::get('/checkout', [StripeController::class, 'checkout'])->name('checkout');
    Route::post('/session', [StripeController::class, 'session'])->name('session');
    Route::get('/stripe/success/{order}', [StripeController::class, 'success'])->name('stripe.success');
    Route::get('/stripe/cancel/{order}', [StripeController::class, 'cancel'])->name('stripe.cancel');

    Route::get('/payment-success', [OrderController::class, 'pay_success'])->name('payment_success');
});

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/addproduct', [ProductController::class, 'addproduct'])->name('addproduct');
    Route::post('/storeproduct', [ProductController::class, 'storeproduct'])->name('storeproduct');
    Route::get('/products', [DashboardController::class, 'getAllProducts'])->name('allproductsforadmin');
    Route::get('/editproduct/{id?}', [ProductController::class, 'editproduct'])->name('editproduct');
    Route::post('/updateproduct/{id?}', [ProductController::class, 'updateproduct'])->name('updateproduct');
    Route::get('/deleteproduct/{product_id?}', [ProductController::class, 'deleteproduct'])->name('deleteproduct');
    Route::get('/addimages/{id?}', [ProductController::class, 'addimages'])->name('addimages');
    Route::post('/storeimages/{id?}', [ProductController::class, 'storeimages'])->name('storeimages');
    Route::get('/deleteimage/{id?}', [ProductController::class, 'deleteimage'])->name('deleteimage');
    Route::get('product/ProdutDetails/{id}', [DashboardController::class, 'ProdutDetails'])->name('ProdutDetailsforadmin');
    Route::post('/adminsearch', [DashboardController::class, 'search'])->name('adminsearch');

    Route::get('/addcategory', [CategoryController::class, 'addcategory'])->name('addcategory');
    Route::post('/storecategory', [CategoryController::class, 'storecategory'])->name('storecategory');
    Route::get('/editcategory/{id?}', [CategoryController::class, 'editcategory'])->name('editcategory');
    Route::post('/updatecategory/{id?}', [CategoryController::class, 'updatecategory'])->name('updatecategory');
    Route::get('/deletecategory/{product_id?}', [CategoryController::class, 'deletecategory'])->name('deletecategory');


    Route::get('/category/{category_id}', [DashboardController::class, 'getProducts'])->name('cat_prodsforadmin');
    Route::get('/', [DashboardController::class, 'getCategories'])->name('mainPageforadmin');
    Route::get('/category', [DashboardController::class, 'AllCategoriesforadmin'])->name('categoriesforadmin');
    Route::get('/charts', [DashboardController::class, 'charts'])->name('charts');

    Route::get('/profile/{id?}', [UserController::class, 'adminProfile'])->name('adminProfile');
    Route::get('/editProfile/{id?}', [UserController::class, 'editAdminProfile'])->name('editProfileforadmin');
    Route::post('/updateProfile/{id?}', [UserController::class, 'updateAdminProfile'])->name('updateProfileforadmin');

    Route::get('producttable', [DashboardController::class, 'productTableAdmin'])->name('prodtableadmin');

    Route::get('/recentOrders', [DashboardController::class, 'recentorders'])->name('recentorders');
    Route::get('/users', [DashboardController::class, 'getUsers'])->name('getUsers');
});


Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session()->put('locale', $locale);
    }
    // dd(session('locale'));

    return back();
})->name('lang');
