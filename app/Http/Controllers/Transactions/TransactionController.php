<?php

namespace LokaLocal\Http\Controllers\Transactions;

use Illuminate\Http\Request;
use LokaLocal\Http\Controllers\Controller;
use LokaLocal\Transaction;

class TransactionController extends Controller
{
    public function filter(Request $request)
    {
        $query = Transaction::query();

        if ($request->search) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $transactions = $query->orderBy($request->input('orderBy.column'), $request->input('orderBy.direction'))
                      ->paginate($request->input('pagination.per_page'));

        return $transactions;
    }
}
