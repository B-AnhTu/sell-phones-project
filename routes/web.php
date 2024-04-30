<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\DashBoardController;


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
// User
Route::get('dashboard', [UserController::class, 'dashboard']);

Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'authUser'])->name('user.authUser');

Route::get('registration', [UserController::class, 'createUser'])->name('user.createUser');
Route::post('registration', [UserController::class, 'postUser'])->name('user.postUser');

Route::get('signout', [UserController::class, 'signOut'])->name('signout');

//CRUD_Product (chưa chỉnh sửa chỉ mới copy từ chatgpt nên đừng test)
// Route::get('index', [PhoneController::class, 'index'])->name('phones.index');
// Route::get('/phones/{name}', [PhoneController::class, 'showByName'])->name('phones.showByName');
// Route::get('/phones/category/{category}', [PhoneController::class, 'showByCategory'])->name('phones.showByCategory');
// Route::get('/phones/manufacturer/{manufacturer}', [PhoneController::class, 'showByManufacturer'])->name('phones.showByManufacturer');
// Route::post('/phones/search', [PhoneController::class, 'search'])->name('phones.search');
// Route::post('/phones', [PhoneController::class, 'store'])->name('phones.store');
// Route::delete('/phones/{id}', [PhoneController::class, 'destroy'])->name('phones.destroy');
// Route::put('/phones/{id}', [PhoneController::class, 'update'])->name('phones.update');

// Route hiển thị danh sách sản phẩm
Route::get('/phones', [PhoneController::class, 'index'])->name('phones.index');

// Route tìm kiếm sản phẩm
Route::get('/phones/search', [PhoneController::class, 'search'])->name('phones.search');

// Route hiển thị sản phẩm theo danh mục



Route::get('/', function () {
    return view('home');
});


Route::group(['middleware' => 'admin'], function () {
    // Admin routes
    Route::get('index', [DashBoardController::class, 'index'])->name('admin.index');
    Route::get('profile', [DashBoardController::class, 'profile'])->name('admin.profile');
    //User routes
    Route::get('read', [UserController::class, 'readUser'])->name('user.readUser');

    Route::get('delete', [UserController::class, 'deleteUser'])->name('user.deleteUser');

    Route::get('update', [UserController::class, 'updateUser'])->name('user.updateUser');
    Route::post('update', [UserController::class, 'postUpdateUser'])->name('user.postUpdateUser');

    Route::get('list', [UserController::class, 'listUser'])->name('user.list');

});
