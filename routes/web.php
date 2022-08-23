<?php

use App\Http\Controllers\PlanController;
use App\Http\Controllers\MapController;
use Illuminate\Support\Facades\Route;
use App\Models\UserPlan;use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', function () {
    return view('home');
});

Auth::routes();

//
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
    Route::get('/test', [MyTest::class,'clustering']);
    Route::get('/plan', [PlanController::class,'allPlans']);
    Route::post('/newplan', [PlanController::class,'newPlan'])->name('newplan');
    Route::get('/deleteplan/{plan_id}', [PlanController::class,'deletePlan'])->name('deleteplan');
    Route::get('/map', function () {
        return redirect('/plan');
    });

    Route::get('/map/{plan_idid}', [MapController::class,'loadMap'])->name('map');
    Route::post('/addlocation/{plan_id}', [MapController::class,'addLocation'])->name('addlocation');
    Route::get('/deletelocation/{plan_id}/{location_id}', [MapController::class,'deleteLocation'])->name('deletelocation');
    Route::post('/kmeans/{plan_id}', [MapController::class,'kmeans'])->name('kmeans');
});

// myplancontroller


