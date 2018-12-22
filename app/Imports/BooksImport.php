<?php

namespace App\Imports;

use App\Book;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class BooksImport implements WithMultipleSheets
{
    /**
     * @return array
     */
    public function sheets(): array
    {
        return [
            0 => new FirstBooksSheetImport(),
            1 => new SecondBooksSheetImport(),
            2 => new ThirdBooksSheetImport(),
            3 => new ForthBooksSheetImport(),
        ];
    }
}
