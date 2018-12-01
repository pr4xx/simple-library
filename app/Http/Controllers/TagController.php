<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    public function index()
    {
        return view('tags.index');
    }

    public function data()
    {
        $with = [];

        return datatables()->eloquent(Tag::with($with)->select([
            'tags.*',
        ]))->toJson();
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', Rule::unique('tags')]
        ]);

        $tag = new Tag();
        $tag->title = $request->get('title');
        $tag->save();

        flash()->success('Gespeichert.');

        return redirect('tables/tags');
    }

    public function show($id)
    {
        return redirect('tables/tags/' . $id . '/edit');
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);

        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => ['required', Rule::unique('tags')->ignore($id)]
        ]);

        $tag = Tag::findOrFail($id);
        $tag->title = $request->get('title');
        $tag->save();

        flash()->success('Gespeichert.');

        return redirect('tables/tags');
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        flash()->success('Gelöscht.');

        return redirect('tables/tags');
    }
}
