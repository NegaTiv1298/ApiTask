<?php

use App\Http\Controllers\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Adding routes for ari requests.
 * Request example : http://127.0.0.1:8000/api/v1/products/filter=/price:asc/3
 */
Route::prefix('/products')->group(function () {
    Route::get('/', [ProductController::class, 'getAllProducts']);
    Route::prefix('/filter=')->group(function () {
        Route::get('/{filter}:{sort?}/{paginate?}', [ProductController::class, 'getSortProducts']);
    });
});

