<?php

namespace App\Http\Controllers;

use App\Mail\PurchaseSuccessful;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Stripe\PaymentIntent;
use Stripe\Stripe;


class CheckoutController extends Controller
{
    //Checkout page
    public function index()
    {
        if (Cart::count() <=0)
        {
            session()->flash('info','You Must Buy at Least One Item To proceed To Checkout');
            return redirect()->back();
        }

        // Set your secret key. Remember to switch to your live secret key in production!
// See your keys here: https://dashboard.stripe.com/account/apikeys
        Stripe::setApiKey('sk_test_51HpiILKTVzKH3r8eeWkkyWXD50SdBXncOQ59Jfhhu7GZSSI5LrqkgV80u1teE0ENxzWpYXYEvh9UJxoR7zHn5gjE00oihxXytx');

        $intent = PaymentIntent::create([
            'amount' => Cart::total() * 100,
            'currency' => 'usd',
            // Verify your integration in this guide by including this parameter
            'metadata' => ['integration_check' => 'accept_a_payment'],
        ]);


        //Client secret key
        $clientSecret =  $intent->client_secret;
        return view('checkout')->with('clientSecret',$clientSecret);
    }
    public function store(Request $request)
    {
        Cart::destroy();
        $data = $request->json()->all();
         Mail::to('client11215@gmail.com')->send(new PurchaseSuccessful());
            return $data['paymentIntent'];
    }
    public function successfulPayment(Request $request)
    {
        session()->flash('info','Purchase successful. A receipt has been sent to your email');
        return redirect()->route('index');
    }
}
