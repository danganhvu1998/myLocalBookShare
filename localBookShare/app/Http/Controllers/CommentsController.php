<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Book;
use App\Comment;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkToComment');
    }

    public function addComment(request $request){
        $comment = New Comment;
        $comment->user_id = Auth::user()->id;
        $comment->book_id = $request->book_id;
        $comment->content = $request->content;
        $comment->save();
        return back();
    }

    public function deleteComment(){
        return 2;
    }
}
