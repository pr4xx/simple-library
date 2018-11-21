@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Du bist nicht angemeldet</div>

                    <div class="panel-body">
                        <a href="{{ route('login') }}" class="btn btn-primary">Zur Anmeldung</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
