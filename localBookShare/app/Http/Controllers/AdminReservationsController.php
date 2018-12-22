<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Book;
use App\Reservation;
use App\User;

class AdminReservationsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['checkAdmin']);
    }

    public function checkReservationSite($book_id, $code){
        $reservation = Reservation::where("borrow_time", $code)
            ->where("book_id", $book_id)
            ->where("status", "<", 2)
            ->first();
        if($reservation==NULL){
            return redirect("/admin/check_reservation_code")->withErrors("message.notFound");
        }
        $book = Book::where("id", $book_id)->first();
        $data = array(
            "reservation" => $reservation,
            "book" => $book,
        );
        return view("admins.reservations.checkReservation")->with($data);
    }

    public function checkReservationByCode(request $request){
        if(!strpos($request->reservation_code, "/")){
            return redirect("/admin/check_reservation_code")->withErrors("message.notFound");
        }
        return redirect("/admin/check_reservation_code/".$request->reservation_code);
    }

    public function checkReservationByCodeSite(){
        return view("admins.reservations.inputCode");
    }
}
