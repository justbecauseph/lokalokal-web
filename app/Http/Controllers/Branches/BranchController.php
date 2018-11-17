<?php

namespace LokaLocal\Http\Controllers\Branches;

use Illuminate\Http\Request;
use LokaLocal\Branch;
use LokaLocal\Http\Controllers\Controller;

class BranchController extends Controller
{
    protected $query;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = auth()->user();

            if ($user->hasRole('admin')) {
                $this->query = Branch::query();
            } elseif ($user->hasRole('partner')) {
                $this->query = Branch::query()->where('user_id', $user->id);
            }

            return $next($request);
        });
    }

    public function filter(Request $request)
    {
        if ($request->search) {
            $this->query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $transactions = $this->query->with('user')->orderBy($request->input('orderBy.column'), $request->input('orderBy.direction'))
                                    ->paginate($request->input('pagination.per_page'));

        return $transactions;
    }
}
