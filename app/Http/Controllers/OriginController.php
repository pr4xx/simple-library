<?php

namespace App\Http\Controllers;

use App\Origin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OriginController extends Controller
{
    public function index()
    {
        return view('origins.index');
    }

    public function data()
    {
        $with = [];

        return datatables()->eloquent(Origin::with($with)->select([
            'origins.*',
        ]))->toJson();
    }

    public function create()
    {
        return view('origins.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', Rule::unique('origins')]
        ]);

        $origin = new Origin();
        $origin->title = $request->get('title');
        $origin->save();

        flash()->success('Gespeichert.');

        return redirect('tables/origins');
    }

    public function show($id)
    {
        return redirect('tables/origins/' . $id . '/edit');
    }

    public function edit($id)
    {
        $origin = Origin::findOrFail($id);

        return view('origins.edit', compact('origin'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => ['required', Rule::unique('origins')->ignore($id)]
        ]);

        $origin = Origin::findOrFail($id);
        $origin->title = $request->get('title');
        $origin->save();

        flash()->success('Gespeichert.');

        return redirect('tables/origins');
    }

    public function destroy($id)
    {
        $origin = Origin::findOrFail($id);
        $origin->delete();

        flash()->success('Gelöscht.');

        return redirect('tables/origins');
    }
}
