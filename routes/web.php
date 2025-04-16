<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Models\Empleado;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/empleado/create2', function () {
//     return view('empleados/index');
// });

//Route::get('/empleado/create', [EmpleadoController::class, 'create'])->name('empleado.create');

Route::resource('empleado', EmpleadoController::class)->middleware('auth');
Auth::routes(['register'=> false, 'reset'=>false]);

Route::get('/home', [EmpleadoController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [EmpleadoController::class, 'index'])->name('home');
});
