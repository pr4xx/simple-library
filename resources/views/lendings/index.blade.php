@extends('layouts.app')

@section('content')

    <table id="table" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>Signatur</th>
            <th>Buchtitel</th>
            <th>Leser*in ID</th>
            <th>Leser*in Nachname</th>
            <th>Leser*in Vorname</th>
            <th>Ausgeliehen am</th>
            <th>Status</th>
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
                    url: url('lendings/data'),
                    type: 'post'
                },
                stateSave: true,
                columns: [
                    {
                        data: 'book.signature',
                        name: 'book.signature',
                        render: function(data, type, row) {
                            if(row.returned_at) {
                                return data;
                            }

                            return datatablesClickable('lendings', 'edit')(data, type, row);
                        }
                    },
                    {
                        data: 'book.title',
                        name: 'book.title',
                        render: datatablesTrimText(15)
                    },
                    {
                        data: 'reader.id',
                        name: 'reader.id'
                    },
                    {
                        data: 'reader.last_name',
                        name: 'reader.last_name'
                    },
                    {
                        data: 'reader.first_name',
                        name: 'reader.first_name'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        searchable: false
                    },
                    {
                        data: 'returned_at',
                        name: 'returned_at',
                        defaultContent: '',
                        searchable: false,
                        orderable: false,
                        render: function(data, type, row) {
                            if(!data) {
                                var dateCreated = moment(row.created_at);

                                return '<span class="text-danger">Ausgeliehen ' +
                                    ' (seit ' + moment().diff(dateCreated, 'days') + ' Tagen)' + '</span>';
                            }

                            var dateReturned = moment(row.created_at);

                            return '<span class="text-success">Zurückgegeben' +
                                ' (nach ' + moment().diff(dateReturned, 'days') + ' Tagen)' + '</span>';
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
                            redirect('lendings/create');
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