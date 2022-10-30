<?php

use App\Http\Controllers\Manager\ModuleController;
use App\Http\Controllers\Manager\ResourceController;
use App\Http\Controllers\Manager\RoleController;
use App\Http\Controllers\Manager\UserController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ThreadController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('threads.index');
});

Route::group(['middleware' => 'access.control.middleware'], function () {
    Route::resource('threads', ThreadController::class);
});
Route::post('replies/store', [ReplyController::class, 'store'])->name('replies.store');

Auth::routes();


Route::group(['middleware' => ['auth', 'access.control.middleware'], 'prefix' => 'manager'], function(){
	Route::get('/', function(){
		return redirect()->route('users.index');
	});

	Route::resource('roles', RoleController::class);
	Route::get('roles/{role}/resources', [RoleController::class, 'syncResources'])->name('roles.resources');
	Route::put('roles/{role}/resources', [RoleController::class , 'updateSyncResources'])->name('roles.resources.update');
	Route::resource('resources', ResourceController::class);
	Route::resource('users', UserController::class);


	Route::resource('modules', ModuleController::class);

Route::get('modules/{module}/resources', [ModuleController::class, 'syncResources'])->name('modules.resources');

Route::put('modules/{module}/resources', [ModuleController::class, 'updateSyncResources'])->name('modules.resources.update');
Route::get('teste', function() {
	return '<h1>pong</h1>';
})->name('TESTE.TESTE');
    
});

