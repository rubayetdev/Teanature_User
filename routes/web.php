<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NonUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLoginController;
use Illuminate\Http\Request;
use App\Http\Controllers\DepoController;
use App\Http\Controllers\DepoLoginController;
use App\Http\Controllers\UddoktapayController;

/* Non User Start*/
Route::get('/',[NonUserController::class,'index'])->name('home');

Route::get('/login',[NonUserController::class,'login'])->name('login');

Route::get('/products',[NonUserController::class,'product'])->name('products');

Route::get('/store',[NonUserController::class,'store'])->name('store');

Route::get('/contact',[NonUserController::class,'contact'])->name('contact');

Route::get('/testimonials',[NonUserController::class,'testimonial'])->name('testimonial');

Route::get('/blog',[NonUserController::class,'blog'])->name('blog');

Route::get('/about',[NonUserController::class,'about'])->name('about');

Route::get('/feature',[NonUserController::class,'feature'])->name('feature');

Route::get('/error-not-found',[NonUserController::class,'page'])->name('page');

Route::get('/single-product',[NonUserController::class,'single_product'])->name('single-product');

Route::post('/register-customer',[UserLoginController::class,'registration'])->name('register-customer');

Route::post('/create-orders',[NonUserController::class,'create_orders'])->name('create-orders');

Route::get('/cart', [NonUserController::class, 'viewCart'])->name('cart.view');

Route::post('/cart/remove', [NonUserController::class, 'removeFromCart'])->name('cart.remove');
/* Non User End*/

/* Verification Start*/
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
    $request->fulfill();
    $userId = $request->user();
    $userRoles = $userId->roles;
    event(new \Illuminate\Auth\Events\Verified($request->user()));
    if ($userRoles === 'users') {
        return redirect()->route('welcome', ['id' => $userId]);
    }
    if ($userRoles === 'depo') {
        return redirect()->route('depo-login');
    }
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth'])->name('verification.send');

/* Verification End*/

/* User Start*/
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [UserController::class, 'index'])->name('welcome');

    Route::get('/home/product',[UserController::class,'product'])->name('product');

    Route::get('/home/store',[UserController::class,'store'])->name('stores');

    Route::get('/home/contact',[UserController::class,'contact'])->name('contacts');

    Route::get('/home/testimonials',[UserController::class,'testimonial'])->name('testimonials');

    Route::get('/home/blog',[UserController::class,'blog'])->name('blogs');

    Route::get('/home/about',[UserController::class,'about'])->name('abouts');

    Route::get('/home/feature',[UserController::class,'feature'])->name('features');

    Route::get('/home/error-not-found',[UserController::class,'page'])->name('pages');

    Route::get('/home/single-product',[UserController::class,'single_product'])->name('single-products');

    Route::get('/home/product/cart',[UserController::class,'cart'])->name('cart');

    Route::get('/home/my-profile/order-history',[UserController::class,'order_history'])->name('order_history');

    Route::get('/home/my-profile',[UserController::class,'my_profile'])->name('my_profile');

    Route::get('/home/my-profile/account-settings',[UserController::class,'account_settings'])->name('account_settings');

    Route::post('/update-user-data',[UserController::class,'upload_user_data'])->name('upload_user_data');

    Route::post('/create-order',[UserController::class,'create_order'])->name('create_order');

    Route::get('/checkout',[UserController::class,'checkout'])->name('checkout');

    Route::get('/invoice',[UserController::class,'invoice'])->name('invoice');

    Route::post('/update-Cart',[UserController::class,'update_cart'])->name('update_cart');

    Route::get('/delete_cart',[UserController::class,'deleteCart'])->name('delete_cart');
});

/* User End*/

/* User Login Start*/
Route::post('/loggedIn',[UserLoginController::class,'loggedIn'])->name('loggedIn');

Route::get('/logout',[UserLoginController::class,'logout'])->name('logout');
/* User Login End*/


