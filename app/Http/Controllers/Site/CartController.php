<?php

namespace App\Http\Controllers\Site;

use Cart;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class CartController extends Controller
{
   public function add_to_cart(Request $request){
      // dd($request->all());
    $request_data = Book::find($request->book_id);
    $cartItem = Cart::add(
        [
            'id' => $request_data->id,
            'name' => $request_data->title,
            //'image' => $request_data->image,

            'qty' => $request->qty,
            'price' => $request_data->price,
        ]

    );
    //dd($cartItem);
   // dd(Cart::content());
    $cartItem->associate('Book');
   // Cart::associate($cartItem->rowId, 'App\Product');
   //dd($cartItem);
    Session::flash('success', 'Cart Added Successfully');

    return redirect()->route('site.cart');

}
public function cart(){
    return view('site.cart');
}
public function firstAdd($id){
    //dd(request()->all());

        $request_data = Book::find($id);
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
        Session::flash('success' , 'Product Added Successfully');

        return redirect()->route('site.cart');

    }
    public function delete_cart($id){
        Cart::remove($id);
        Session::flash('success' , 'Cart Deleted Successfully');
        return redirect()->back();
    }
    public function increment($id, $qty){
        Cart::update($id, $qty + 1);
        Session::flash('success' , 'Cart increment by 1 Successfully');
        return redirect()->back();
    }
    public function decrement($id, $qty){
        Cart::update($id, $qty - 1);
        Session::flash('success' , 'Cart decrement by 1 Successfully');
        return redirect()->back();
    }
}
