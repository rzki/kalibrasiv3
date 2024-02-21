<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeDeptController;
use App\Http\Controllers\EmployeePositionController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::controller(EmployeeController::class)->group(function() {
    Route::resource('employees/all', EmployeeController::class)->names('employees');
});
Route::resource('employees/depts', EmployeeDeptController::class)->names('employee_depts');
Route::resource('employees/positions', EmployeePositionController::class)->names('employee_positions');