/* Depo Login & Register Start*/
Route::get('/depo-login',[DepoController::class,'login'])->name('depo-login');

Route::get('/depo/owner-info',[DepoLoginController::class,'verify'])->name('verify');

Route::post('/depo-logged',[DepoLoginController::class,'loggin'])->name('depo-logged');

Route::post('/depo-register',[DepoLoginController::class,'regis'])->name('depo-register');

Route::post('/owner-verfication',[DepoLoginController::class,'owner_info'])->name('owner-verfication');
/* Depo Login & Register End*/


Route::middleware(['auth'])->group(function () {
    Route::get('/depo/home', [DepoController::class, 'depoHome'])->name('depo-welcome');

    Route::get('/depo/product',[DepoController::class,'product'])->name('depo-product');

    Route::get('/depo/store',[DepoController::class,'store'])->name('depo-stores');

    Route::get('/depo/contact',[DepoController::class,'contact'])->name('depo-contacts');

    Route::get('/depo/testimonials',[DepoController::class,'testimonial'])->name('depo-testimonials');

    Route::get('/depo/blog',[DepoController::class,'blog'])->name('depo-blogs');

    Route::get('/depo/about',[DepoController::class,'about'])->name('depo-abouts');

    Route::get('/depo/feature',[DepoController::class,'feature'])->name('depo-features');

    Route::get('/depo/error-not-found',[DepoController::class,'page'])->name('depo-pages');

    Route::get('/depo/single-product',[DepoController::class,'single_product'])->name('depo-single-products');

    Route::get('/depo/product/cart',[DepoController::class,'cart'])->name('depo-cart');

    Route::get('/depo/product/checkout',[DepoController::class,'checkout'])->name('depo-checkout');

    Route::get('/depo/my-profile/order-history',[DepoController::class,'order_history'])->name('depo-order_history');

    Route::get('/depo/my-profile',[DepoController::class,'my_profile'])->name('depo-my_profile');

    Route::get('/depo/my-profile/account-settings',[DepoController::class,'account_settings'])->name('depo-account_settings');

    Route::post('/update-depo-data',[DepoController::class,'upload_depo_data'])->name('upload-depo-data');
});

Route::get( 'pay', [UddoktapayController::class, 'show'] )->name( 'uddoktapay.payment-form' );
Route::post( 'pay', [UddoktapayController::class, 'pay'] )->name( 'uddoktapay.pay' );
Route::get( 'success', [UddoktapayController::class, 'success'] )->name( 'uddoktapay.success' );
Route::get( 'cancel', [UddoktapayController::class, 'cancel'] )->name( 'uddoktapay.cancel' );
Route::post( 'webhook', [UddoktapayController::class, 'webhook'] )->name( 'uddoktapay.webhook' );
//Route::post('/payment',[App\Http\Controllers\UddoktapayController::class,'insertPayment'])->name('payment');


Route::group(['middleware' => ['web']], function () {
    // Payment Routes for bKash
    Route::get('/bkash/payment', [App\Http\Controllers\BkashTokenizePaymentController::class,'index']);
    Route::post('/payment',[App\Http\Controllers\BkashTokenizePaymentController::class,'insertPayment'])->name('payment');
    Route::get('/bkash/create-payment', [App\Http\Controllers\BkashTokenizePaymentController::class,'createPayment'])->name('bkash-create-payment');
    Route::get('/bkash/callback', [App\Http\Controllers\BkashTokenizePaymentController::class,'callBack'])->name('bkash-callBack');

    //search payment
    Route::get('/bkash/search/{trxID}', [App\Http\Controllers\BkashTokenizePaymentController::class,'searchTnx'])->name('bkash-serach');

    //refund payment routes
    Route::get('/bkash/refund', [App\Http\Controllers\BkashTokenizePaymentController::class,'refund'])->name('bkash-refund');
    Route::get('/bkash/refund/status', [App\Http\Controllers\BkashTokenizePaymentController::class,'refundStatus'])->name('bkash-refund-status');

});



