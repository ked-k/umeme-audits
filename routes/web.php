<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Livewire\Manage\QrcodesComponent;
use App\Http\Livewire\Manage\ViewQrcodeComponent;
use App\Http\Livewire\UserManagement\UserProfileComponent;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::get('/', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');
Route::get('user/account', UserProfileComponent::class)->name('user.account')->middleware('auth');

Route::get('lang/{locale}', function ($locale) {
    if (array_key_exists($locale, config('languages'))) {
        Session::put('locale', $locale);
    }

    return redirect()->back();
})->name('lang');

Route::group(['middleware' => ['auth',  'suspended_user']], function () {
    
    // Route::get('/home', function () {
    //     return view('home');
    //   })->middleware(['auth', 'verified'])->name('home');
    Route::get('qrcodes', QrcodesComponent::class)->name('home');
    Route::get('qrcode/showActivity', ViewQrcodeComponent::class)->name('viewVisa');
});

require __DIR__.'/auth.php';
