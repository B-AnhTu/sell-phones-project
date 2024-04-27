<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudUserController;
use App\Http\Controllers\PhoneController;


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
// CRUD_User
Route::get('dashboard', [CrudUserController::class, 'dashboard']);

Route::get('login', [CrudUserController::class, 'login'])->name('login');
Route::post('login', [CrudUserController::class, 'authUser'])->name('user.authUser');

Route::get('create', [CrudUserController::class, 'createUser'])->name('user.createUser');
Route::post('create', [CrudUserController::class, 'postUser'])->name('user.postUser');

Route::get('read', [CrudUserController::class, 'readUser'])->name('user.readUser');

Route::get('delete', [CrudUserController::class, 'deleteUser'])->name('user.deleteUser');

Route::get('update', [CrudUserController::class, 'updateUser'])->name('user.updateUser');
Route::post('update', [CrudUserController::class, 'postUpdateUser'])->name('user.postUpdateUser');

Route::get('list', [CrudUserController::class, 'listUser'])->name('user.list');

Route::get('signout', [CrudUserController::class, 'signOut'])->name('signout');

//CRUD_Product (chưa chỉnh sửa chỉ mới copy từ chatgpt nên đừng test)
Route::get('index', [PhoneController::class, 'index'])->name('phones.index');
Route::get('/phones/{name}', [PhoneController::class, 'showByName'])->name('phones.showByName');
Route::get('/phones/category/{category}', [PhoneController::class, 'showByCategory'])->name('phones.showByCategory');
Route::get('/phones/manufacturer/{manufacturer}', [PhoneController::class, 'showByManufacturer'])->name('phones.showByManufacturer');
Route::post('/phones/search', [PhoneController::class, 'search'])->name('phones.search');
Route::post('/phones', [PhoneController::class, 'store'])->name('phones.store');
Route::delete('/phones/{id}', [PhoneController::class, 'destroy'])->name('phones.destroy');
Route::put('/phones/{id}', [PhoneController::class, 'update'])->name('phones.update');


Route::get('/', function () {
    return view('home');
});
