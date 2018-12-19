@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">Bücher</div>
                <div class="panel-body text-center">
                    <h1><i class="fa fa-fw fa-book"></i> {{ $books }}</h1>
                    <small class="text-muted">{{ $activeLendings }} ausgeliehen</small>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">Leser*innen</div>
                <div class="panel-body text-center">
                    <h1><i class="fa fa-fw fa-users"></i> {{ $readers }}</h1>
                    <small>&nbsp;</small>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">Ausleihen</div>
                <div class="panel-body text-center">
                    <h1><i class="fa fa-fw fa-clock-o"></i> {{ $lendings }}</h1>
                    <small class="text-muted">{{ $dueLendings }} überfällig</small>
                </div>
            </div>
        </div>
    </div>
@endsection
