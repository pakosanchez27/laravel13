<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/register', [RegisterController::class, 'index'])->name('register');
Route::post('/auth/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/auth/login', [LoginController::class, 'index'])->name('login');


//Ruta para verificar el correo electrónico
Route::get('email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    //Marcar el correo como verificado
    $request->fulfill();

    return redirect('/auth/login')->with('verified', true);

})->middleware('auth', 'signed')->name('verification.verify');
