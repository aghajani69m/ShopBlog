@extends('main')

@section('content')

    <div class="center_content">
        <div class="center_title_bar">محصولات دسته بندی {{$category->name}}</div>
        @foreach($products as $product)
            <div class="prod_box">
                <div class="center_prod_box">
                    <!-- {{--                                    {{route('product.detail')}}--}} -->
                    <div class="product_title">
                        <a href="/products/{{ $product->id }}">
                            {{$product->title}}
                        </a>
                    </div>
                    <div class="product_img">
                        <a href="/products/{{ $product->id }}">
                            <img style=" width: 100px" src="{{$product->image}}" alt="" border="0"/>
                        </a>
                    </div>
                    <div class="prod_price">
                        {{--                                        <span class="reduce">350$</span> --}}
                        <span class="price">{{number_format($product->price)}} T
                        </span>
                    </div>
                </div>
                <div class="bottom_prod_box"></div>
                <div class="prod_details_tab">
                    <a href="/products/{{ $product->id }}" class="prod_details">جزییات</a>
                </div>
            </div>
        @endforeach
        {{--                            {{$products->render()}}--}}
    </div>

    @endsection
