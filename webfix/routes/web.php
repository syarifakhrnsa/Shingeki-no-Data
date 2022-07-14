<?php

use App\Http\Controllers\PlanController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\MyTest;
use App\Models\UserPlan;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/map', MyTest::class)->name('test');
Route::get('/test', [MyTest::class,'clustering']);
Route::get('/home', [PlanController::class,'allPlans']);
Route::post('/storeplan', [PlanController::class,'storeNewPlan'])->name('storeplan');

// myplancontroller
Route::get('/toMap/{id}', [PlanController::class,'toMap'])->name('toMap');


