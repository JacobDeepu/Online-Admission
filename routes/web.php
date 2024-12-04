<?php

use App\Http\Controllers\FormBuilderController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::get('/kg', function () {
    return view('welcome');
})->name('kg');

Route::get('/hs', function () {
    return view('welcome');
})->name('hs');

Route::get('/hss', function () {
    return view('welcome');
})->name('hss');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/form-builder', [FormBuilderController::class, 'index']);

    Route::resource('registration', RegistrationController::class)
        ->only([
            'index', 'show',
        ]);

    Route::get('/registrations/data/', [RegistrationController::class, 'getData']);

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('institutions', InstitutionController::class);
});
Route::get('/export-pdf/{registration}', [RegistrationController::class, 'exportPDF'])->name('export');
