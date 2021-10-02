<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show-comments')->only(['index']);
        $this->middleware('can:edit-comment')->only(['update']);
        $this->middleware('can:delete-comment')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::whereApproved(1)->latest()->paginate(20);
        return view('admin.comments.all' , compact('comments'));
    }

    public function unapproved()
    {
        $comments = Comment::query();

        if($keyword = request('search')) {
            $comments->where('comment' , 'LIKE' , "%{$keyword}%")->orWhereHas('user' , function($query) use ($keyword) {
                $query->where('name' , 'LIKE' , "%{$keyword}%");
            });
        }

        $comments = $comments->whereApproved(0)->latest()->paginate(20);
        return view('admin.comments.unapproved' , compact('comments'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $comment->update([ 'approved' => 1]);

        alert()->success('نظر مورد نظر تایید شد');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        alert()->success('نظر شما با موفقیت حذف شد');

        return back();
    }
}
