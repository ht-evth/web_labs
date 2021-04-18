<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\myController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [MyController::class, 'index'])->name('index');

Route::get('/catalog', [MyController::class, 'catalog'])->name('catalog');

Route::get('/pageadmin', [MyController::class, 'pageadmin'])->name('tents.list');

Route::get('/productinfo_{id}', [MyController::class, 'productinfo'])->name('tents.read');

Route::delete('/deletetent_{id}', [MyController::class, 'deletetent'])->name('tents.delete');

Route::get('createtent', [MyController::class, 'createtent'])->name('tents.create');

Route::post('createtent', [MyController::class, 'storetent'])->name('tents.store');

Route::get('edittent_{id}', [MyController::class, 'edittent'])->name('tents.edit');

Route::post('updatetent_{id}', [MyController::class, 'updatetent'])->name('tents.update');

// ajax
Route::delete('deletetent', [MyController::class, 'deletetent_ajax']);


Route::get('previewcar_{id}', [MyController::class, 'previewcar'])->name('tents.preview');
