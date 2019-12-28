@extends('layouts._aside')

@section('content')

    <header class="header" id="site-header">

        <div class="container">

            <div class="header-content-wrapper">

                <ul class="nav-add">
                    <li class="cart">

                        <a href="#" class="js-cart-animate">
                            <i class="seoicon-basket"></i>
                            <span class="cart-count">0</span>
                        </a>

                        <div class="cart-popup-wrap">
                            <div class="popup-cart">
                                <h4 class="title-cart">No products in the cart!</h4>
                                <p class="subtitle">Please make your choice.</p>
                                <div class="btn btn-small btn--dark">
                                    <span class="text">view all catalog</span>
                                </div>
                            </div>
                        </div>

                    </li>
                </ul>
            </div>

        </div>

    </header>




    <div class="container-fluid">
        <div class="row medium-padding120 bg-border-color">
            <div class="container">

                <div class="row">

                    <div class="col-lg-12">
                        <div class="order">
                            <h2 class="h1 order-title text-center align-center" style="color: #00adef; text-decoration: #1b1e21;">Your Order</h2>
                            <form action="#" method="post" class="cart-main">
                                <table class="shop_table cart">
                                    <thead class="cart-product-wrap-title-main">
                                    <tr>
                                        <th class="product-thumbnail">Product</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(Cart::content() as $cart)
                                    <tr class="cart_item">


                                        <td class="product-thumbnail">

                                            <div class="cart-product__item">
                                                <div class="cart-product-content">
                                                    <h5 class="cart-product-title">{{ $cart->name }}</h5>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="product-quantity">

                                            <div class="quantity">
                                               {{$cart->qty}}
                                            </div>

                                        </td>

                                        <td class="product-subtotal">
                                            <h5 class="total amount">${{ $cart->total() }}</h5>
                                        </td>


                                    </tr>
                                    @endforeach
                                    <tr class="cart_item total">

                                        <td class="product-thumbnail">


                                            <div class="cart-product-content">
                                                <h5 class="cart-product-title">Total:</h5>
                                            </div>


                                        </td>

                                        <td class="product-quantity">

                                        </td>

                                        <td class="product-subtotal">
                                            <h5 class="total amount">${{ number_format(Cart::total()) }}</h5>
                                        </td>
                                    </tr>

                                    </tbody>

                                </table>

                                <div class="cheque">

                                    <div class="logos">
                                        <a href="#" class="logos-item">
                                            <img src="{{ asset('app/img/visa.png') }}" alt="Visa">
                                        </a>
                                        <a href="#" class="logos-item">
                                            <img src="{{ asset('app/img/mastercard.png') }}" alt="MasterCard">
                                        </a>
                                        <a href="#" class="logos-item">
                                            <img src="{{ asset('app/img/discover.png') }}" alt="DISCOVER">
                                        </a>
                                        <a href="#" class="logos-item">
                                            <img src="{{ asset('app/img/amex.png') }}" alt="Amex">
                                        </a>

                                        <span style="float: right;">
								<form action="{{ route('cart.checkout') }}" method="POST">
                                    {{ csrf_field() }}
									  <script
                                          src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                          data-key="pk_test_3Y55FB9iBdgpHtiqix9ZBosN"
                                          data-amount="{{ Cart::total() * 100 }}"
                                          data-name="E_commerce Project"
                                          data-description="Buy Products"
                                          data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                          data-locale="auto" >

									  </script>
								</form>
							</span>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @endsection
