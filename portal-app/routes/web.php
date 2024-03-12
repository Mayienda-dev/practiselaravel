<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CmsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('/admin')->group(function(){
    // Admin Login
    Route::match(['get','post'], 'login', [AdminController::class, 'login']);
    Route::group(['middleware'=>['admin']], function(){

        // Admin Dashboard
        Route::get('dashboard', [AdminController::class, 'dashboard']);

        // Admin Update Password
        Route::match(['get','post'], 'update-password', [AdminController::class, 'updatePassword']);

        // Admin check current password
        Route::post('check-current-password', [AdminController::class, 'checkCurrentPwd']);

        // Admin update details
        Route::match(['get','post'], 'update-details', [AdminController::class, 'updateDetails']);

        // Admin Logout
        Route::get('logout', [AdminController::class, 'logout']);

        // CMS Pages
        Route::match(['get', 'post'], 'cms-pages', [CmsController::class, 'index']);

        // Add and Edit CMS Pages
        Route::match(['get', 'post'], 'add-edit-cms-pages/{id?}',[CmsController::class, 'edit']);

        // updateCMSPage Status
        Route::post('update-cms-status', [CmsController::class, 'update']);

        // Delete CMS Page
        Route::get('delete-cms-page/{id?}', [CmsController::class, 'destroy']);

        // Sub admins 
        Route::get('subadmins', [AdminController::class, 'subadmin']);

        // Sub admin: update status
        Route::post('update-subadmin-status', [AdminController::class, 'updateSubAdminStatus']);

        // Sub admin: Add/ Edit Sub admin
        Route::match(['get', 'post'], 'add-edit-subadmins/{id?}', [AdminController::class, 'addEditSubAdmin']);

        // Delete subadmin
        Route::get('delete-subadmin/{id?}', [AdminController::class, 'deleteSubadmin']);

        // Update Roles and Permissons for Sub admin
        Route::match(['get', 'post'], 'update-role/{id}', [AdminController::class, 'updateSubadminRoles']);
       
    });

});


