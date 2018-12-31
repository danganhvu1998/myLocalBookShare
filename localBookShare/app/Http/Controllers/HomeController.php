<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function contactInformation(){
        $admin = User::where("id",1)->first();
        $data = array(
            "admin" => $admin,
        );
        return view('contactInformation')->with($data);
    }
}
