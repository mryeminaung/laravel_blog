<?php

namespace App\Http\Controllers\comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create()
    {
        $comment = new Comment();

        $comment->content = request()->content;
        $comment->article_id = request()->article_id;
        $comment->save();

        return back()->with('comment', 'A new comment added successfully');
    }

    public function delete()
    {
        $comment = Comment::find(request()->comment);
        $comment->delete();

        return back()->with('comment', 'A comment deleted successfully');
    }
}
