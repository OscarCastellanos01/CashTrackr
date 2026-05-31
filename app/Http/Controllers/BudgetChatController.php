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
        $messages = $request->input('messages', []);

        $lastMessage = collect($messages)->last();

        $prompt = collect(data_get($lastMessage, 'parts', []))
            ->where('type', 'text')
            ->pluck('text')
            ->implode(' ')
            ?: data_get($lastMessage, 'content', '');

        dd($prompt);
    }
}
