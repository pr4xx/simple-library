@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-fw fa-edit"></i>
                    Orte bearbeiten
                </div>
                <div class="panel-body">

                    <form class="form-horizontal" method="post" action="{{ url('tables/tags/' . $tag->id) }}">
                        @csrf
                        @method('put')

                        @include('tags.form')

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
                                <a class="btn btn-default pull-right" href="{{ url('tables/tags') }}">
                                    Abbrechen
                                </a>
                            </div>
                        </div>
                    </form>

                    <form id="delete-form" method="post" action="{{ url('tables/tags/' . $tag->id) }}" style="display: none;">
                        @csrf
                        @method('delete')
                    </form>

                </div>
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