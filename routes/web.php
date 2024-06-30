<?php

use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::resource('crud', CrudController::class);

Route::get('crud', [CrudController::class, 'index'])->name('crud.index');
Route::post('crud', [CrudController::class, 'store'])->name('crud.store');
Route::get('crud/create', [CrudController::class, 'create'])->name('crud.create');
Route::get('crud/{crud}', [CrudController::class, 'show'])->name('crud.show');
Route::post('crud/{crud}', [CrudController::class, 'update'])->name('crud.update');
Route::delete('crud/{crud}', [CrudController::class, 'destroy'])->name('crud.destroy');
Route::get('crud/{crud}/edit', [CrudController::class, 'edit'])->name('crud.edit');
