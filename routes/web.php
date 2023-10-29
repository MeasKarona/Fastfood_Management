<?php

use App\Http\Controllers\FoodController;
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

Route::get('/addFood', function () {
    return view('foods.addfood');
});

Route::controller(FoodController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/item_management', 'GetAllFood');
    Route::get('/edit_food/{Id}', 'edit');
    Route::get('/delete_food/{Id}', 'destroy');
    Route::get('/GetItem/{item}', 'SearchFood');
    Route::post('update_foodinfo', 'update');
    Route::post('/store_foodinfo', 'store');
    Route::post('/add_tocart', 'addToCart');
    Route::post('/decrease_fromcart', 'DecreaseFromCart');
    Route::post('/remove_fromcart', 'RemoveFromCart');
    Route::post('/placeorder', 'Order');

});
