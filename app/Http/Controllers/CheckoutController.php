<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Stripe\Charge;
use Stripe\Stripe;
use Cart;
use Session;


class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        if(Cart::content()->count() == 0){
            Session::flash('info' , 'No item In Cart make shopping');
            return redirect()->back();
        }
        return view('checkout');
    }
    public function puy(){
        //dd(request()->all());
        Stripe::setApiKey("sk_test_K7QLRXMeygB21vTUWZ9RxPPD");
        $charge = Charge::create([
            'amount' => Cart::total() * 100,
            'currency' => 'usd',
            'description' => 'udemy course practice selling books',
            'source' => request()->stripeToken
        ]);
        //dd($charge);
        Session::flash('success', 'purchased completed successfully with sending mail with order');
        Cart::destroy();
        Mail::to(request()->stripeEmail)->send(new \App\Mail\PurchaseMail);
        return redirect('/');

    }
}
