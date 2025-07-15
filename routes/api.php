<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\Admin\HeroSliderController;
use App\Http\Controllers\Admin\LocationsController;
use App\Http\Controllers\Admin\MilestoneController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\TechnologiesController;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    
// About routes
Route::get('/about', [AboutController::class, 'index']);
Route::post('/about', [AboutController::class, 'update']);

// HeroSlider 
Route::get('/heroslider', [HeroSliderController::class, 'index']);
Route::post('/heroslider', [HeroSliderController::class, 'update']);

// News routes
Route::get('/news', [NewsController::class, 'index']);
Route::post('/news', [NewsController::class, 'store']);
Route::get('/news/{id}', [NewsController::class, 'show']);
Route::put('/news/{id}', [NewsController::class, 'update']);
Route::delete('/news/{id}', [NewsController::class, 'destroy']);
// events routes
Route::get('/events', [EventsController::class, 'index']);
Route::post('/events', [EventsController::class, 'store']);
Route::get('/events/{id}', [EventsController::class, 'show']);
Route::put('/events/{id}', [EventsController::class, 'update']);
Route::delete('/events/{id}', [EventsController::class, 'destroy']);
// milestone routes
Route::get('/milestones', [MilestoneController::class, 'index']);
Route::post('/milestones', [MilestoneController::class, 'store']);
Route::get('/milestones/{id}', [MilestoneController::class, 'show']);
Route::put('/milestones/{id}', [MilestoneController::class, 'update']);
Route::delete('/milestones/{id}', [MilestoneController::class, 'destroy']);
// News routes
Route::get('/projects', [ProjectsController::class, 'index']);
Route::post('/projects', [ProjectsController::class, 'store']);
Route::get('/projects/{id}', [ProjectsController::class, 'show']);
Route::put('/projects/{id}', [ProjectsController::class, 'update']);
Route::delete('/projects/{id}', [ProjectsController::class, 'destroy']);
// News routes
Route::get('/technologies', [TechnologiesController::class, 'index']);
Route::post('/technologies', [TechnologiesController::class, 'store']);
Route::get('/technologies/{id}', [TechnologiesController::class, 'show']);
Route::put('/technologies/{id}', [TechnologiesController::class, 'update']);
Route::delete('/technologies/{id}', [TechnologiesController::class, 'destroy']);
// News routes
Route::get('/locations', [LocationsController::class, 'index']);
Route::post('/locations', [LocationsController::class, 'store']);
Route::get('/locations/{id}', [LocationsController::class, 'show']);
Route::put('/locations/{id}', [LocationsController::class, 'update']);
Route::delete('/locations/{id}', [LocationsController::class, 'destroy']);


});

Route::get('about-data' , [FrontendController::class , 'index']);
Route::get('hero' , [FrontendController::class , 'index']);
