@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-header">
                <h3>  محصولات دسته بندی {{$category->name}}</h3>
            </div>

            @foreach($products->chunk(4) as $row)
            <div class="row">
                @foreach($row as $product)
                <div class="col-3">
                    <div class="card card-group mb-2">
                        <img src="{{$product->image}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->title }}</h5>
                            <p class="card-text">{{ substr($product->description,0,50) . "..." }}</p>

                            <a href="/products/{{ $product->id }}" class="btn btn-primary">جزئیات محصول</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection