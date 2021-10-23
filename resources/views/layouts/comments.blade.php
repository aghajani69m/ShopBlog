@foreach($comments as $comment )
<div class="card mt-3">
    <div class="card-comments d-flex justify-content-between">
        <div class="commenter d-flex">
            <span>{{ $comment->user->name }}</span>
            <span class="text-muted"> : {{ jdate($comment->created_at)->ago() }}</span>
        </div>
        @auth
      
        <span class="fa fa-reply" data-toggle="modal" data-target="#sendComment" data-id="{{ $comment->id }}">پاسخ</span>
 
        @endauth
    </div>

    <div class="card-body">
        {{ $comment->comment }}

        @include('layouts.comments' , [ 'comments' => $comment->child->where('approved',1) ])
    </div>
</div>
@endforeach