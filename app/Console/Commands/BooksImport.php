<?php

namespace App\Console\Commands;

use App\Imports\BooksImport as ExcelBooksImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class BooksImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:books';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Excel::import(new ExcelBooksImport(), 'books.xlsx');
    }
}
