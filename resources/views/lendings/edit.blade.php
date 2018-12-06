@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-fw fa-edit"></i>
                    Ausleihe beenden
                </div>
                <div class="panel-body">

                    <form class="form-horizontal" method="post" action="{{ url('lendings/' . $lending->id) }}">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Buch</label>
                            <div class="col-sm-10">
                                <p class="form-control-static">
                                    <a href="{{ url('books/' . $lending->book->id . '/edit') }}">
                                        {{ $lending->book->title }}
                                    </a>
                                    <br>
                                    <span class="text-muted">
                                        {{ $lending->book->signature }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Leser*in</label>
                            <div class="col-sm-10">
                                <p class="form-control-static">
                                    <a href="{{ url('readers/' . $lending->reader->id . '/edit') }}">
                                        {{ $lending->reader->first_name }}
                                        {{ $lending->reader->last_name }}
                                    </a>
                                    <br>
                                    <span class="text-muted">
                                        ID: {{ $lending->reader->id }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-fw fa-check"></i>
                                    Zurückgeben
                                </button>
                                <a class="btn btn-default pull-right" href="{{ url('lendings') }}">
                                    Abbrechen
                                </a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection