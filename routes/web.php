<?php

use App\Http\Controllers\DeviceBrandController;
use App\Http\Controllers\DeviceTypeController;
use App\Http\Controllers\DownloadQRController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ItemUnitController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\EmployeeDeptController;
use App\Http\Controllers\EmployeePositionController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\PartnerCategoryController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\VCardController;

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

Route::group(['middleware' => ['auth']], function(){
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
Route::resource('partners/all', PartnerController::class, ['parameters' => ['all' => 'partner']])->names('partners');
Route::resource('partners/categories', PartnerCategoryController::class)->names('partner_categories');
Route::resource('devices/all', DeviceController::class, ['parameters' => ['all' => 'device']])->names('devices');
Route::resource('devices/brands', DeviceBrandController::class)->names('device_brands');
Route::resource('devices/types', DeviceTypeController::class)->names('device_types');
Route::resource('hospitals', HospitalController::class)->names('hospitals');
Route::post('devices/all/', [DeviceController::class, 'store'])->name('devices.store');
Route::get('devices/create-qr', [DeviceController::class,'createQR'])->name('devices.createQR');
Route::post('devices/qr-store', [DeviceController::class, 'storeQR'])->name('devices.storeQR');
Route::delete('devices/delete-devices', [DeviceController::class,'deleteSelected'])->name('devices.deleteSelected');
// Route::post('devices/all/qr-generate', [DeviceController::class,'qrCodeGenerate'])->name('devices.generateQR');
Route::get('devices/all/qr-print/{device}', [DeviceController::class, 'printQR'])->name('devices.print');
});

Route::get('details/{device}', [DeviceController::class, 'qrCode'])->name('devices.qr');
Route::get('/phpinfo', function(){
    phpinfo();
});
