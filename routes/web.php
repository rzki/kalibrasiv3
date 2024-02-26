<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ItemUnitController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\EmployeeDeptController;
use App\Http\Controllers\EmployeePositionController;

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

Route::resource('users', UserController::class)->names('users');
Route::controller(EmployeeController::class)->group(function() {
    Route::resource('employees/all', EmployeeController::class)->names('employees');
});
Route::resource('employees/depts', EmployeeDeptController::class)->names('employee_depts');
Route::resource('employees/positions', EmployeePositionController::class)->names('employee_positions');
Route::resource('references', ReferenceController::class)->names('references');
Route::resource('companies', CompanyController::class)->names('companies');
Route::resource('item_units', ItemUnitController::class)->names('item_units');
