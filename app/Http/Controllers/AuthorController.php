<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
{
    public function index()
    {
        return view('authors.index');
    }

    public function data()
    {
        $with = [];

        return datatables()->eloquent(Author::with($with)->select([
            'authors.*',
        ]))->toJson();
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', Rule::unique('authors')]
        ]);

        $author = new Author();
        $author->name = $request->get('name');
        $author->save();

        flash()->success('Gespeichert.');

        return redirect('tables/authors');
    }

    public function show($id)
    {
        return redirect('tables/authors/' . $id . '/edit');
    }

    public function edit($id)
    {
        $author = Author::findOrFail($id);

        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required', Rule::unique('authors')->ignore($id)]
        ]);

        $author = Author::findOrFail($id);
        $author->name = $request->get('name');
        $author->save();

        flash()->success('Gespeichert.');

        return redirect('tables/authors');
    }

    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        flash()->success('Gelöscht.');

        return redirect('tables/authors');
    }
}
