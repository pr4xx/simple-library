<?php

namespace App\Http\Controllers;

use App\Author;
use App\Reader;
use App\Category;
use App\Origin;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReaderController extends Controller
{
    public function index()
    {
        return view('readers.index');
    }

    public function data()
    {
        $with = [];

        return datatables()->eloquent(Reader::with($with)->select([
            'readers.*',
        ]))->toJson();
    }

    public function create()
    {
        return view('readers.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'signature' => ['required', Rule::unique('readers')]
        ]);

        $reader = new Reader();
        $reader->signature = $request->get('signature');
        $reader->title = $request->get('title');
        $reader->original_title = $request->get('original_title');
        $reader->author_id = optional(Author::find($request->get('author_id')))->id;
        $reader->origin_id = optional(Origin::find($request->get('origin_id')))->id;
        $reader->category_id = optional(Category::find($request->get('category_id')))->id;
        $reader->save();
        $reader->tags()->sync(Tag::findMany($request->get('tag_ids', []))->pluck('id')->toArray());

        flash()->success('Gespeichert.');

        return redirect('readers');
    }

    public function show($id)
    {
        return redirect('readers/' . $id . '/edit');
    }

    public function edit($id)
    {
        $reader = Reader::findOrFail($id);
        $authors = Author::orderBy('name')->get();
        $origins = Origin::orderBy('title')->get();
        $categories = Category::orderBy('title')->get();
        $tags = Tag::orderBy('title')->get();

        return view('readers.edit', compact('reader', 'authors', 'origins', 'categories', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'signature' => ['required', Rule::unique('readers')->ignore($id)]
        ]);

        $reader = Reader::findOrFail($id);
        $reader->signature = $request->get('signature');
        $reader->title = $request->get('title');
        $reader->original_title = $request->get('original_title');
        $reader->author_id = optional(Author::find($request->get('author_id')))->id;
        $reader->origin_id = optional(Origin::find($request->get('origin_id')))->id;
        $reader->category_id = optional(Category::find($request->get('category_id')))->id;
        $reader->save();
        $reader->tags()->sync(Tag::findMany($request->get('tag_ids', []))->pluck('id')->toArray());

        flash()->success('Gespeichert.');

        return redirect('readers');
    }

    public function destroy($id)
    {
        $reader = Reader::findOrFail($id);
        $reader->delete();

        flash()->success('Gelöscht.');

        return redirect('readers');
    }
}
