<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'home']);

// Route::group(['prefix' => 'home'], function() {
//     Route::get('/', [HomeController::class, 'home']);
//     Route::get('/index', [HomeController::class, 'home']);
// });    

Route::get('/dashboard',[HomeController::class, 'home'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//admin route
route::get('admin/dashboard', [HomeController::class, 'index'])-> middleware(['auth', 'admin']);

//route for category
route::get('view_category', [AdminController::class, 'view_category'])-> middleware(['auth', 'admin']);

route::get('searchByKeyword', [AdminController::class, 'searchByKeyword'])->middleware(['auth', 'admin']);

route::post('add_category', [AdminController::class, 'add_category'])-> middleware(['auth', 'admin']);

route::get('delete_category/{id}', [AdminController::class, 'delete_category'])-> middleware(['auth', 'admin']);

Route::get('edit_category/{id}', [AdminController::class, 'editCategory'])->name('edit.category')-> middleware(['auth', 'admin']);

Route::post('category/update', [AdminController::class, 'update'])-> middleware(['auth', 'admin']);

//route for User
route::get('productSearchByKeyword', [AdminController::class, 'productSearchByKeyword'])->middleware(['auth', 'admin']);

Route::get('/add_user', [AdminController::class, 'add_user'])->middleware(['auth', 'admin']);
Route::get('/view_user', [AdminController::class, 'view_user'])->name('view_user')->middleware(['auth', 'admin']);
Route::post('/add_user/save', [AdminController::class, 'save_user'])->middleware(['auth', 'admin']);
Route::get('delete_user/{id}', [AdminController::class, 'delete_user'])->middleware(['auth', 'admin']);

Route::get('edit_user/{id}', [AdminController::class, 'editUser'])->name('edit_user');
Route::post('update_user/{id}', [AdminController::class, 'updateUser'])->name('update_user');


//Route for product_details
Route::get('product_details/{id}', [HomeController::class, 'product_details']);





