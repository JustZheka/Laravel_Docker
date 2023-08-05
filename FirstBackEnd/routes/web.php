<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;

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

Route::GET('/', [ItemsController::class, 'index'])->name('Items.index');

Route::GET('/sort/{sortType}', [ItemsController::class, 'sort'])->name('Items.sort');

Route::POST('/add', [ItemsController::class, 'add'])->name('Items.add');

Route::POST('/delete/{index}', [ItemsController::class, 'delete'])->name('Items.delete');

Route::POST('/edit/{index}', [ItemsController::class, 'edit'])->name('Items.edit');

Route::POST('/ok/{index}', [ItemsController::class, 'ok'])->name('Items.ok');

Route::POST('/cancel/{index}', [ItemsController::class, 'cancel'])->name('Items.cancel');
