@extends('layouts.admin-layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h6 style="text-transform:uppercase;text-align: center;font-weight: bolder;margin-top:2em;">Foundation Mutual Client Policies</h6>
            {{--<a class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>--}}
        </div>
        <div class="row" style="margin-left: 2em;margin-right: 2em;">
            <div class="col s12" style="margin-bottom: 5em!important;">
                <table class="table table-bordered" style="width: 100%!important;" id="policies-table">
                    <thead>
                    <tr>
                        <th>Policy Number</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Date of Birth</th>
                        <th>Start Date</th>
                        <th>Created At</th>
                        <th>Agent</th>
                        <th>Plan</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large tooltipped btn modal-trigger" data-position="left" data-tooltip="Add New Policy" href="{{url('policy-create')}}">
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
                    $('#policies-table').DataTable({
                        processing: true,
                        serverSide: true,
                        paging: true,
                        responsive: true,
                        scrollX: 640,
                        ajax: '{{route('get-policies')}}',
                        columns: [
                            {data: 'policy_number', name: 'policy_number'},
                            {data: 'client.name', name: 'client.name'},
                            {data: 'client.surname', name: 'client.surname'},
                            {data: 'client.date_of_birth', name: 'client.date_of_birth'},
                            {data:'policy_start_date',name:'policy_start_date'},
                            {data:'created_at',name:'created_at'},
                            {data: 'agent_fullname', name: 'agent_fullname'},
                            {data: 'funeral_plan', name: 'funeral_plan'},
                            {data: 'action', name: 'action', orderable: false, searchable: false}
                        ]
                    });
                    $('select[name="policies-table_length"]').css("display","inline");
                });

            });
            function confirm_delete(obj){
                var r = confirm("Are you sure want to delete this policy!");
                if (r == true) {
                    $.get('/policy/delete/'+obj.id,function(data,status){
                        console.log('Data',data);
                        console.log('Status',status);
                        if(status=='success'){
                            alert(data.message);
                            window.location.reload();
                        }

                    });
                } else {
                    alert('Delete action cancelled');
                }
            }

        </script>
    @endpush
@endsection
