@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-fw fa-plus"></i>
                    Autor*innen hinzufügen
                </div>
                <div class="panel-body">

                    <form class="form-horizontal" method="post" action="{{ url('tables/authors') }}">
                        @csrf

                        @include('authors.form', ['author' => null])

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-fw fa-check"></i>
                                    Speichern
                                </button>
                                <a class="btn btn-default pull-right" href="{{ url('tables/authors') }}">
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