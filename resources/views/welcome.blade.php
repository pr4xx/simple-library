@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Du bist nicht angemeldet</div>

                <div class="panel-body">
                    <a href="{{ route('login') }}" class="btn btn-primary">Zur Anmeldung</a>
                </div>
            </div>
        </div>
    </div>
@endsection
