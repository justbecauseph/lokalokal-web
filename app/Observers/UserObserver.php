<?php

namespace LokaLocal\Observers;

use LokaLocal\Transaction;
use LokaLocal\User;
use LokaLocal\Wallet;

class UserObserver {
    public function created(User $user)
    {
        $wallet         = new Wallet;
        $wallet->amount = 500; // free money uwu

        $wallet->user()->associate($user);
        $wallet->save();

        $txn                = new Transaction;
        $txn->type          = 'debit';
        $txn->amount        = $wallet->amount;
        $txn->before_amount = 0;
        $txn->after_amount  = $wallet->amount;
        $txn->user()->associate($user);
        $txn->save();
    }
}
