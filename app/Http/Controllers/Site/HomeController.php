<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $plans = Plan::with('features')->get();

        return view('home/index',[
            'plans' => $plans
        ]);
    }

    public function createSessionPlan(Plan $plan,$urlPlan)
    {
        if(!$plan = $plan->where('url', $urlPlan)->first()){
            return redirect()->route('site.home');
        }

        session()->put('plan', $plan);

        return redirect()->route('subscriptions.checkout');
    }
}
