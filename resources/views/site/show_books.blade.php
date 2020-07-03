@extends('layouts.site._aside')

@section('content')

    <div class="container">
        <div class="row medium-padding120">
            <div class="product-details">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    <div class="product-details-thumb">
                        <div class="swiper-container" data-effect="fade">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <div class="product-details-img-wrap swiper-slide">
                                    <img src="{{  $book->image_path }}" alt="product" data-swiper-parallax="-10">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 col-lg-offset-1 col-md-6 col-md-offset-1 col-sm-6 col-sm-offset-1 col-xs-12 col-xs-offset-0">
                    <div class="product-details-info">
                        <div class="product-details-info-price"> <span>Price : </span>{{ $book->price }}$</div>
                        <h3 class="product-details-info-title"><span>title : </span>{{ $book->title }}</h3>
                        <h3 class="product-details-info-title"><span>Author : </span>{{ $book->author }}</h3>
                        <h3 class="product-details-info-title"><span>Pages : </span>{{ $book->num_pages }} page</h3>
                        <h3 class="product-details-info-title"> <span>Date OF publish : </span>{{ $book->date_of_publish }}</h3>
                        <p class="product-details-info-text"><span>Description : </span>{{ $book->description }}</p>


                        <form action="{{ route('cart.add') }}" method="post">
                            {{ csrf_field() }}
                            <div class="quantity">
                                <a href="#" class="quantity-minus quantity-minus-d">-</a>
                                <input title="Qty" class="email input-text qty text" name="qty" type="text" value="1">
                                <a href="#" class="quantity-plus quantity-plus-d">+</a>
                            </div>

                            <input type="hidden" name="book_id" value="{{ $book->id }}">-


                            <button class="btn btn-medium btn--primary">
                                <span class="text">Add to Cart</span>
                                <i class="seoicon-commerce"></i>
                                <span class="semicircle"></span>
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
