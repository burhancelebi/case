<?php

use App\Http\Controllers\Api\CampaignController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('orders', OrderController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('campaigns', CampaignController::class);
Route::patch('campaigns/apply/{order_id}', [CampaignController::class, 'applyCampaign']);
