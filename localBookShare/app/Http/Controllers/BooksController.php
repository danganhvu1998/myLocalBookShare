<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;
use App\Comment;
use App\User;

class BooksController extends Controller
{

    public function allBooksSite($page, $language){
        if($language=="all"){
            $lang = ["vi", "en", "ja"];
        } else {
            $lang = [$language];
        }
        $bookNumberDisplace = 30;
        if($page<1) $page=1;
        $books = Book::whereIn('language', $lang)
            ->skip($bookNumberDisplace*($page-1))
            ->take($bookNumberDisplace)
            ->get();
        if(!sizeof($books)){
            return redirect("/all_books/1/".$language);
        }
        $data = array(
            "books" => $books,
            "pageNum" => $page,
            "language" => $language,
        );
        return view('books.allBooks')->with($data);
    }

    public function detailBookSite($book_id){
        $book = Book::where("id", $book_id)->first();
        $comments = Comment::where("book_id", $book_id)
            ->join("users", "users.id", "=", "comments.user_id")
            ->select("comments.*", "users.name", "users.image")
            ->orderBy('id', 'desc')
            ->limit(20)
            ->get();
        $adminComment = Comment::where("book_id", $book_id)
            ->where("user_id", 1)
            ->first();
        if($adminComment){
            $adminComment = $adminComment["content"];
        } else {
            $adminComment = "";
        }
        $data = array(
            "book" => $book,
            "comments" => $comments,
            "adminComment" => $adminComment,
        );
        return view('books.detailBook')->with($data);
    }

    public function aboutSite(){
        return view('books.about');
    }
}
