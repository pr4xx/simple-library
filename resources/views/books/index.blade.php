@extends('layouts.app')

@section('content')

    <table id="table" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>Signatur</th>
            <th>Titel</th>
            <th>Titel (Original)</th>
            <th>Autor*in</th>
            <th>Ort</th>
            <th>Gattung</th>
        </tr>
        </thead>
    </table>

@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            $('#table').DataTable({
                serverSide: true,
                processing: true,
                ajax: url('books/data'),
                stateSave: true,
                columns: [
                    {
                        data: 'signature',
                        name: 'signature'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'original_title',
                        name: 'original_title'
                    },
                    {
                        data: 'author.name',
                        name: 'author.name'
                    },
                    {
                        data: 'origin.title',
                        name: 'origin.title'
                    },
                    {
                        data: 'category.title',
                        name: 'category.title'
                    }
                ],
                order: [[0, 'asc']],
                dom:
                    "Z<'row'<'col-xs-6'B><'col-xs-6'f>>" +
                    "<'row'<'col-sm-6'><'col-sm-6'>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'li><'col-sm-7'p>>",
                buttons: [
                    {
                        text: '<i class="fa fa-fw fa-plus"></i> Hinzufügen',
                        action: function (e, dt, node, config) {
                            redirect('books/create');
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa fa-fw fa-eye"></i> Spalten anzeigen'
                    }
                ]
            });

        });
    </script>
@endpush