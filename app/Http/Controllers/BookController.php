<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Category;
use App\Origin;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index()
    {
        return view('books.index');
    }

    public function data()
    {
        $with = [
            'author',
            'origin',
            'category',
            'tags'
        ];

        return datatables()->eloquent(Book::with($with)->select([
            'books.*',
        ]))->toJson();
    }

    public function create()
    {
        $authors = Author::orderBy('name')->get();
        $origins = Origin::orderBy('title')->get();
        $categories = Category::orderBy('title')->get();
        $tags = Tag::orderBy('title')->get();

        return view('books.create', compact('authors', 'origins', 'categories', 'tags'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'signature' => ['required', Rule::unique('books')],
            'author_name' => ['nullable', Rule::unique('authors', 'name')],
            'origin_title' => ['nullable', Rule::unique('origins', 'title')],
            'year' => ['nullable', 'integer']
        ]);

        $book = new Book();
        $book->signature = $request->get('signature');
        $book->title = $request->get('title');
        $book->original_title = $request->get('original_title');
        $book->translated_title = $request->get('translated_title');
        $book->year = $request->get('year');
        $book->notes = $request->get('notes');

        if($authorName = $request->get('author_name')) {
            $author = new Author();
            $author->name = $authorName;
            $author->save();
            $book->author_id = $author->id;
        } else {
            $book->author_id = optional(Author::find($request->get('author_id')))->id;
        }

        if($originTitle = $request->get('origin_title')) {
            $origin = new Origin();
            $origin->title = $originTitle;
            $origin->save();
            $book->origin_id = $origin->id;
        } else {
            $book->origin_id = optional(Origin::find($request->get('origin_id')))->id;
        }

        $book->category_id = optional(Category::find($request->get('category_id')))->id;
        $book->save();
        $book->tags()->sync(Tag::findMany($request->get('tag_ids', []))->pluck('id')->toArray());

        flash()->success('Gespeichert.');

        return redirect('books');
    }

    public function show($id)
    {
        return redirect('books/' . $id . '/edit');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::orderBy('name')->get();
        $origins = Origin::orderBy('title')->get();
        $categories = Category::orderBy('title')->get();
        $tags = Tag::orderBy('title')->get();
        $lendings = $book->lendings()->with('reader')->active()->latest()->get();

        return view('books.edit', compact('book', 'authors', 'origins', 'categories', 'tags', 'lendings'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'signature' => ['required', Rule::unique('books')->ignore($id)],
            'year' => ['nullable', 'integer']
        ]);

        $book = Book::findOrFail($id);
        $book->signature = $request->get('signature');
        $book->title = $request->get('title');
        $book->translated_title = $request->get('translated_title');
        $book->year = $request->get('year');
        $book->notes = $request->get('notes');
        $book->original_title = $request->get('original_title');
        $book->author_id = optional(Author::find($request->get('author_id')))->id;
        $book->origin_id = optional(Origin::find($request->get('origin_id')))->id;
        $book->category_id = optional(Category::find($request->get('category_id')))->id;
        $book->save();
        $book->tags()->sync(Tag::findMany($request->get('tag_ids', []))->pluck('id')->toArray());

        flash()->success('Gespeichert.');

        return redirect('books');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        flash()->success('Gelöscht.');

        return redirect('books');
    }
}
