<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Book;

class AdminBooksController extends Controller
{
    public function __construct()
    {
        $this->middleware(['checkAdmin']);
    }

    public function index(){
        return view('admins.index');
    }

    public function addBookSite(){
        return view('admins.books.addBook');
    }

    public function addBook(request $request){
        $request->validate([
            'name' => 'required',
        ]);
        $book = new Book;
        $book->name = $request->name;
        $book->language = $request->language;
        $book->author = $request->author;
        $book->quality = $request->quality;
        $book->image = $request->image;
        $book->intro = $request->intro;
        $result =$book->save();
        if($result){
            return redirect("/admin/all_books/1/all")->with("message", "messages.success");
        }
    }

    public function allBooksSite($page, $language){
        if($language=="all"){
            $lang = ["vi", "en", "ja"];
        } else {
            $lang = [$language];
        }
        $bookNumberDisplace = 30;
        if($page<1) $page=1;

        $books = Book::whereBetween('id', [($page-1)*$bookNumberDisplace+1, $page*$bookNumberDisplace])
            ->whereIn('language', $lang)
            ->select("id", "name", "author", "image", "language", "quality")
            ->get();
        if(!sizeof($books)){
            return redirect("/all_books/1/".$language);
        }
        $data = array(
            "books" => $books,
            "pageNum" => $page,
            "language" => $language,
        );
        return view('admins.books.allBooks')->with($data);
    }

    public function editBookSite($book_id){
        $book = Book::where('id', $book_id)->first();
        $data = array(
            "book" => $book,
        );
        return view('admins.books.editBook')->with($data);
    }

    public function editBook(request $request){
        Book::where("id", $request->book_id)
            ->update([
                "name" => $request->name,
                "author" => $request->author,
                "language" => $request->language,
                "image" => $request->image,
                "quality" => $request->quality,
                "intro" => $request->intro,
            ]);
        return redirect("/admin/all_books/1/all")->with("message", "messages.success");
    }
}