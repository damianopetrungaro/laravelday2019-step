<?php

declare(strict_types=1);

use App\Http\Middleware\Validation\BookDetailsValidation;
use App\Http\Middleware\Validation\BookIDValidation;
use App\Http\Middleware\Validation\CustomerDetailsValidation;
use App\Http\Middleware\Validation\CustomerIDValidation;

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
Route::middleware([
    CustomerIDValidation::class,
    CustomerDetailsValidation::class,
    BookIDValidation::class,
    BookDetailsValidation::class,
])->post('/orders', 'PlaceOrderController');

