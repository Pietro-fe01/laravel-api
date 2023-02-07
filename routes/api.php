<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

/*----------------------
    PORJECTS API 
----------------------*/
    // Get all projects -> api/projects
    Route::get('projects', [ProjectController::class, 'index']);

    // Get a signle project - show -> api/project/{param}
    Route::get('project/{slug}', [ProjectController::class, 'show']);

    // Get all projects with a specific type_id -> api/projects/{type_id}
    Route::get('projects/{type_id}', [ProjectController::class, 'filterByType']);

/*----------------------
    TYPES API 
----------------------*/
    // Get all types api/types
    Route::get('types', [TypeController::class, 'index']);

/*----------------------
    REVIEWS API 
----------------------*/
    Route::post('reviews/{project}', [ReviewController::class, 'store']);

/*----------------------
    CONTACTS API 
----------------------*/
    Route::post('contact-form', [ContactController::class, 'contact_registration']);