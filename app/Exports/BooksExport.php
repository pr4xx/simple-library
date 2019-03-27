<?php

namespace App\Exports;

use App\Book;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BooksExport implements FromView
{
    /**
     * @return View
     */
    public function view(): View
    {
        $with = [
            'author',
            'origin',
            'category',
            'tags',
            'lendings' => function ($query) {
                $query->whereNull('returned_at');
            },
            'lendings.reader'
        ];

        return view('exports.books', [
            'books' => Book::with($with)->get()
        ]);
    }
}
