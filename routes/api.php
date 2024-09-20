<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionsController;
use App\Http\Resources\AccountResource;
use App\Http\Resources\UserResource;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', function (Request $request) {
    return response()->json(
        [
           'success' => true,
           'message' => 'Users fetched successfully',
           'users' => UserResource::collection(User::all()) ,
        ], 200
    ) ;
});
Route::get('/accounts', function (Request $request) {
    return response()->json(
        [
           'success' => true,
           'message' => 'Accounts fetched successfully',
           'accounts' => AccountResource::collection(Account::all()) ,
        ], 200
    ) ;
});

Route::post('/account/upgrade', [AccountController::class, 'upgrade']);

Route::post('/transaction/create', [TransactionsController::class, 'create']);

Route::get('/transactions', [TransactionsController::class, 'index']);
