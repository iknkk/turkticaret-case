<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    
    Route::apiResources([
        'products' => App\Http\Controllers\ProductController::class,
        'authors' => App\Http\Controllers\AuthorController::class,
        'categories' => App\Http\Controllers\CategoryController::class,
        'campaigns' =>  App\Http\Controllers\CampaignController::class,
        'orders' => App\Http\Controllers\OrderController::class,
    ]);
});