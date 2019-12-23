<?php

namespace App\Http\Controllers;
use Cart;
use App\Product;
//use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    public function add_to_cart(Request $request){
//dd(request()->all());

        $request_data = Product::find($request->product_id);
        $cartItem = Cart::add(
            [
                'id' => $request_data->id,
                'name' => $request_data->name,
                //'image' => $request_data->image,

                'qty' => $request->qty,
                'price' => $request_data->price,
            ]

        );
       // dd(Cart::content());
        $cartItem->associate('Product');
       // Cart::associate($cartItem->rowId, 'App\Product');
       //dd($cartItem);

        return redirect()->route('cart');

    }

public function firstAdd($id){
//dd(request()->all());

    $request_data = Product::find($id);
    $cartItem = Cart::add(
        [
            'id' => $request_data->id,
            'name' => $request_data->name,
            //'image' => $request_data->image,

            'qty' =>1,
            'price' => $request_data->price,
        ]

    );
    // dd(Cart::content());
    $cartItem->associate('Product');
    // Cart::associate($cartItem->rowId, 'App\Product');
    //dd($cartItem);

    return redirect()->route('cart');

}
    public function cart(){
        return view('cart');
    }
    public function delete_cart($id){
        Cart::remove($id);
        return redirect()->back();
    }
    public function increment($id, $qty){
        Cart::update($id, $qty + 1);
        return redirect()->back();
    }
    public function decrement($id, $qty){
        Cart::update($id, $qty - 1);
        return redirect()->back();
    }

}
