@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">

            <div class="card-header">
                Products:    <a class="btn btn-outline-dark btn-sm float-right" href="{{route('products.index')}}" >Go Back</a>
            </div>
            <div class="card-body">
                @include('admin.include.session_messages')


                <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group">
                        <label for="title">Name : </label>
                        <input type="text" name="name" class="form-control" placeholder="Name" id="name" value="{{old('name')}}">
                    </div>



                    <div class="form-group">
                        <label for="content">Price : </label>
                        <input type="text" name="price" class="form-control" placeholder="Text" id="price" value="{{old('price')}}">
                    </div>

                    <div class="form-group">
                        <label for="image">Product Image : </label>
                        <input type="file" name="image" class="form-control" id="image" value="{{old('image')}}">
                    </div>

                    <div class="form-group">
                        <label for="content">Description : </label>
                        <textarea type="text" name="description" class="form-control" placeholder="Description" id="content">{{old('description')}}</textarea>
                    </div>

                    <div class="form-group">
                        <div class="text-center">
                            <button type="submit" class="btn btn-success" >Store Product</button>
                        </div>
                    </div>

                </form>


            </div>
        </div>
    </div>
@endsection
