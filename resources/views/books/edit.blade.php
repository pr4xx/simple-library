@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-fw fa-edit"></i>
                    Bücher bearbeiten
                </div>
                <div class="panel-body">

                    <form class="form-horizontal" method="post" action="{{ url('books/' . $book->id) }}">
                        @csrf
                        @method('put')

                        @include('books.form')

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
                                <a class="btn btn-default pull-right" href="{{ url('books') }}">
                                    Abbrechen
                                </a>
                            </div>
                        </div>
                    </form>

                    <form id="delete-form" method="post" action="{{ url('books/' . $book->id) }}" style="display: none;">
                        @csrf
                        @method('delete')
                    </form>

                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-fw fa-book"></i>
                    Aktuelle Ausleihe
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th class="col-lg-3"></th>
                        <th class="col-lg-2"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($lendings as $lending)
                        <tr>
                            <td>
                                {{ $lending->reader->first_name }}
                                {{ $lending->reader->last_name }}
                            </td>
                            <td class="text-right">
                                <a href="{{ url('readers/' . $lending->reader->id . '/edit') }}">
                                    Leser*in
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
                            <td colspan="2"><i>Keine aktuelle Ausleihe</i></td>
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