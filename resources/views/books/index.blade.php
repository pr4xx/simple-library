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
            <th>Schlagworte</th>
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
                ajax: {
                    url: url('books/data'),
                    type: 'post'
                },
                stateSave: true,
                columns: [
                    {
                        data: 'signature',
                        name: 'signature',
                        render: datatablesClickable('books', 'edit')
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
                        name: 'author.name',
                        defaultContent: ''
                    },
                    {
                        data: 'origin.title',
                        name: 'origin.title',
                        defaultContent: ''
                    },
                    {
                        data: 'category.title',
                        name: 'category.title',
                        defaultContent: ''
                    },
                    {
                        data: 'tags',
                        name: 'tags.title',
                        orderable: false,
                        render: function(data, type, row) {
                            return _.map(data, 'title').join(', ');
                        }
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