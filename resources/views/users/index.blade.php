@extends('layouts.admin-layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h6 style="text-transform:uppercase;text-align: center;font-weight: bolder;margin-top:2em;">Foundation Mutual Employees</h6>
            {{--<a class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>--}}
        </div>
        <div class="row" style="margin-left: 2em;margin-right: 2em;">
            <div class="col s12" style="margin-bottom: 5em!important;">
                <table class="table table-bordered" style="width: 100%!important;" id="users-table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Email</th>
                        <th>Employee Code</th>
                        <th>Phone</th>
                        <th>Account Status</th>
                        <th>System Role</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large tooltipped btn modal-trigger" data-position="left" data-tooltip="Add New Employee" href="{{url('employee-create')}}">
                <i class="large material-icons">add</i>
            </a>

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
                    $('#users-table').DataTable({
                        processing: true,
                        serverSide: true,
                        paging: true,
                        responsive: true,
                        scrollX: 640,
                        ajax: '{{route('get-users')}}',
                        columns: [
                            {data: 'name', name: 'name'},
                            {data: 'surname', name: 'surname'},
                            {data: 'email', name: 'email'},
                            {data: 'employee_code', name: 'employee_code'},
                            {data: 'contact_number', name: 'contact_number'},
                            {data: 'account_status', name: 'account_status'},
                            {data:'roles[0].display_name',name:'roles[0].display_name'},
                            {data: 'action', name: 'action', orderable: false, searchable: false}
                        ]
                    });
                    $('select[name="users-table_length"]').css("display","inline");
                });

            });
            $('#save-user').on('click',function(){
                let formData = new FormData();
                formData.append('name', $('#name').val());
                formData.append('surname', $('#surname').val());
                formData.append('email', $('#email').val());
                formData.append('contact_number', $('#contact_number').val());
                formData.append('contact_number_two', $('#contact_number_two').val());
                formData.append('role_id', $('#role_id').val());
                formData.append('dob', $('#dob').val());
                formData.append('account_status', $('#account_status').val());

                console.log("user ", formData);

                $.ajax({
                    url: "{{ route('users.store') }}",
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
                        $("#modal1").close();
                    }
                });
            });
        </script>
    @endpush
@endsection
