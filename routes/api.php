<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesInvoiceController;

//This is a default route
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Sales invoice creation
Route::post('/sales-invoices', [SalesInvoiceController::class, 'store']);
