@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Fehler</div>

                <div class="panel-body">
                    <pre>{!! $error !!}</pre>
                </div>
            </div>
        </div>
    </div>
@endsection
