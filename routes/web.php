<?php

use App\Http\Controllers\ExcelController;
use App\Http\Controllers\ExcelUploadController;
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

    Route::get("/excel-upload", [ExcelUploadController::class, "index"])->name("excelUpload.index");
    Route::post("/excel-upload", [ExcelUploadController::class, "upload"])->name("excelUpload.upload");

    Route::get("/excel", [ExcelController::class, "index"])->name("excel.index");
});

require __DIR__.'/auth.php';
