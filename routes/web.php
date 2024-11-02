<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;
use App\Http\Controllers\PurificationController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [StockController::class, 'index'])->name('stocks.index');

Route::post('/stocks/import', [StockController::class, 'import'])->name('stocks.import');
Route::get('/stocks/search', [StockController::class, 'search'])->name('stocks.search');

Route::get('/purification-calculator', [PurificationController::class, 'index'])->name('purification.index');
Route::post('/purification-calculate', [PurificationController::class, 'calculate'])->name('purification.calculate');
