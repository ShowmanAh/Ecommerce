@extends('layouts.site._aside')

@section('content')
    <div class="container">
        <div class="row pt120">
            <div class="books-grid">

                <div class="row mb30">
                    @foreach($books as $book)
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 img-thumbnail" style="margin-bottom: 50px;">

                            <div class="books-item">
                                <div class="books-item-thumb">
                                    <img src="{{ $book->image_path }}" alt="book">

                                </div>

                                <div class="books-item-info">

                                        <h5 class="books-title">{{ $book->title }}</h5>


                                    <div class="books-price">${{ $book->price }}</div>
                                </div>
                        @if (auth()->user())
                        <a href="{{ route('book.show', ['id' => $book->id]) }}" class="btn btn-small btn--dark add">
                            <span class="text" style="margin-top: 50px;">Add Cart</span>
                            <i class="seoicon-commerce"></i>
                        </a>
                        @else
                        <a href="#" class="btn btn-small btn--dark add">
                            <span class="text disabled" style="margin-top: 50px;">Add Cart</span>
                            <i class="seoicon-commerce"></i>
                        </a>
                        @endif


                            </div>
                        </div>
                    @endforeach

                </div>






            </div>
        </div>
    </div>

@endsection
