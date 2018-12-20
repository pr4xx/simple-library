@extends('layouts.app')

@section('content')

    <table id="table" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>Name</th>
            <th>Bemerkungen</th>
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
                    url: url('tables/authors/data'),
                    type: 'post'
                },
                stateSave: true,
                columns: [
                    {
                        data: 'name',
                        name: 'name',
                        render: datatablesClickable('tables/authors', 'edit')
                    },
                    {
                        data: 'notes',
                        name: 'notes'
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
                            redirect('tables/authors/create');
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