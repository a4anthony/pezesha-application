<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/marvel/characters',
    [\App\Http\Controllers\MarvelController::class, 'getList'])
    ->name('get.marvel');

Route::post('/invoice-import',
    [\App\Http\Controllers\InvoiceController::class, 'import'])
    ->name('invoice.import');
