<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\WatchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//in tutte le rotte api è sottointeso /api davanti all'uri della rotta, esempio /api/watches
Route::get('watches', [WatchController::class, 'index']);
Route::get('watches/{slug}', [WatchController::class, 'show']);
Route::post('contacts', [ContactController::class, 'store']);