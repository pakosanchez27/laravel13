<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\LogoutController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;







Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/register', [RegisterController::class, 'index'])->name('register');
Route::post('/auth/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/auth/login', [LoginController::class, 'index'])->name('login');
Route::post('/auth/login', [LoginController::class, 'store'])->name('login.store');

Route::post('/auth/logout', [LogoutController::class, 'store'])->name('logout.store');


//Ruta para verificar el correo electrónico
Route::get('email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    //Marcar el correo como verificado
    $request->fulfill();

    return redirect('dashboard')->with('success', 'Tu correo fue verificado correctamente. Ya puedes crear presupuestos y gastos');
})->middleware('auth', 'signed')->name('verification.verify');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification',  function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('success', 'Se ha enviado un nuevo correo de verificación a tu dirección de correo electrónico.');
})->middleware('auth', 'throttle:1,1')->name('verification.send');


Route::prefix('dashboard')->group(function () {
    // Mostrar todos los presupuestos
    Route::get('/', [BudgetController::class, 'index'])->name('dashboard');
    Route::get('/budgets/create', [BudgetController::class, 'create'])->name('budgets.create');
    Route::post('/budgets', [BudgetController::class, 'store'])->name('budgets.store');
    Route::get('/budget/{budget}/edit', [BudgetController::class, 'edit'])->name('budgets.edit');
    Route::put('/budget/{budget}', [BudgetController::class, 'update'])->name('budgets.update');
});
