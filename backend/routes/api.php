<?php

use App\Http\Controllers\Api\LoginController;
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

Route::post('login', [LoginController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/products', function (Request $request) {
        return [
            ['id' => 1, 'name' => 'laptop'],
            ['id' => 2, 'name' => 'pc'],
            ['id' => 3, 'name' => 'keyboard'],
            ['id' => 4, 'name' => 'mouse'],
        ];
    });
    Route::get('/products/{id}', function (Request $request) {
        $products = [
            ['id' => 1, 'name' => 'laptop'],
            ['id' => 2, 'name' => 'pc'],
            ['id' => 3, 'name' => 'keyboard'],
            ['id' => 4, 'name' => 'mouse'],
        ];
    });

    Route::post('logout', [LoginController::class, 'logout']);
});
