<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\DesignController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/designs', [DesignController::class, 'index']);
Route::post('/designs', [DesignController::class, 'store']);
Route::get('/designs/{design}', [DesignController::class, 'show']);
Route::put('/designs/{design}', [DesignController::class, 'update']);
Route::delete('/designs/{design}', [DesignController::class, 'destroy']);
Route::post('/designs/{design}/export', [DesignController::class, 'export']);
Route::post('/designs/{design}/assets', [DesignController::class, 'uploadAsset']);
Route::delete('/designs/{design}/assets/{asset}', [DesignController::class, 'deleteAsset']);
Route::get('/designs/{design}/whatsapp', [OrderController::class, 'generateWhatsAppLink']);

Route::get('/product-variants/{productType}', function ($productType) {
    return \App\Models\ProductVariant::where('product_type', $productType)->get();
});