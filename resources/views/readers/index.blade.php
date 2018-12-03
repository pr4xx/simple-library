@extends('layouts.app')

@section('content')

    <table id="table" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nachname</th>
            <th>Vorname</th>
            <th>Straße, Hausnummer</th>
            <th>PLZ</th>
            <th>Ort</th>
            <th>E-Mail</th>
            <th>Mobilnummer</th>
            <th>Whatsapp?</th>
            <th>Pfand?</th>
            <th>Registriert am</th>
            <th>Bemerkung</th>
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
                ajax: url('readers/data'),
                stateSave: true,
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name',
                        render: datatablesClickable('readers', 'edit')
                    },
                    {
                        data: 'first_name',
                        name: 'first_name',
                        defaultContent: ''
                    },
                    {
                        data: 'street',
                        name: 'street',
                        defaultContent: ''
                    },
                    {
                        data: 'zip',
                        name: 'zip',
                        defaultContent: ''
                    },
                    {
                        data: 'city',
                        name: 'city',
                        defaultContent: ''
                    },
                    {
                        data: 'email',
                        name: 'email',
                        defaultContent: ''
                    },
                    {
                        data: 'mobile',
                        name: 'mobile',
                        defaultContent: ''
                    },
                    {
                        data: 'has_whatsapp',
                        name: 'has_whatsapp',
                        defaultContent: '',
                        render: datatablesBoolean
                    },
                    {
                        data: 'paid_deposit',
                        name: 'paid_deposit',
                        defaultContent: '',
                        render: datatablesBoolean
                    },
                    {
                        data: 'registered_at',
                        name: 'registered_at',
                        defaultContent: ''
                    },
                    {
                        data: 'notes',
                        name: 'notes',
                        defaultContent: '',
                        render: datatablesTrimText(30)
                    }
                ],
                order: [[1, 'asc']],
                dom:
                    "Z<'row'<'col-xs-6'B><'col-xs-6'f>>" +
                    "<'row'<'col-sm-6'><'col-sm-6'>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'li><'col-sm-7'p>>",
                buttons: [
                    {
                        text: '<i class="fa fa-fw fa-plus"></i> Hinzufügen',
                        action: function (e, dt, node, config) {
                            redirect('readers/create');
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