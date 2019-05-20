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
                                        {{ $lending->book->title ?? 'Ohne Titel' }}
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
                            <label class="col-sm-2 control-label">Fällig am</label>
                            <div class="col-sm-10">
                                <div id="due-at-text"><p class="form-control-static">
                                        {{ optional($lending->due_at)->format('d.m.Y') ?? '-' }}
                                    </p>
                                    <span class="help-block">
                                        <button type="button" class="btn btn-xs btn-default" onclick="enableEdit();">
                                            Bearbeiten
                                        </button>
                                    </span>
                                </div>
                                <div id="due-at-edit" style="display: none;">
                                    <input type="hidden" id="update_due_at" name="update_due_at" value="1" disabled>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control" id="due_at" name="due_at"
                                               value="{{ optional($lending->due_at)->format('d.m.Y') ?? '' }}"
                                               placeholder="TT.MM.JJJJ">
                                    </div>
                                    <span class="help-block">
                                        <button type="button" class="btn btn-xs btn-default" onclick="disableEdit();">
                                            Abbrechen
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="return-button">
                                    <i class="fa fa-fw fa-check"></i>
                                    Zurückgeben
                                </button>
                                <button type="submit" class="btn btn-primary" id="update-button" style="display: none;">
                                    <i class="fa fa-fw fa-check"></i>
                                    Speichern
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
@push('scripts')
    <script type="text/javascript">
        var dueSelector = '#due_at';

        function enableEdit() {
            $('#return-button').hide();
            $('#due-at-text').hide();
            $('#update-button').show();
            $('#due-at-edit').show();
            $('#update_due_at').prop('disabled', false);
        }

        function disableEdit() {
            $('#return-button').show();
            $('#due-at-text').show();
            $('#update-button').hide();
            $('#due-at-edit').hide();
            $('#update_due_at').prop('disabled', true);
        }

        $(document).ready(function () {

            var datepickerOptions = {
                language: 'de',
                autoclose: true,
                orientation: 'bottom'
            };

            $(dueSelector).datepicker(datepickerOptions);

        });
    </script>
@endpush