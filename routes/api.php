<?php

use App\Http\Controllers\CacheStoreController;
use App\Http\Controllers\DeviceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SiteController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('v1/products/{id}', [ProductController::class, 'showApi'])->where(['id', '[0-9]+']);
Route::post('backup/products', [ProductController::class, 'backupRecords']);
Route::get('find/new-products', [ProductController::class, 'findNewProducts']);
// Route::resource('v1/products', ProductController::class);
Route::post('v1/product', [ProductController::class, 'store']);
Route::get('users/{id}', function ($id) {
    return response()->json([
        'id' => $id
    ]);
});

Route::get('cache/customers', [CacheStoreController::class, 'storeCustomers']);


//http and guzzlehttp clients

Route::delete('guzzle/http/', [SiteController::class, 'delete']);

Route::post('guzzle/http/', [SiteController::class, 'create']);


//Getting Lastes Executed query and logs of queries

Route::get('get/query/logs', [ProductController::class, 'getLatestExecutedQuery']);


//Model Events & Listeners

Route::get('devices', [DeviceController::class, 'index']);
Route::post('device', [DeviceController::class, 'store']);
Route::put('device', [DeviceController::class, 'update']);
Route::delete('device', [DeviceController::class, 'delete']);

//Case Sensitive query
Route::get('v1/case/sensitive/query/product', [ProductController::class, 'searchCaseSensitive']);
