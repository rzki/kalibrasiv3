<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\ItemUnitController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\DeviceNameController;
use App\Http\Controllers\EmployeeDeptController;
use App\Http\Controllers\PartnerCategoryController;
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
    return to_route('login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function(){
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::resource('users', UserController::class)->names('users');
Route::put('users/reset-password/{user}', [UserController::class, 'resetPassword'])->name('users.password.reset');
Route::post('users/import', [UserController::class, 'userImport'])->name('users.import');
Route::get('profile', [UserController::class, 'profile'])->name('users.profile');
Route::get('profile/edit/{user}', [UserController::class, 'editProfile'])->name('users.profile.edit');
Route::put('profile/{user}', [UserController::class, 'updateProfile'])->name('users.profile.update');
Route::get('profile/password-reset/', [UserController::class, 'editPassword'])->name('users.profile.password.edit');
Route::put('password-reset', [UserController::class, 'updatePassword'])->name('users.profile.password.update');
Route::resource('roles', RoleController::class)->names('roles');
Route::resource('hospitals', HospitalController::class)->names('hospitals');
Route::resource('inventories', InventoryController::class)->names('inventories');

// Device
Route::resource('devices/all', DeviceController::class, ['parameters' => ['all' => 'device']])->names('devices');
Route::resource('devices/device-name', DeviceNameController::class)->names('devices_name');
Route::post('devices/all/', [DeviceController::class, 'store'])->name('devices.store');
Route::get('devices/create-qr', [DeviceController::class,'createQR'])->name('devices.createQR');
Route::post('devices/qr-store', [DeviceController::class, 'storeQR'])->name('devices.storeQR');
Route::delete('devices/delete-devices', [DeviceController::class,'deleteSelected'])->name('devices.deleteSelected');
Route::get('devices/all/qr-print/{device}', [DeviceController::class, 'printQR'])->name('devices.print');
Route::get('devices/print-empty-qr', [DeviceController::class, 'printEmptyQR'])->name('devices.printEmptyQR');
});

Route::get('details/{device}', [DeviceController::class, 'qrCode'])->name('devices.qr');
Route::get('/phpinfo', function(){
    phpinfo();
});
