@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-fw fa-edit"></i>
                    Leser*innen bearbeiten
                </div>
                <div class="panel-body">

                    <form class="form-horizontal" method="post" action="{{ url('readers/' . $reader->id) }}">
                        @csrf
                        @method('put')

                        @include('readers.form')

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-fw fa-check"></i>
                                    Speichern
                                </button>
                                <a class="btn btn-danger" href="#" onclick="deleteModel();">
                                    <i class="fa fa-fw fa-trash"></i>
                                    Löschen
                                </a>
                                <a class="btn btn-default pull-right" href="{{ url('readers') }}">
                                    Abbrechen
                                </a>
                            </div>
                        </div>
                    </form>

                    <form id="delete-form" method="post" action="{{ url('readers/' . $reader->id) }}" style="display: none;">
                        @csrf
                        @method('delete')
                    </form>

                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-fw fa-book"></i>
                    Aktuelle Ausleihen
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Signatur</th>
                        <th class="col-lg-2"></th>
                        <th class="col-lg-2"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($lendings as $lending)
                        <tr>
                            <td>
                                {{ $lending->book->signature }}
                            </td>
                            <td class="text-right">
                                <a href="{{ url('books/' . $lending->book->id . '/edit') }}">
                                    Buch
                                </a>
                            </td>
                            <td class="text-right">
                                <a href="{{ url('lendings/' . $lending->id . '/edit') }}">
                                    Ausleihe
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2"><i>Keine aktuellen Ausleihen</i></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script type="text/javascript">
        function deleteModel() {
            if(confirm('Sicher?')) {
                $('#delete-form').submit();
            }
        }
    </script>
@endpush