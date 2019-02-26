<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;

class BooksController extends Controller
{

    public function allBooksSite($page, $language){
        if($language=="all"){
            $lang = ["vi", "en", "ja"];
        } else {
            $lang = [$language];
        }
        $bookNumberDisplace = 15;
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
        $data = array(
            "book" => $book,
        );
        return view('books.detailBook')->with($data);
    }
}
