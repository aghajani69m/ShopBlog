@extends('profile.layout')

@section('main')
<table class="table">
    <tbody>
        <tr>
            <th>آی دی محصول</th>
            <th>عنوان محصول</th>
            <th>تعداد سفارش</th>
            <th>هزینه نهایی</th>
        </tr>

        @foreach($order->products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td><a href="/products/{{$product->id}}">{{ $product->title }}</a></td>
            <td>{{ $product->pivot->quantity }}</td>
            <td>{{ $product->pivot->quantity * $product->pivot->price }}</td>
        </tr>
        @endforeach


    </tbody>
</table>
@endsection