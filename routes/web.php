<?php

use App\Http\Controllers\PlanController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\MyTest;
use App\Models\UserPlan;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// auth only
Route::middleware('auth')->group(function () {
    Route::get('/map', MyTest::class)->name('test');
    Route::get('/test', [MyTest::class,'clustering']);
    Route::get('/plan', [PlanController::class,'allPlans']);
    Route::post('/newplan', [PlanController::class,'newPlan'])->name('newplan');
});

// myplancontroller
Route::get('/toMap/{id}', [PlanController::class,'toMap'])->name('toMap');

