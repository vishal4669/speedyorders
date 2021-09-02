<?php

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
Route::get('/', function(){
   return redirect()->route('admin.login');
});

use App\Http\Controllers\MoneySetupController;
use App\Http\Controllers\PayPalPaymentController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');

Route::post('/addtocart', [HomeController::class, 'addToCart'])->name('addtocart');
Route::post('/removefromcart', [HomeController::class, 'removeFromCart'])->name('removefromcart');

//Route::get('test', 'TestController@test');
//Route::get('pdf-design', 'TestController@pdfDesignTest');
//Route::get('/closeSession', 'TestController@closeSession');

if ( config('app.env') == 'production' ) {
    URL::forceScheme('https');
}

Route::get('/admin/', function(){
   return redirect()->route('admin.login');
});


// Paypal Routes
Route::get('handle-payment', [PayPalPaymentController::class, 'handlePayment'])->name('make.payment');
Route::get('cancel-payment', [PayPalPaymentController::class, 'paymentCancel'])->name('cancel.payment');
Route::get('payment-success', [PayPalPaymentController::class, 'paymentSuccess'])->name('success.payment');

Route::post('pay-stripe',[MoneySetupController::class, 'stripe'])->name('stripe.pay');
Route::post('stripe', [MoneySetupController::class, 'stripePost'])->name('stripe.post');


Route::get('stripeform',[MoneySetupController::class, 'stripe'])->name('stripeform');


