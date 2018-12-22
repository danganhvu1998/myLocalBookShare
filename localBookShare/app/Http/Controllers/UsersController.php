<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function editInformationsSite(){
        $data = array(
            "user" => Auth::user(),
        );
        return view("users.edit")->with($data);
    }

    public function editInformations(request $request){
        User::where("id", Auth::user()->id)
            ->update([
                "name" => $request->name,
                "language" => $request->language,
                "image" => $request->image,
            ]);
        return back()->with("message", "messages.success");;
    }
}
