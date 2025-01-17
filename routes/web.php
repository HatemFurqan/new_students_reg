<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SemesterRegistrationController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\CouponController;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middl eware group. Now create something great!
|
*/

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function()
{

    // one to one
    Route::get('/', [SemesterRegistrationController::class, 'indexOneToOne'])->name('semester.indexOneToOne');
    Route::post('/subscribeNewStudent', [RegisterController::class, 'subscribeNewStudent'])->name('semester.subscribeOneToOne');

    // get student info
    Route::get('/semester-registration/get-student-info', [SemesterRegistrationController::class, 'getStudentInfo'])->name('semester.registration.getStudentInfo');

    Route::get('/thank-you-page', [SemesterRegistrationController::class, 'thankYouPage'])->name('semester.thankYouPage');

    // import files to database
//    Route::get('/importCountries', [ImportController::class, 'importCountries']);
//    Route::get('/importStudents', [ImportController::class, 'importStudents']);

    // apply coupon
    Route::get('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('apply.coupon');

});

Route::get('/clear-cache', function() {
    Artisan::call('optimize:clear');
    echo "Cleared";
});

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
