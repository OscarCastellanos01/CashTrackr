<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SubscriptionController extends Controller
{
    public function show(Request $request)
    {
        $subscribed = $request->user()->subscribed('default');

        if(!$subscribed) {
            return redirect()->route('plans');
        }

        return Inertia::render('Subscriptions/Manage', [

        ]);
    }

    public function swap(Request $request, string $plan)
    {

    }

    public function cancel(Request $request)
    {

    }

    public function resume(Request $request)
    {

    }
}
