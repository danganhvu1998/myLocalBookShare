<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allBooksSite($page, $language){
        if($language=="all"){
            $lang = ["vi", "en", "ja"];
        } else {
            $lang = [$language];
        }
        $bookNumberDisplace = 15;
        $books = Book::whereBetween('id', [($page-1)*$bookNumberDisplace+1, $page*$bookNumberDisplace])
            ->whereIn('language', $lang)
            ->get();
        $data = array(
            "books" => $books,
        );
        return view('books.allBooks')->with($data);
    }

    public function detailBookSite($book_id){
        $book = Book::where("id", $book_id)->first();
        $data = array(
            "book" => $book,
        );
        return view('books.detailBook')->with($data);
    }
}
