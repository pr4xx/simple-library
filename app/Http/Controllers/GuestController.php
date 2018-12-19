<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function root()
    {
        if(auth()->check()) {
            return redirect('home');
        }

        return view('welcome');
    }
}
