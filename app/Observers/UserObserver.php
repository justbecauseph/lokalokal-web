<?php

namespace LokaLocal\Observers;

use LokaLocal\User;
use LokaLocal\Wallet;

class UserObserver {
    public function created(User $user)
    {
        $wallet         = new Wallet;
        $wallet->amount = 0;

        $wallet->user()->associate($user);
        $wallet->save();
    }
}
