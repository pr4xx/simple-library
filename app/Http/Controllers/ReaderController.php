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
            'last_name' => ['required'],
            'email' => ['nullable', 'email']
        ]);

        $reader = new Reader();
        $reader->last_name = $request->get('last_name');
        $reader->first_name = $request->get('first_name');
        $reader->street = $request->get('street');
        $reader->zip = $request->get('zip');
        $reader->city = $request->get('city');
        $reader->email = $request->get('email');
        $reader->mobile = $request->get('mobile');
        $reader->has_whatsapp = $request->has('has_whatsapp');
        $reader->paid_deposit = $request->has('paid_deposit');
        $reader->notes = $request->get('notes');
        $reader->save();

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
        $lendings = $reader->lendings()->with('book')->active()->latest()->get();

        return view('readers.edit', compact('reader', 'lendings'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'last_name' => ['required'],
            'email' => ['nullable', 'email']
        ]);

        $reader = Reader::findOrFail($id);
        $reader->last_name = $request->get('last_name');
        $reader->first_name = $request->get('first_name');
        $reader->street = $request->get('street');
        $reader->zip = $request->get('zip');
        $reader->city = $request->get('city');
        $reader->email = $request->get('email');
        $reader->mobile = $request->get('mobile');
        $reader->has_whatsapp = $request->has('has_whatsapp');
        $reader->paid_deposit = $request->has('paid_deposit');
        $reader->notes = $request->get('notes');
        $reader->save();

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
