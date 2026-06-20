<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SubscriptionController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();
        $subscribed = $user->subscribed('default');

        if(!$subscribed) {
            return redirect()->route('plans');
        }

        $currentPlan = $user->subscribedToPrice(config('services.stripe.price_ai_yearly'), 'default') ? 'yearly' : 'monthly';

        return Inertia::render('Subscriptions/Manage', [
            'subscription' => [
                'plan' => $currentPlan,
                'price' => $currentPlan === 'Yearly' ? 990 : 90,
            ]
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
