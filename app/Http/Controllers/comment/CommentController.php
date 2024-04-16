<?php

namespace App\Http\Controllers\comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $comment = new Comment();

        $comment->content = request()->content;
        $comment->user_id = Auth::id();
        $comment->article_id = request()->article_id;
        $comment->save();

        return back()->with('comment', 'A new comment added successfully');
    }

    public function delete($article, $comment)
    {
        $comment = Comment::find($comment);
        $comment->delete();

        return back()->with('comment', 'A comment deleted successfully');
    }
}
