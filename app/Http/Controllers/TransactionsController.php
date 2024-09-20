<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionsController extends Controller
{
    public function index(Request $request){
        $validated = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
        if ($validated->fails()) {
            return response(['success'=>false,'message' => $validated->errors()->first()]);
        }
        $transactions = Transaction::where('sender_id', $request->user_id)->get();
        return response()->json(
            [
               'success' => true,
               'message' => 'Transactions fetched successfully',
               'transactions' => TransactionResource::collection($transactions) ,
            ], 200);
    }
    public function create(Request $request){
        $validated = Validator::make($request->all(), [
            'sender_id' => 'required',
            'receiver_id' => 'required',
            'amount' => 'required',
        ]);
        if ($validated->fails()) {
            return response(['success'=>false,'message' => $validated->errors()->first()]);
        }

        $sender = User::find($request->sender_id);
        $receiver = User::find($request->receiver_id);
        if($sender->balance < $request->amount){
            return response(['success'=>false,'message' => 'Insufficient balance']);
        }
        $sender->balance -= $request->amount;
        $sender->save();
        $receiver->balance += $request->amount;
        $receiver->save();

        $transaction = Transaction::create([
           'sender_id' => $request->sender_id,
           'receiver_id' => $request->receiver_id,
            'amount' => $request->amount,
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Transaction created successfully',
                'transaction' => TransactionResource::make($transaction) ,
            ], 201);
    }
}
