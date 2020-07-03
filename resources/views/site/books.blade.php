@extends('layouts.site._aside')

@section('content')
    <div class="container">
        <div class="row pt120">
            <div class="books-grid">

                <div class="row mb30">
                    @foreach($books as $book)
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="books-item">
                                <div class="books-item-thumb">
                                    <img src="{{ $book->image_path }}" alt="book">

                                </div>

                                <div class="books-item-info">
                                    <a href="{{ route('book.show', ['id' => $book->id ]) }}">
                                        <h5 class="books-title">{{ $book->title }}</h5>
                                    </a>

                                    <div class="books-price">${{ $book->price }}$</div>
                                </div>

                                <a href="{{ route('cart.firstAdd', ['id' => $book->id]) }}" class="btn btn-small btn--dark add">
                                    <span class="text">Add to Cart</span>
                                    <i class="seoicon-commerce"></i>
                                </a>

                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="row pb120">

                    <div class="col-lg-12">{{ $books->links()  }}</div>

                </div>


            </div>
        </div>
    </div>
@endsection
