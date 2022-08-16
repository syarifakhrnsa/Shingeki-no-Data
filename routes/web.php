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

//blog
Route::get('/blog', function () {
    return view('blog/blog');
});
Route::get('/blog/1', function () {
    return view('blog/blog1');
});Route::get('/blog/2', function () {
    return view('blog/blog2');
});
Route::get('/blog/3', function () {
    return view('blog/blog3');
});

// auth only
Route::middleware('auth')->group(function () {
    Route::get('/map', MyTest::class)->name('test');
    Route::get('/test', [MyTest::class,'clustering']);
    Route::get('/plan', [PlanController::class,'allPlans']);
    Route::post('/newplan', [PlanController::class,'newPlan'])->name('newplan');
    Route::get('/deleteplan/{id}', [PlanController::class,'deletePlan'])->name('deleteplan');
    Route::get('/map/{plan_id}', [PlanController::class,'loadMap'])->name('loadMap');
});

// myplancontroller


