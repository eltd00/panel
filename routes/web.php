<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\employeeController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

######Routes Employee
Route::group(['prefix' => '/employeeController'], function (){
    Route::get("/", [employeeController::class, 'showEmployee'])->name('employeeController.display')->middleware(['can:read']);
    Route::get("/Add", [employeeController::class, 'addEmployee'])->name('add.employeeController')->middleware(['can:create']);
    Route::post("/store", [employeeController::class, 'store'])->name("store.employeeController")->middleware(['can:create']);
    Route::get("/edit/{employee_id}", [employeeController::class, 'edit'])->name('employeeController.edit')->middleware(['can:update']);
    Route::post("/update/{employee_id}", [employeeController::class, 'UpdateEmployee'])->name('update.employeeController')->middleware(['can:update']);
    Route::get("/delete/{employee_id}", [employeeController::class, 'DeleteEmployee'])->name('delete.employeeController')->middleware(['can:delete']);

});

######End
