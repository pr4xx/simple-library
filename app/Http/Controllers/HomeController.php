<?php

namespace App\Http\Controllers;

use App\Book;
use App\Lending;
use App\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

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

    public function backup()
    {
        $oldFiles = Storage::allFiles('backup');

        foreach ($oldFiles as $file) {
            Storage::delete($file);
        }

        Artisan::call('backup:run');

        $newFiles = Storage::allFiles('backup');

        if(count($newFiles) === 1) {
            return Storage::download($newFiles[0]);
        }

        return view('backup-error', [
            'error' => Artisan::output()
        ]);
    }
}
