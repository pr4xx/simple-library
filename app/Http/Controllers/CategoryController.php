<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index');
    }

    public function data()
    {
        $with = [];

        return datatables()->eloquent(Category::with($with)->select([
            'categories.*',
        ]))->toJson();
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', Rule::unique('categories')]
        ]);

        $category = new Category();
        $category->title = $request->get('title');
        $category->save();

        flash()->success('Gespeichert.');

        return redirect('tables/categories');
    }

    public function show($id)
    {
        return redirect('tables/categories/' . $id . '/edit');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => ['required', Rule::unique('categories')->ignore($id)]
        ]);

        $category = Category::findOrFail($id);
        $category->title = $request->get('title');
        $category->save();

        flash()->success('Gespeichert.');

        return redirect('tables/categories');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        flash()->success('Gelöscht.');

        return redirect('tables/categories');
    }
}
