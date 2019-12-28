<!DOCTYPE html>
<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Purchased Products </title>
</head>
<body>
<h1>Purchasing Order</h1>
<div class="form-control">
    <p>your order in cart by purchase</p>
    @foreach(Cart::content() as $cart)
        <p>Product : <span>{{ $cart->name }}</span></p>
        <p>quantity : <span>{{ $cart->qty }}</span></p>
        <p>Product : <span>${{ Cart::total() }}</span></p>
        @endforeach
</div>

</body>
</html>
