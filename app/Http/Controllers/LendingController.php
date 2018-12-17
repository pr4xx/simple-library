<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Lending;
use App\Category;
use App\Origin;
use App\Reader;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LendingController extends Controller
{
    public function index()
    {
        return view('lendings.index');
    }

    public function data()
    {
        $with = [
            'book',
            'reader'
        ];

        return datatables()->eloquent(Lending::with($with)->select([
            'lendings.*',
        ]))->toJson();
    }

    public function create()
    {
        $books = Book::with('author')->available()->orderBy('title')->get();
        $readers = Reader::orderBy('first_name')->get();

        return view('lendings.create', compact('books', 'readers'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'book_ids' => ['required', 'array'],
            'reader_id' => ['required'],
            'due_at' => ['required', 'date_format:d.m.Y'],
        ]);

        $reader = Reader::find($request->get('reader_id'));
        $dueAt = Carbon::createFromFormat('d.m.Y', $request->get('due_at'));

        foreach($request->get('book_ids', []) as $bookId) {
            $lending = new Lending();
            $lending->book_id = optional(Book::available()->find($bookId))->id;
            $lending->reader_id = optional($reader)->id;
            $lending->due_at = $dueAt;
            $lending->save();
        }

        flash()->success('Gespeichert.');

        return redirect('lendings');
    }

    public function show($id)
    {
        return redirect('lendings/' . $id . '/edit');
    }

    public function edit($id)
    {
        $lending = Lending::findOrFail($id);

        return view('lendings.edit', compact('lending'));
    }

    public function update(Request $request, $id)
    {
        $lending = Lending::findOrFail($id);
        $lending->returned_at = now();
        $lending->save();

        flash()->success('Gespeichert.');

        return redirect('lendings');
    }
}
