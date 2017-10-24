<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke ()
    {
        $orders = Type::limit(5)
            ->with('libelle')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('user.home')->with(compact('type'));
    }
}
