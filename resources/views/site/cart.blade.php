@extends('layouts.site._aside')

@section('content')


    <div class="container-fluid">
        <div class="row bg-border-color medium-padding120">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12">

                        <div class="cart">

                            <h1 class="cart-title">In Your Shopping Cart: <span class="c-primary"> {{ Cart::content()->count() }} Items</span></h1>

                        </div>

                        <form action="#" method="post" class="cart-main">

                            <table class="shop_table cart">
                                <thead class="cart-product-wrap-title-main">
                                <tr>
                                    <th class="product-remove">&nbsp;</th>
                                    <th class="product-thumbnail">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( Cart::content() as $cart)


                                <tr class="cart_item">

                                    <td class="product-remove">
                                        <a href="{{ route('cart.delete', ['id' => $cart->rowId]) }}" class="product-del remove" title="Remove this item">
                                            <i class="seoicon-delete-bold"></i>
                                        </a>
                                    </td>


                                    <td class="product-thumbnail">

                                        <div class="cart-product__item">

                                            <div class="cart-product-content">
                                                <p class="cart-author">{{ $cart->name }}</p>

                                            </div>
                                        </div>
                                    </td>

                                    <td class="product-price">
                                        <h5 class="price amount">${{$cart->price}}</h5>
                                    </td>

                                    <td class="product-quantity">

                                        <div class="quantity">
                                            <a href="{{ route('cart.decrement', ['id' => $cart->rowId, 'qty' => $cart->qty]) }}" class="quantity-minus ">-</a>
                                            <input title="Qty"  name="qty" class="email input-text qty text" type="text" placeholder="1" readonly value="{{ $cart->qty }}">
                                            <a href="{{ route('cart.increment', ['id' => $cart->rowId, 'qty' => $cart->qty]) }}" class="quantity-plus ">+</a>
                                        </div>

                                    </td>

                                    <td class="product-subtotal">
                                        <h5 class="total amount">${{ $cart->total() }}</h5>
                                    </td>

                                </tr>

                             @endforeach

                                

                                </tbody>
                            </table>


                        </form>

                        <div class="cart-total">
                            <h3 class="cart-total-title">Cart Totals</h3>
                            <h5 class="cart-total-total">Total: <span class="price">${{ Cart::total() }}</span></h5>
                            <a href="{{ route('cart.checkout') }}" class="btn btn-medium btn--light-green btn-hover-shadow">
                                <span class="text">Checkout</span>
                                <span class="semicircle"></span>
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>





    @endsection
