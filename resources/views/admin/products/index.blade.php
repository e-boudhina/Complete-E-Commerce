@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Products:    <a class="btn btn-success float-right" href="{{route('products.create')}}" >Create New Product</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead class="table-dark">
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
                </thead>

                <tbody>
                @if(count($products) > 0)
                    @foreach($products as $key => $product)
                        <tr>
                            <td>{{$key+1}}</td>
{{--                            to show and image use asset but to move it use public path--}}
                            <td><img src="{{asset('uploads/products/'.$product->image)}}" alt="Post image" width="90px"height="50px"></td>
                            <td>{{$product->name}}</td>
                            <td>
                                <a class="btn btn-info" href="{{route('products.edit',$product->id)}}" >Edit {{$product->id}}</a>

                            </td>


                            <td>
                                <form action="{{route('products.destroy',$product->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" type="submit" >Delete</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                @else
                    <tr >
                        <td colspan="4" class="text-center"><h2>There Are No Products Yet</h2></td>
                    </tr>
                @endif
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
