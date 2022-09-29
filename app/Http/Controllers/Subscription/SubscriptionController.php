<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function checkout(Request $request)
    {
        if(auth()->user()->subscribed('default')){
            return redirect()->route('subscriptions.premium');
        }

        return view('subscriptions.index',[
            'intent' => auth()->user()->createSetupIntent(),
        ]);
    }

    public function store(Request $request)
    {
        $request->user()
            ->newSubscription('default', 'price_1Lm1p3IijXnRneCvUHxVx6VN')
            ->create($request->token);

        return redirect()->route('subscriptions.premium');
    }

    public function premium()
    {
        return view('subscriptions.premium');
    }

    public function account()
    {
        $invoices = auth()->user()->invoices();
        $subscription = Auth::user()->subscription('default');
        return view('subscriptions.account',[
            'invoices' => $invoices,
            'subscription' =>$subscription
        ]);
    }

    public function downloadInvoice($invoiceId)
    {
       return Auth::user()->downloadInvoice($invoiceId, [
           'vendor' => config('app.name'),
            'product' => 'Assinatura vip'
           ]);
    }

    public function cancel()
    {
        auth()->user()->subscription('default')->cancel();
        return redirect()->route('subscriptions.account');
    }

    public function resume()
    {
        auth()->user()->subscription('default')->resume();
        return redirect()->route('subscriptions.account');
    }
}

