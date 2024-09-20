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
route::get('/view_user/SearchByKeyword', [AdminController::class, 'userSearchByKeyword'])->middleware(['auth', 'admin']);

Route::get('/add_user', [AdminController::class, 'add_user'])->middleware(['auth', 'admin']);
Route::get('admin/view_user', [AdminController::class, 'view_user'])->name('view_user')->middleware(['auth', 'admin']);
Route::post('/add_user/save', [AdminController::class, 'save_user'])->middleware(['auth', 'admin']);
Route::get('delete_user/{id}', [AdminController::class, 'delete_user'])->middleware(['auth', 'admin']);

Route::get('edit_user/{id}', [AdminController::class, 'editUser'])->name('edit_user');
Route::post('update_user/{id}', [AdminController::class, 'updateUser'])->name('update_user');




//Route for Country
route::get('/view_country/SearchByKeyword', [AdminController::class, 'countrySearchByKeyword'])->middleware(['auth', 'admin']);

Route::get('/add_country', [AdminController::class, 'add_country'])->middleware(['auth', 'admin']);
Route::get('admin/view_country', [AdminController::class, 'view_country'])->name('view_country')->middleware(['auth', 'admin']);
Route::post('/add_country/save', [AdminController::class, 'save_country'])->middleware(['auth', 'admin']);
Route::get('delete_country/{id}', [AdminController::class, 'delete_country'])->middleware(['auth', 'admin']);

Route::get('edit_country/{id}', [AdminController::class, 'edit_country'])->name('edit_country');
Route::post('update_country/{id}', [AdminController::class, 'update_country'])->name('update_country');


// Routes for City
Route::get('/view_city/SearchByKeyword', [AdminController::class, 'citySearchByKeyword'])->middleware(['auth', 'admin']);

Route::get('/add_city', [AdminController::class, 'add_city'])->middleware(['auth', 'admin']);
Route::get('admin/view_city', [AdminController::class, 'view_city'])->name('view_city')->middleware(['auth', 'admin']);
Route::post('/add_city/save', [AdminController::class, 'save_city'])->middleware(['auth', 'admin']);
Route::get('delete_city/{id}', [AdminController::class, 'delete_city'])->middleware(['auth', 'admin']);

Route::get('edit_city/{id}', [AdminController::class, 'edit_city'])->name('edit_city')->middleware(['auth', 'admin']);
Route::post('update_city/{id}', [AdminController::class, 'update_city'])->name('update_city')->middleware(['auth', 'admin']);


//Route for Hotel
route::get('/view_hotel/SearchByKeyword', [AdminController::class, 'hotelSearchByKeyword'])->middleware(['auth', 'admin']);

Route::get('/add_hotel', [AdminController::class, 'add_hotel'])->middleware(['auth', 'admin']);
Route::get('admin/view_hotel', [AdminController::class, 'view_hotel'])->name('view_hotel')->middleware(['auth', 'admin']);
Route::post('/add_hotel/save', [AdminController::class, 'save_hotel'])->middleware(['auth', 'admin']);
Route::get('delete_hotel/{id}', [AdminController::class, 'delete_hotel'])->middleware(['auth', 'admin']);

Route::get('edit_hotel/{id}', [AdminController::class, 'edithotel'])->name('edit_hotel');
Route::post('update_hotel/{id}', [AdminController::class, 'updatehotel'])->name('update_hotel');





//Route for product_details
Route::get('product_details/{id}', [HomeController::class, 'product_details']);





