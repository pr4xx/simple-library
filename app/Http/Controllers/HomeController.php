<?php

namespace App\Http\Controllers;

use App\Book;
use App\Lending;
use App\Reader;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::count();
        $readers = Reader::count();
        $lendings = Lending::count();
        $activeLendings = Lending::active()->count();
        $dueLendings = Lending::active()->due()->count();

        return view('home', compact('books', 'readers', 'lendings', 'activeLendings', 'dueLendings'));
    }
}
