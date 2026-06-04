<?php

use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeadCommunicationsController;
use App\Http\Controllers\LoanApplicationsController;
use App\Http\Controllers\LoanGeneratedDocumentsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Route;

include '_utilities.php';

// Route::redirect('/', 'dashboard');

Route::get('/', function () {
    return view('frontend.index');
});

Route::view('/about-us', 'frontend.about-us');
Route::view('/loans', 'frontend.loans');
Route::view('/contact-us', 'frontend.contact-us');

Route::get('apply-loan', [\App\Http\Controllers\Frontends\ApplyLoanController::class, 'index'])->name('frontend.apply-loan');
Route::post('apply-loan', [\App\Http\Controllers\Frontends\ApplyLoanController::class, 'store'])->name('frontend.apply-loan.store');

Route::group(['middleware' => ['auth:web']], function () {

    Route::get('/dashboard', DashboardController::class)->middleware('can:dashboard.view')->name('home');

    Route::get('admin-users', [AdminUsersController::class, 'index'])->middleware('can:admin-users.view')->name('admin-users.index');
    Route::post('admin-users', [AdminUsersController::class, 'storeOrUpdate'])->middleware('can:admin-users.manage')->name('admin-users.storeOrUpdate');
    Route::get('admin-users/{adminUser}', [AdminUsersController::class, 'edit'])->middleware('can:admin-users.manage')->name('admin-users.edit');
    Route::delete('admin-users/{adminUser}', [AdminUsersController::class, 'destroy'])->middleware('can:admin-users.manage')->name('admin-users.delete');

    Route::get('roles', [RolesController::class, 'index'])->middleware('can:roles.view')->name('roles.index');
    Route::post('roles', [RolesController::class, 'storeOrUpdate'])->middleware('can:roles.manage')->name('roles.storeOrUpdate');
    Route::get('roles/{role}', [RolesController::class, 'edit'])->middleware('can:roles.manage')->name('roles.edit');
    Route::delete('roles/{role}', [RolesController::class, 'destroy'])->middleware('can:roles.manage')->name('roles.delete');

    Route::get('loan-applications', [LoanApplicationsController::class, 'index'])->middleware('can:leads.view')->name('loan-applications.index');
    Route::get('loan-applications/{loanApplication}', [LoanApplicationsController::class, 'show'])->middleware('can:leads.view')->name('loan-applications.show');
    Route::post('loan-applications/{loanApplication}/status', [LoanApplicationsController::class, 'updateStatus'])->middleware('can:leads.manage')->name('loan-applications.status');
    Route::post('loan-applications/{loanApplication}/documents', [LoanApplicationsController::class, 'storeDocument'])->middleware('can:documents.upload')->name('loan-applications.documents.store');
    Route::post('loan-applications/{loanApplication}/documents/{loanDocument}/status', [LoanApplicationsController::class, 'updateDocumentStatus'])->middleware('can:documents.verify')->name('loan-applications.documents.status');
    Route::post('loan-applications/{loanApplication}/follow-ups', [LoanApplicationsController::class, 'storeFollowUp'])->middleware('can:leads.manage')->name('loan-applications.follow-ups.store');
    Route::post('loan-applications/{loanApplication}/generated-documents', [LoanGeneratedDocumentsController::class, 'store'])->middleware('can:generated-documents.manage')->name('loan-applications.generated-documents.store');
    Route::post('loan-applications/{loanApplication}/communications', [LeadCommunicationsController::class, 'store'])->middleware('can:communications.send')->name('loan-applications.communications.store');
    Route::get('generated-documents/{loanGeneratedDocument}', [LoanGeneratedDocumentsController::class, 'show'])->middleware('can:leads.view')->name('loan-generated-documents.show');

    Route::get('customers', [CustomersController::class, 'index'])->middleware('can:customers.view')->name('customers.index');
    Route::get('customers/{customer}', [CustomersController::class, 'show'])->middleware('can:customers.view')->name('customers.show');

    Route::get('categories', [CategoriesController::class, 'index'])->middleware('can:categories.view')->name('categories.index');
    Route::post('categories', [CategoriesController::class, 'storeOrUpdate'])->middleware('can:categories.manage')->name('categories.storeOrUpdate');
    Route::get('categories/{category}', [CategoriesController::class, 'edit'])->middleware('can:categories.manage')->name('categories.edit');
    Route::delete('categories/{category}', [CategoriesController::class, 'destroy'])->middleware('can:categories.manage')->name('categories.delete');

    Route::get('products', [ProductsController::class, 'index'])->middleware('can:products.view')->name('products.index');
    Route::post('products', [ProductsController::class, 'storeOrUpdate'])->middleware('can:products.manage')->name('products.storeOrUpdate');
    Route::get('products/{product}', [ProductsController::class, 'edit'])->middleware('can:products.manage')->name('products.edit');
    Route::delete('products/{product}', [ProductsController::class, 'destroy'])->middleware('can:products.manage')->name('products.delete');

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
