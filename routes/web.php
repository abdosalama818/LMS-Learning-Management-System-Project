<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\InfoController;
use App\Http\Controllers\backend\InstractorController;
use App\Http\Controllers\backend\SubCategoryController;
use App\Http\Controllers\backend\InstarctorProfileController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\frontend\FrontendController;
use App\Models\Slider;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/* ******************************************  Admin Routes Start ********************************************************** */
Route::view('admin/login', 'backend.admin.login.index')->name('admin.login');

Route::middleware(['auth','verified','role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('dashboard', 'backend.admin.dashboard.index')->name('dashboard');
    Route::post('logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('profile', [AdminController::class, 'profile'])->name('profile');
    Route::get('setting', [AdminController::class, 'setting'])->name('setting');
    Route::patch('profile/store', [AdminController::class, 'updateProfile'])->name('profile.store');
    Route::post('password/update', [AdminController::class, 'updatePassword'])->name('passwordSetting');

                /*category routes start */
    Route::resource('category', CategoryController::class);
    Route::resource('subcategory', SubCategoryController::class);
                /*category routes end */

                /*Slider routes start */
    Route::resource('slider', SliderController::class);;
                /*Slider routes end */
                /*Slider routes start */
    Route::resource('info', InfoController::class);;
                /*Slider routes end */




});


/* *********************************************  Admin Routes End ********************************************************** */
/*                                 ##################################################                                      */
/* *********************************************  instructor Routes Start ********************************************************** */
Route::view('instructor/login', 'backend.instructor.login.index')->name('instructor.login');
Route::view('instructor/register', 'backend.instructor.register.index')->name('instructor.register');

Route::middleware(['auth','verified','role:instructor' ])->prefix('instructor')->name('instructor.')->group(function () {

    Route::view('dashboard', 'backend.instructor.dashboard.index')->name('dashboard');
    Route::post('logout', [InstractorController::class, 'logout'])->name('logout');
    Route::get('profile', [InstarctorProfileController::class, 'index'])->name('profile');
    Route::post('profile/store', [InstarctorProfileController::class, 'store'])->name('profile.store');
    Route::get('setting', [InstarctorProfileController::class, 'setting'])->name('setting');
    Route::post('password/update', [InstarctorProfileController::class, 'updatePassword'])->name('passwordSetting');


});
/* ******************************************  instructor Routes Start ********************************************************** */
/*                               ##################################################                                      */







Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



/* ************************************frontend Routes{home page} ****************************/
Route::controller(FrontendController::class)->group(function(){
    Route::get('/','home')->name('frontend.home');
    Route::get('/cart','home')->name('cart');
});


require __DIR__.'/auth.php';
