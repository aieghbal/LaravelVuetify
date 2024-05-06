<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users/edit', [UserController::class, 'editItem'])->name('users.edit');
Route::post('/users/delete', [UserController::class, 'deleteItem'])->name('users.delete');
Route::post('/users/add', [UserController::class, 'addItem'])->name('users.add');
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
