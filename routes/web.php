<?php

use App\Http\Controllers\Admin\WatchController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});


/* CRUD **************/
//index di tutti gli orologi
Route::get('/dashboard', [WatchController::class, 'index'])
->middleware(['auth', 'verified'])->name('dashboard');

//show, create, update, delete
Route::middleware(['auth', 'verified'])->prefix('watches')
->name('watches.')->group(function () {
    //show
    Route::get('watch/{slug}', [WatchController::class, 'show'])->name('show');

    //create e store
    Route::get('form/create', [WatchController::class, 'create'])->name('create');
    Route::post('form/submit', [WatchController::class, 'store'])->name('store');

    //edit e update
    Route::get('watch/{slug}/edit', [WatchController::class, 'edit'])->name('edit');
    Route::put('watch/{slug}', [WatchController::class, 'update'])->name('update');

    //delete (destroy)
    Route::delete('watch/{slug}', [WatchController::class, 'destroy'])->name('destroy');
});

/* ******************/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
