<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::view('/view', 'welcome', ['user' => 'May']);

Route::get('/hello', function () {
    return 'hello-world';
});

Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome.index');

Route::group(['as' => 'test::', 'prefix' => 'test'], function () {
    Route::get('{id?}', ['as' => 'id', function ($id = 'default') {
        return $id;
    }])->where(['id' => '[0-9]+']);
    // test::id

    Route::get('{name?}', ['as' => 'name', function ($name = 'noname') {
        return $name;
    }])->where(['name' => '[A-Za-z]+']);
    // test::name
});

// Route::resource('task', TaskController::class);
// Route::apiResource('task', TaskController::class);

// Route::get('{anything}', function () {
//     return 'catch-all';
// })->where('anthing', '*');

Route::fallback(function () {
    return 'web: catch-all';
});
