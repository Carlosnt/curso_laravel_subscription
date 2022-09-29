<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Plan $plan)
    {
        $plans = $plan->with('features')->get();
        return view('home/index',[
            'plans' => $plans
        ]);
    }
}
