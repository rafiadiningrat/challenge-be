<?php

use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    $res['message'] = config('app.name').' is online';

    if (app()->isLocal()) {
        $res['info'] = 'Laravel v'.app()->version(). ' (PHP v'.PHP_VERSION.')';
    }

    return response()->json($res);
});

Route::get('/user', [UserController::class, 'getUser']); 
Route::post('/user', [UserController::class, 'addUser']);
Route::put('/user/{id}', [UserController::class, 'updateUser']);
Route::delete('/user/{id}', [UserController::class, 'deleteUser']);

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
