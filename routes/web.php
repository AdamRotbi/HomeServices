<?php

use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Customer\CustomerDashboardComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\Sprovider\SproviderDashboardComponent;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',HomeComponent::class)->name('home');

//for customer
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function(){
    Route::get('/customer/dashboard',CustomerDashboardComponent::class)->name('customer.dashboard');
});
//for service provider
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','authsprovider'])->group(function(){
    Route::get('/sprovider/dashboard',SproviderDashboardComponent::class)->name('sprovider.dashboard');
});

//for admin
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','authadmin'])->group(function(){
    Route::get('/admin/dashboard',AdminDashboardComponent::class)->name('admin.dashboard');
});
