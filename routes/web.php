<?php

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/comments', function () {
    return view('comments');
})->middleware(['auth', 'verified'])->name('comments');

Route::get('/yunUser', function () {
    return view('yunUser');
})->middleware(['auth', 'verified'])->name('yunUser');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/feed', [\App\Http\Controllers\CommentsController::class, 'getFeed'])->name('comments.feed');
    Route::post('/yunUser-rank', [\App\Http\Controllers\yunUserController::class, 'getRank'])->name('yunUser.rank');

});

require __DIR__.'/auth.php';
