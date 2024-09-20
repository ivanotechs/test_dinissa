<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function upgrade(Request $request){
        $validated = Validator::make($request->all(), [
            'user_id' => 'required',
            'account_id' => 'required',
        ]);
        if ($validated->fails()) {
            return response(['success'=>false,'message' => $validated->errors()->first()]);
        }

        $user = User::find($request->user_id);
        $user->account_id = $request->account_id;
        $user->save();

        return response()->json(
            [
               'success' => true,
               'message' => 'Account Upraded',
               'user' => UserResource::make($user) ,
            ], 200);
    }
}
