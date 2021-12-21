<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SemesterRegistrationController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\CouponController;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function()
{

    // one to one
    Route::get('/', [SemesterRegistrationController::class, 'indexOneToOne'])->name('semester.indexOneToOne');
    Route::post('/subscribeOneToOne', [RegisterController::class, 'subscribeOneToOne'])->name('semester.subscribeOneToOne');

    // get student info
    Route::get('/semester-registration/get-student-info', [SemesterRegistrationController::class, 'getStudentInfo'])->name('semester.registration.getStudentInfo');

    // import files to database
//    Route::get('/importCountries', [ImportController::class, 'importCountries']);
//    Route::get('/importStudents', [ImportController::class, 'importStudents']);

    // apply coupon
    Route::get('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('apply.coupon');

});

 Route::get('/test', function (\App\Services\GoogleSheet $googleSheet){
//    dd($googleSheet->readGoogleSheet()[1][0]);
 });

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
