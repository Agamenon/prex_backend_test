<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchGIFController;
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

Route::group(
    ['prefix' => 'v1'],
    function () use ($router) {
        /** @var Route $router */
        $router->post('/auth/sign_in', [LoginController::class, 'login'])->name('user.login');

        $router->group(['middleware' => ['auth:sanctum', 'throttle:api', 'log']], function () use ($router) {
            $router->get("gif/audit", [SearchGIFController::class, 'audit'])->name('gif.audit');
            $router->get("gif",[SearchGIFController::class,'index'])->name('gif.index');
            $router->get("gif/{id}", [SearchGIFController::class, 'show'])->name('gif.show');
            $router->post("gif", [SearchGIFController::class, 'store'])->name('gif.store');
        });

});
