<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Routing\Attributes\Controllers\Middleware;

class BudgetChatController extends Controller
{
    #[Middleware('auth')]
    #[Middleware('verified')]
    public function store(Request $request, Budget $budget)
    {
        dd('desde chat controler');
    }
}
