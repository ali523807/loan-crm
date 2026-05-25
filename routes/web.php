<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Route;

include '_utilities.php';

//Route::redirect('/', 'dashboard');

Route::get('/', function () {
    return view('frontend.index');
});

Route::view('/about-us', 'frontend.about-us');
Route::view('/loans', 'frontend.loans');
Route::view('/contact-us', 'frontend.contact-us');

Route::get('apply-loan',[\App\Http\Controllers\Frontends\ApplyLoanController::class,'index'])->name('frontend.apply-loan');

Route::group(['middleware' => ['auth:web']], function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('home');

    Route::get('categories', [CategoriesController::class, 'index'])->name('categories.index');
    Route::post('categories', [CategoriesController::class, 'storeOrUpdate'])->name('categories.storeOrUpdate');
    Route::get('categories/{category}', [CategoriesController::class, 'edit'])->name('categories.edit');
    Route::delete('categories/{category}', [CategoriesController::class, 'destroy'])->name('categories.delete');

    Route::get('products', [ProductsController::class, 'index'])->name('products.index');
    Route::post('products', [ProductsController::class, 'storeOrUpdate'])->name('products.storeOrUpdate');
    Route::get('products/{product}', [ProductsController::class, 'edit'])->name('products.edit');
    Route::delete('products/{product}', [ProductsController::class, 'destroy'])->name('products.delete');

    Route::group(['prefix' => 'settings'], function () {
        Route::get('profile', [ProfileController::class, 'profile'])->name('settings.profile');
        Route::post('profile/delete', [ProfileController::class, 'destroy'])->name('settings.profile.delete');
        Route::get('profile/password-update', [ProfileController::class, 'passwordUpdate'])->name('settings.profile.password-update');
        Route::get('profile/appearance', [ProfileController::class, 'appearance'])->name('settings.profile.appearance');
    });


    /* EXAMPLE CODE CAN BE DELETED ONCE REFERRED */
    Route::view('ui-kit', 'uikit')->name('ui-kit');

    Route::get('tabs/profile', function () {
        return '<p>Profile From Ajax</p>';
    })->name('tabs.profile');

    Route::get('tabs/contact', function () {
        return '<p>Contact In Ajax</p>';
    })->name('tabs.contact');

});
