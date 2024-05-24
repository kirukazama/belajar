<?php

use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\ResetPassword;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\ExampleLaravel\UserManagement;
use App\Http\Livewire\ExampleLaravel\UserProfile;
use App\Http\Livewire\Kebun;
use App\Http\Livewire\Pelanggan;

use GuzzleHttp\Middleware;

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
    return redirect('sign-in');
});

Route::get('forgot-password', ForgotPassword::class)->middleware('guest')->name('password.forgot');
Route::get('reset-password/{id}', ResetPassword::class)->middleware('signed')->name('reset-password');



Route::get('sign-up', Register::class)->middleware('guest')->name('register');
Route::get('sign-in', Login::class)->middleware('guest')->name('login');

Route::get('user-profile', UserProfile::class)->middleware('auth')->name('user-profile');
Route::get('user-management', UserManagement::class)->middleware('auth')->name('user-management');
Route::get('pelanggan', Pelanggan::class)->middleware('auth')->name('pelanggan');
Route::get('kebun', Kebun::class)->middleware('auth')->name('kebun');

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('pelanggan', Pelanggan::class)->name('pelanggan');
    Route::get('kebun', Kebun::class)->name('kebun');
});
