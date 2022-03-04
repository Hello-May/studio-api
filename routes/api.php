<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\CategoryController;
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

Route::prefix('product')->name('product.')->group(function () {
    Route::get('category', [ProductController::class, 'indexWithCategory'])->name('indexWithCategory');
    Route::get('/{product}/category', [ProductController::class, 'showWithCategory'])->name('showWithCategory');
    Route::get('category/{category_id}', [ProductController::class, 'showByCategory'])->name('showByCategory')->where(['id' => '[0-9]+']);
    Route::patch('list', [ProductController::class, 'updateMutiple'])->name('updateMutiple');
});

Route::apiResources([
    'member' => MemberController::class,
    'category' => CategoryController::class,
    'product' => ProductController::class
]);

Route::prefix('test')->group(function () {
    Route::get('', function () {
        return 'ok';
    });

    Route::post('', function (Request $request) {
        // dump($request->all());
        // return 'print request';
        return $request->collect();
    });
});

Route::fallback(function () {
    return 'api: catch-all';
});
