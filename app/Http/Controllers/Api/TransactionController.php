<?php

namespace LokaLocal\Http\Controllers\Api;

use LokaLocal\Http\Controllers\Controller;
use LokaLocal\Http\Requests\TransactionRequest;
use LokaLocal\Sku;
use LokaLocal\Transaction;

class TransactionController extends Controller {
    public function store(TransactionRequest $request)
    {
        $sku = Sku::where('code', $request->get('code'))->first();

        if ($sku->amount > auth()->user()->wallet->amount) {
            return response()->json([
                'message' => 'Amount in wallet insufficient for transaction.'
            ], 422);
        }

        $before = auth()->user()->wallet->amount;
        auth()->user()->wallet->decrement('amount', $sku->amount);
        $after = auth()->user()->wallet->amount;

        $txn                = new Transaction;
        $txn->type          = 'credit';
        $txn->amount        = $sku->amount;
        $txn->before_amount = $before;
        $txn->after_amount  = $after;
        $txn->sku()->associate($sku);
        $txn->user()->associate(auth()->user());
        $txn->branch()->associate($sku->branch);
        $txn->save();

        return response()->json([
            'message' => 'ok'
        ]);
    }
}
