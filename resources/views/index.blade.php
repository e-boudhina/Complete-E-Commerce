@extends('layouts.front')
@section('content')
    <div class="container">
        <div class="row pt120">
            <div class="books-grid">

                <div class="row mb30">
                    @foreach($products as $product)

                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="books-item">
                            <div class="books-item-thumb">
                                <img src="{{asset('uploads/products/'.$product->image)}}" alt="book">
                                <div class="new">New</div>
                                <div class="sale">Sale</div>
                                <div class="overlay overlay-books"></div>
                            </div>

                            <div class="books-item-info">
                            <a href="{{route('product.single',$product->id)}}"><h5 class="books-title">{{$product->name}}</h5></a>
                                <div class="books-price">{{$product->price}}</div>
                            </div>

                            <a href="{{route('cart.rapid-add',$product->id)}}" class="btn btn-small btn--dark add">
                                <span class="text">Add to Cart</span>
                                <i class="seoicon-commerce"></i>
                            </a>

                        </div>
                    </div>
                    @endforeach

                </div>
                <div class="row pb12">

                    <div class="col-lg-12">
{{--                        We overrided the laravel/core default pagination by using php artisan vendor publish (file name tailwind.blade.php)--}}
                        {{$products->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
