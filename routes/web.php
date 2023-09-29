<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;

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

Route::get('/', [HomeController::Class, 'frontpage']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [HomeController::Class, 'redirect'])->name('dashboard');
});

Route::get('/redirect', [HomeController::Class, 'redirect'])->middleware('auth','verified');

Route::get('/logout', 'Auth\LoginController@logout');

// Category
Route::get('/add_product_category',[AdminController::Class, 'add_category']);
Route::post('/save_category',[AdminController::Class, 'save_category']);
Route::get('/view_category', [AdminController::Class, 'view_category']);
Route::get('/delete_category/{id}', [AdminController::Class, 'delete_category']);

// Product 

Route::get('/add_product',[AdminController::Class, 'add_product']);
Route::post('/save_product',[AdminController::Class, 'save_product']);
Route::get('/view_product', [AdminController::Class, 'view_product']);
Route::get('/delete_product/{id}', [AdminController::Class, 'delete_product']);
Route::get('/edit_product/{id}', [AdminController::Class, 'edit_product']);
Route::post('/update_product/{id}', [AdminController::Class, 'update_product']);

//Product Show in Home
Route::get('/products',[HomeController::Class, 'products']);
Route::get('/product_details/{id}',[HomeController::Class, 'product_details']);
Route::post('/add_cart/{id}', [HomeController::Class, 'add_cart']);
Route::get('/show_cart', [HomeController::Class, 'show_cart']);
Route::get('/delete_cart/{id}', [HomeController::Class, 'delete_cart']);
Route::get('/cash_on_delivery', [HomeController::Class, 'cash_on_delivery']);
Route::get('/stripe_payment/{total}', [HomeController::Class, 'stripe_payment']);
Route::post('stripe/{total}', [HomeController::Class,'stripePost'])->name('stripe.post');
Route::get('/show_order', [HomeController::Class, 'show_order']);
Route::get('/delete_order/{id}', [HomeController::Class, 'delete_order']);
Route::get('/search_product', [HomeController::Class, 'search_product']);
Route::post('/add_comment', [HomeController::Class, 'add_comment']);
Route::post('/add_reply', [HomeController::Class, 'add_reply']);

//orders view in admin
Route::get('/view_all_orders', [AdminController::Class, 'view_all_orders']);
Route::get('/deliver_order/{id}', [AdminController::Class, 'deliver_order']);
Route::get('/cash_received/{id}', [AdminController::Class, 'cash_received']);
Route::get('/print_pdf/{id}', [AdminController::Class, 'print_pdf']);
Route::get('/download_orders_pdf', [AdminController::Class, 'download_orders_pdf']);
Route::get('/send_email/{id}', [AdminController::Class, 'send_email']);
Route::post('/send_buyer_email/{id}', [AdminController::Class,'send_buyer_email']);
Route::get('/search_order', [AdminController::Class, 'search_order']);


