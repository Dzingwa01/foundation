@extends('layouts.admin-layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h6 style="text-transform:uppercase;text-align: center;font-weight: bolder;margin-top:2em;">Foundation Mutual - Employee Roles</h6>
        </div>
        <div class="row" style="margin-left: 2em;margin-right: 2em;">
            <div class="col s12" style="margin-bottom: 5em!important;">
                <table class="table table-bordered" style="width: 100%!important;" id="roles-table">
                    <thead>
                    <tr>
                        <th>Role Name</th>
                        <th>Display Name</th>
                        <th>Guard</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large tooltipped btn modal-trigger" data-position="left" data-tooltip="Add New Role" href="#modal1">
                <i class="large material-icons">add</i>
            </a>

        </div>
        <div id="modal1" class="modal modal-fixed-footer">
            <div class="modal-content">
                <h5 style="font-weight: bolder;text-align: center">Add New Role</h5>
                <div class="row">
                    <form id="role-form" class="col s12">
                        @csrf
                        <div class="row">
                            <div class="input-field col m6">
                                <input id="name" type="text" required class="validate">
                                <label for="name">Role Name</label>
                            </div>
                            <div class="input-field col m6">
                                <input id="display_name" type="text" required class="validate">
                                <label for="display_name">Display Name</label>
                            </div>
                        </div>
                        <div class="row">

                            <div class="input-field col m6">
                                <input id="guard_name" required type="text" class="validate">
                                <label for="guard_name">Guard Name</label>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn">Cancel<i class="material-icons right">close</i> </a>
                <button class="btn waves-effect waves-light" style="margin-left:2em;" id="save-role" name="action">Save
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </div>

        <style>
            th{
                text-transform: uppercase!important;
            }
        </style>
    </div>
    @push('custom-scripts')

        <script>
            $(document).ready(function () {
                $('select').formSelect();
                $(function () {
                    $('#roles-table').DataTable({
                        processing: true,
                        serverSide: true,
                        paging: true,
                        responsive: true,
                        scrollX: 640,
                        ajax: '{{route('get-roles')}}',
                        columns: [
                            {data: 'name', name: 'name'},
                            {data: 'display_name', name: 'display_name'},
                            {data: 'guard_name', name: 'guard_name'},
                          {data: 'action', name: 'action', orderable: false, searchable: false}
                        ]
                    });
                    $('select[name="roles-table_length"]').css("display","inline");
                });

            });
            $('#save-role').on('click',function(e){
                // e.preventDefault();
                let formData = new FormData();
                formData.append('name', $('#name').val());
                formData.append('display_name', $('#display_name').val());
                formData.append('guard_name', $('#guard_name').val());

                $.ajax({
                    url: "{{ route('roles.store') }}",
                    processData: false,
                    contentType: false,
                    data: formData,
                    type: 'post',

                    success: function (response, a, b) {
                        console.log("success",response);
                        alert(response.message);
                        window.location.reload();
                    },
                    error: function (response) {
                        console.log("error",response);
                        let message = response.responseJSON.message;
                        console.log("error",message);
                        let errors = response.responseJSON.errors;

                        for (var error in   errors) {
                            console.log("error",error)
                            if( errors.hasOwnProperty(error) ) {
                                message += errors[error] + "\n";
                            }
                        }
                        alert(message);

                    }
                });
            });
        </script>
    @endpush
@endsection
