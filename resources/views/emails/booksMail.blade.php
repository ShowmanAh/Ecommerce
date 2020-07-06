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
    @foreach ($books as $book)
       <p>{{ $book->title}}</p>
       <p>{{ $book->price}}</p>
       
    @endforeach

</div>

</body>
</html>
