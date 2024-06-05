<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

Auth::routes(["verify" => true]);

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');

})->name('verification.verify');
Route::post("register", [RegisterController::class, "newRegister"])->name("newRegister");

Route::middleware(['auth', 'verified'])->group(function(){

    Route::get("me", [UserController::class, "me"])->name("me");
    Route::patch("me/{user}", [UserController::class, "update"])->name("me.update");
    Route::delete("me/{user}", [UserController::class, "destroy"])->name("me.destroy");
    Route::post("/address/search", [AddressController::class, "searchAddress"])->name("address.search");
    Route::resource("contact", ContactController::class);
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
