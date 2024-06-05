<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChambreController;
use App\Http\Controllers\ChambreTypeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\PaymentController;

use App\Http\Controllers\StripeController;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('chambres', ChambreController::class);
Route::resource('chambre_types', ChambreTypeController::class);
Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation.index')->middleware('auth');
// routes/web.phpuse App\Http\Controllers\PaymentController;
Route::get('/logout', [DashController::class, 'logout'])->name('logout');

Route::post('/create-checkout-session', [StripeController::class, 'createCheckoutSession'])->name('create-checkout-session');
Route::get('/checkout/success', [StripeController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [StripeController::class, 'cancel'])->name('checkout.cancel');
Route::get('debug', function (Request $request) {
    $numero = $request->query('numero');
    $error = $request->query('error');
    return view('debug', ['numero' => $numero, 'error' => $error]);
})->name('debug.view');

// Route pour l'étape suivante après la réservation
Route::get('/download/invoice/{id}', [StripeController::class, 'downloadInvoice'])->name('download.invoice');


Route::get('/hotel_dash', [DashController::class, 'index'])->name('hotel_dash.index');
Route::get('/hotel_dash/chambre_maintenance', [DashController::class, 'chambreMaintenance'])->name('hotel_dash.chambre_maintenance');
Route::post('/hotel_dash/chambre', [DashController::class, 'storeChambre'])->name('hotel_dash.storeChambre');
Route::put('/hotel_dash/chambre/{id}', [DashController::class, 'updateChambre'])->name('hotel_dash.updateChambre');
Route::get('/hotel_dash/chambre/{id}', [DashController::class, 'chambreMaintenanceDetails'])->name('hotel_dash.chambreMaintenanceDetails');
Route::delete('/hotel_dash/chambre/{id}', [DashController::class, 'deleteChambre'])->name('hotel_dash.deleteChambre');
Route::get('/hotel_dash/form', [DashController::class, 'form'])->name('hotel_dash.form');
Route::get('/hotel_dash/table', [DashController::class, 'table'])->name('hotel_dash.table');
Route::get('/hotel_dash/chart', [DashController::class, 'chart'])->name('hotel_dash.chart');

Route::get('/invoice/download/{id}', [DashController::class, 'downloadInvoice'])->name('download.invoice');



Route::get('/invoice/{id}/download', [DashController::class, 'downloadInvoice'])->name('download.invoice');

Route::get('/dashboard/filter', [DashController::class, 'filter'])->name('dashboard.filter');

Route::get('/chambres', [App\Http\Controllers\HomeController::class, 'chambres'])->name('chambres');


Route::get('/booked_rooms', [ChambreController::class, 'getBookedRooms']);
Route::get('/show_booked_rooms', [ChambreController::class, 'showBookedRooms']);
Route::post('/book_room', [ChambreController::class, 'bookRoom']);


Route::get('/booked_rooms', [ReservationController::class, 'getBookedRooms']);



