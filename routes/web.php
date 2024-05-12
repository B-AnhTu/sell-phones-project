<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ManufacturerController;

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
// Login, logout, register
//Route::get('dashboard', [UserController::class, 'dashboard']);

Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'authUser'])->name('user.authUser');

Route::get('registration', [UserController::class, 'createUser'])->name('user.createUser');
Route::post('registration', [UserController::class, 'postUser'])->name('user.postUser');

Route::get('signout', [UserController::class, 'signOut'])->name('signout');

// Route hiển thị danh sách sản phẩm
// Route::get('/', [DashBoardController::class, 'index'])->name('index');

//Trang mặc định
Route::get('/dashboard', [DashBoardController::class, 'index'])->middleware('role');
//Trang chủ (chưa đăng nhập)
Route::get('home', [PhoneController::class, 'index'])->name('home');

//Trang chủ đã đăng nhập
Route::get('phone/index', [PhoneController::class, 'index'])->name('phone.index');

// Route tìm kiếm sản phẩm
Route::get('/phones/search', [PhoneController::class, 'search'])->name('phones.search');

// Route hiển thị sản phẩm theo danh mục
Route::get('/phone/category/{id}', [PhoneController::class, 'showByCategory'])->name('categories.show');

// Route hiển thị sản phẩm theo hãng sản xuất
Route::get('/phone/manufacturers/{id}', [PhoneController::class, 'showByManufacturer'])->name('manufacturers.show');

//Route giỏ hàng
Route::get('/carts', [CartController::class, 'index'])->name('carts.index');
Route::post('/carts/add', [CartController::class, 'add'])->name('carts.add');
Route::post('/carts/update', [CartController::class, 'update'])->name('carts.update');
Route::post('/carts/remove', [CartController::class, 'remove'])->name('carts.remove');
Route::get('/carts/search', [CartController::class, 'search'])->name('carts.search');

Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/add-to-cart/{productId}', [CartController::class, 'addToCart'])->name('cart.add');

// Admin routes
Route::get('index', [DashBoardController::class, 'adminIndex'])->name('admin.index');

//Manufacturer routes
Route::get('manufacturer/index', [ManufacturerController::class, 'index'])->name('manufacturer.index');

Route::group(['middleware' => 'role'], function () {
    //Trang chủ Admin
    Route::get('admin/dashboard', [DashBoardController::class, 'adminIndex'])->name('admin.dashboard');
    Route::get('admin/profile', [DashBoardController::class, 'adminProfile'])->name('admin.profile');
    //User routes
    Route::get('admin/read', [UserController::class, 'readUser'])->name('user.readUser');
    
    Route::get('admin/delete', [UserController::class, 'deleteUser'])->name('user.deleteUser');
    
    Route::get('admin/update', [UserController::class, 'updateUser'])->name('user.updateUser');
    Route::post('admin/update', [UserController::class, 'postUpdateUser'])->name('user.postUpdateUser');
    
    Route::get('admin/list', [UserController::class, 'listUser'])->name('user.list');
    Route::get('admin/sort/{direction}', [UserController::class, 'sortUser'])->name('user.sort');
    
    //Phone routes
    Route::get('phones/index', [PhoneController::class, 'adminIndex'])->name('phones.adminIndex');
    
    Route::get('phones/add', [PhoneController::class, 'createPhone'])->name('phones.addPhone');
    Route::post('phones/add', [PhoneController::class, 'postCreatePhone'])->name('phones.postCreatePhone');
    
    Route::get('phones/update', [PhoneController::class, 'updatePhone'])->name('phones.updatePhone');
    Route::post('phones/update', [PhoneController::class, 'postUpdatePhone'])->name('phones.postUpdatePhone');
    
    Route::delete('phones/delete', [PhoneController::class, 'deletePhone'])->name('phones.deletePhone');
    
    //Category routes
    Route::get('categories/index', [CategoryController::class, 'index'])->name('categories.index');
    
    Route::get('categories/add', [CategoryController::class, 'createCategory'])->name('categories.createCategory');
    Route::post('categories/add', [CategoryController::class, 'postCreateCategory'])->name('categories.postCreateCategory');
    
    Route::get('categories/update', [CategoryController::class, 'updateCategory'])->name('categories.updateCategory');
    Route::post('categories/update', [CategoryController::class, 'postUpdateCategory'])->name('categories.postUpdateCategory');
    
    Route::delete('categories/delete', [CategoryController::class, 'deleteCategory'])->name('categories.deleteCategory');
});


//Sắp xếp sản phẩm
Route::get('phones/sort-by-name', [PhoneController::class, 'sortByPhoneName'])->name('phones.sortByName');
Route::get('phones/sort-by-purchase-date', [PhoneController::class, 'sortByPurchaseDate'])->name('phones.sortByPurchaseDate');
Route::get('phones/sort-by-quantity', [PhoneController::class, 'sortByQuantity'])->name('phones.sortByQuantity');
Route::get('phones/sort-by-price', [PhoneController::class, 'sortByPrice'])->name('phones.sortByPrice');