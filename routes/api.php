<?php

use App\Http\Controllers\Api\Auth\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\FAQController;

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

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::get('products', [ProductController::class, 'products']);
Route::get('categories', [ProductController::class, 'categories']);
Route::get('brands', [ProductController::class, 'brands']);
Route::get('offers', [ProductController::class, 'offers']);
Route::get('trending', [ProductController::class, 'trending']);
Route::get('best-selling', [ProductController::class, 'bestSelling']);
Route::get('recent-view', [ProductController::class, 'recentView']);
Route::get('faqs', [FAQController::class, 'faqs']);
Route::get('privacy-policy', [FAQController::class, 'privacyPolicy']);
Route::get('Terms-and-condition', [FAQController::class, 'termCondition']);


