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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Role Admin
Route::get('/admin', function(){
    return '<h1>Hallo Admin</h1>';
})->middleware(['auth', 'verified','role:admin']);

// Route Role Penulis
Route::get('/penulis', function(){
    return '<h1>Hallo Penulis</h1>';
})->middleware(['auth', 'verified','role:penulis|admin']); // agar dapat di akses oleh penulis atau admin

// Route Permission Tulisan
// Route::get('/tulisan', function(){
//     return '<h1>Hallo Tulisan</h1>';
// })->middleware(['auth', 'verified','permission:lihat-tulisan']);

// Route roleOrPermission (bole akses jika memiliki permission 'lihat-tulisan' dan role nya 'admin)
Route::get('/tulisan', function(){
    return view('tulisan');
})->middleware(['auth', 'verified','roleOrPermission:lihat-tulisan|admin']);

require __DIR__.'/auth.php';
