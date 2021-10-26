@extends('layouts.app')

@section('script')
<script>
    $('#sendComment').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        let parent_id = button.data('id');

        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('input[name="parent_id"]').val(parent_id)
    })

    // document.querySelector('#sendCommentForm').addEventListener('submit' , function(event) {
    //     event.preventDefault();
    //     let target = event.target;
    //
    //     let data = {
    //         commentable_id : target.querySelector('input[name="commentable_id"]').value,
    //         commentable_type: target.querySelector('input[name="commentable_type"]').value,
    //         parent_id: target.querySelector('input[name="parent_id"]').value,
    //         comment: target.querySelector('textarea[name="comment"]').value
    //     }
    //
    //     // if(data.comment.length < 2) {
    //     //     console.error('pls enter comment more than 2 char');
    //     //     return;
    //     // }
    //
    //
    //     $.ajaxSetup({
    //         headers : {
    //             'X-CSRF-TOKEN' : document.head.querySelector('meta[name="csrf-token"]').content,
    //             'Content-Type' : 'application/json'
    //         }
    //     })
    //
    //
    //     $.ajax({
    //         type : 'POST',
    //         url : '/comments',
    //         data : JSON.stringify(data),
    //         success : function(data) {
    //             console.log(data);
    //         }
    //     })
    // })
</script>
@endsection

@section('content')

@auth
<div class="modal fade" id="sendComment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ارسال نظر</h5>
                <button type="button" class="close mr-auto ml-0" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('send.comment') }}" method="post" id="sendCommentForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="commentable_id" value="{{ $product->id }}">
                    <input type="hidden" name="commentable_type" value="{{ get_class($product) }}">
                    <input type="hidden" name="parent_id" value="0">

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">پیام دیدگاه:</label>
                        <textarea name="comment" class="form-control" id="message-text"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">لغو</button>
                    <button type="submit" class="btn btn-primary">ارسال نظر</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endauth

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-outline d-flex justify-content-between">

                    <h3>{{ $product->title }}</h3>
                    @if(\App\Helpers\Cart\Cart::count($product) < $product->inventory)
                        <form action="{{ route('cart.add' , $product->id) }}" method="POST" id="add-to-cart">
                            @csrf
                        </form>
                        <span onclick="document.getElementById('add-to-cart').submit()" class="btn btn-sm btn-danger">اضافه کردن به سبد خرید({{number_format($product->price)}}T)</span>
                        @else
                        <h3 class="btn btn-warning">اتمام موجودی</h3>
                        @endif
                </div>

                <div class="photo-gallery">
                    <div class="container">
                        <div class="intro">
                            <h2 class="text-center">{{ $product->title }}</h2>
                        </div>
                        <div class="row photos">
                            <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="{{$product->image}}" data-lightbox="photos"><img class="card-img-top" src="{{$product->image}}"></a></div>
                            @foreach($product->gallery as $galery)
                            <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="{{$galery->image}}" data-lightbox="photos"><img class="card-img-top" src="{{$galery->image}}"></a></div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @if( $product->categories)
                <span class="text-muted">دسته بندی ها</span>
                @foreach( $product->categories as $cate)
                <div>
                    <span href="#">{{ $cate->name ." . "}}</span>
                </div>
                @endforeach
                @endif
                <br>
                @if( $product->attributes)
                <span class="text-muted">ویژگی ها</span>
                @foreach( $product->attributes->all() as $attr)
                <div>
                    <span href="#">{{ $attr->name .":". $attr->pivot->value->value}}</span>
                </div>
                @endforeach
                @endif
                <hr>
                {{ $product->description }}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="d-flex align-items-center justify-content-between">
            <h4 class="mt-4 mr-5">بخش نظرات</h4>
            @auth
            <span class="btn btn-sm btn-primary ml-5" data-toggle="modal" data-target="#sendComment" data-id="0">ثبت نظر جدید</span>
            @endauth
        </div>

        @guest
        <div class="alert alert-warning">برای ثبت نظر لطفا وارد سایت شوید.</div>
        @endguest

        @include('layouts.comments' , ['comments' => $product->comments()->where('approved' , 1)->where('parent_id',0)->get()])
    </div>
</div>
</div>
@endsection