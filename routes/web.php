<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Mail\userMail;
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

Route::middleware(['web'])->group(function () {
   
    Route::get('clear-cache', function() {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        return "Cache,View is cleared";
    });
    Route::get('/send-mail', function () {

        Mail::to('abdulraof.froutan@gmail.com')->send(new userMail());
    
        return 'A message has been sent to Mailtrap!';
    
    });
    // Route::get('lang/{locale}', 'SiteController@lang_change')->name('lang');
    Route::get('lang/{locale}', function ($locale) {
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            App::setLocale($locale);
            session()->put('locale', $locale);
        }
        return redirect()->back();
    })->name('lang');
    // Route::get('/', function () {
    //     dd("HII");
    //     return view('welcome');
    //     });
    Route::get('kwa_home','KwaController@home')->name('kwa_home');
    Route::get('/','KwaController@home')->name('/');
    // Route::get('/', ['uses' => 'KwaController@home', 'as' => '/']);
    
    Route::get('kwa_news','KwaController@news')->name('kwa_news');
    Route::get('kwa_about','KwaController@about')->name('kwa_about');
    Route::get('kwa_events','KwaController@events')->name('kwa_events');
    Route::get('kwa_projects','KwaController@projects')->name('kwa_projects');
    Route::get('single_project/{id?}','KwaController@single_project')->name('single_project');
    Route::get('kwa_contact','KwaController@contact')->name('kwa_contact');
    Route::post('add-contact','KwaController@add_contact')->name('add-contact');
    Route::get('single_event/{id?}','KwaController@single_event')->name('single_event');
    Route::post('kwa_register','KwaController@kwa_register')->name('kwa_register');
    Route::get('kwa_gallery','KwaController@kwa_gallery')->name('kwa_gallery');
    Route::post('add-inqueiy','KwaController@add_inquiry')->name('add-inquiry');
   
    Route::get('blogs',['uses'=>'SchoolController@blog_index','as'=>'blogs']);
    Route::get('load-blogs',['uses'=>'SchoolController@load_blog']);
    Route::get('show-blog/{id}',['uses'=>'SchoolController@show_blog','as'=>'show-blog']);
    // //// PayPal
    Route::get('payment-page',['uses'=>'WalletController@payment','as'=>'payment-page']);
    Route::post('pay-with-paypal',['uses'=>'PaymentController@pay_subscription','as'=>'pay-with-paypal']);
    Route::get('payments/{status}',['uses'=>'PaymentController@payments','as'=>'payments']);
    //payment
    Route::get('handle-payment', 'PayPalPaymentController@handlePayment')->name('make.payment');
    Route::get('cancel-payment', 'PayPalPaymentController@paymentCancel')->name('cancel.payment');
    Route::get('payment-success', 'PayPalPaymentController@paymentSuccess')->name('success.payment');

    
});
