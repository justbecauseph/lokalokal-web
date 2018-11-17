<?php

namespace LokaLocal\Http\Controllers\Transactions;

use Auth;
use Illuminate\Http\Request;
use LokaLocal\Http\Controllers\Controller;
use LokaLocal\Transaction;

class TransactionController extends Controller {
    protected $query;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                $this->query = Transaction::query();
            } elseif ($user->hasRole('partner')) {
                $this->query = Transaction::query()->whereHas('branch', function ($q) use ($user) {
                    return $q->where('user_id', $user->id);
                });
            } else {
                $this->query = Transaction::query()->where('user_id', $user->id);
            }
            
            return $next($request);
        });
    }

    public function filter(Request $request)
    {
        if ($request->search) {
            $this->query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $transactions = $this->query->orderBy($request->input('orderBy.column'), $request->input('orderBy.direction'))
                                    ->paginate($request->input('pagination.per_page'));

        return $transactions;
    }
}
