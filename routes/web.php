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



// Routes for roomtype
Route::get('/view_roomtype/SearchByKeyword', [AdminController::class, 'roomtypeSearchByKeyword'])->middleware(['auth', 'admin']);

Route::get('/add_roomtype', [AdminController::class, 'add_roomtype'])->middleware(['auth', 'admin']);
Route::get('admin/view_roomtype', [AdminController::class, 'view_roomtype'])->name('view_roomtype')->middleware(['auth', 'admin']);
Route::post('/add_roomtype/save', [AdminController::class, 'save_roomtype'])->middleware(['auth', 'admin']);
Route::get('delete_roomtype/{id}', [AdminController::class, 'delete_roomtype'])->middleware(['auth', 'admin']);

Route::post('update_roomtype/{id}', [AdminController::class, 'update_roomtype'])->name('update_roomtype')->middleware(['auth', 'admin']);





// Hotel Service Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/hotel-services', [AdminController::class, 'viewHotelServices'])->name('view_hotel_services');
    Route::get('/hotel-service/add', [AdminController::class, 'addHotelService'])->name('add_hotel_service');
    Route::post('/hotel-service/save', [AdminController::class, 'saveHotelService']);
    Route::get('/hotel-service/edit/{id}', [AdminController::class, 'editHotelService'])->name('edit_hotel_service');
    Route::post('/hotel-service/update/{id}', [AdminController::class, 'updateHotelService'])->name('update_hotel_service');
    Route::get('/hotel-service/delete/{id}', [AdminController::class, 'deleteHotelService'])->name('delete_hotel_service');
});



//Route for Hotel
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/view_hotel', [AdminController::class, 'view_hotel'])->name('view_hotel');
    Route::get('/add_hotel', [AdminController::class, 'add_hotel'])->name('add_hotel');
    Route::post('/add_hotel/save', [AdminController::class, 'save_Hotel'])->name('save_hotel');
    Route::get('/edit_hotel/{id}', [AdminController::class, 'edit_Hotel'])->name('edit_hotel');
    Route::post('/update_hotel/{id}', [AdminController::class, 'update_hotel'])->name('update_hotel');
    Route::get('/delete_hotel/{id}', [AdminController::class, 'delete_Hotel'])->name('delete_hotel');
});



Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/search_ticketType', [AdminController::class, 'ticketTypeSearchByKeyword'])->middleware(['auth', 'admin']);
    Route::get('/ticket-type', [AdminController::class, 'view_ticketType'])->name('view_ticketType');
    Route::get('/add-ticket-type', [AdminController::class, 'add_ticketType'])->name('add_ticketType');
    Route::post('/add_ticketType/save', [AdminController::class, 'save_ticketType'])->name('save_ticketType');
    Route::get('/delete_ticketType/{id}', [AdminController::class, 'delete_ticketType'])->name('delete_ticketType');
});




// Routes for transport services
Route::get('/transport_services/search', [AdminController::class, 'transportServiceSearchByKeyword'])->middleware(['auth', 'admin']);

Route::get('/transport_services/add', [AdminController::class, 'add_transport_service'])->middleware(['auth', 'admin']);
Route::get('/admin/transport_services', [AdminController::class, 'view_transport_service'])->name('view_transport_service')->middleware(['auth', 'admin']);
Route::post('add_transport_service/save', [AdminController::class, 'save_transport_service'])->middleware(['auth', 'admin']);
Route::get('/transport_services/delete/{id}', [AdminController::class, 'delete_transport_service'])->middleware(['auth', 'admin']);

Route::get('/transport_services/edit/{id}', [AdminController::class, 'edit_transport_service'])->middleware(['auth', 'admin']);
Route::post('/transport_services/update/{id}', [AdminController::class, 'update_transport_service'])->name('update_transport_service')->middleware(['auth', 'admin']);





//Route for contract

Route::get('/contracts/search', [AdminController::class, 'contractSearchByKeyword'])->middleware(['auth', 'admin']);

Route::get('/contracts/add', [AdminController::class, 'add_contract'])->middleware(['auth', 'admin']);
Route::get('/admin/contracts', [AdminController::class, 'view_contracts'])->name('view_contracts')->middleware(['auth', 'admin']);
Route::post('/contracts/save', [AdminController::class, 'save_contract'])->middleware(['auth', 'admin']);
Route::get('/contracts/delete/{id}', [AdminController::class, 'delete_contract'])->middleware(['auth', 'admin']);

Route::get('/contracts/edit/{id}', [AdminController::class, 'edit_contract'])->middleware(['auth', 'admin']);
Route::post('/contracts/update/{id}', [AdminController::class, 'update_contract'])->name('update_contract')->middleware(['auth', 'admin']);






//route for agent
Route::get('/agents/search', [AdminController::class, 'agentSearchByKeyword'])->middleware(['auth', 'admin']);
Route::get('/agents/add', [AdminController::class, 'add_agent'])->middleware(['auth', 'admin']);
Route::get('/admin/agents', [AdminController::class, 'view_agent'])->name('view_agent')->middleware(['auth', 'admin']);
Route::post('/agents/save', [AdminController::class, 'save_agent'])->middleware(['auth', 'admin']);
Route::get('/agents/delete/{id}', [AdminController::class, 'delete_agent'])->middleware(['auth', 'admin']);
Route::get('/agents/edit/{id}', [AdminController::class, 'edit_agent'])->middleware(['auth', 'admin']);
Route::post('/agents/update/{id}', [AdminController::class, 'update_agent'])->name('update_agent')->middleware(['auth', 'admin']);




