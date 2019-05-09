@extends('layouts.admin-layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h6 style="text-transform:uppercase;text-align: center;font-weight: bolder;margin-top:2em;">Foundation Mutual - Funeral Plans</h6>
            {{--<a class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>--}}
        </div>
        <div class="row" style="margin-left: 2em;margin-right: 2em;">
            <div class="col s12" style="margin-bottom: 5em!important;">
                <table class="table table-bordered" style="width: 100%!important;" id="funeral-plan-table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Premium</th>
                        <th>Policy Holder Covered</th>
                        <th>Spouse Covered</th>
                        <th>Children</th>
                        <th>Dependants</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large tooltipped btn modal-trigger" data-position="left" data-tooltip="Add New Funeral Plan" href="{{url('funeral-plan-create')}}">
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
                    $('#funeral-plan-table').DataTable({
                        processing: true,
                        serverSide: true,
                        paging: true,
                        responsive: true,
                        scrollX: 640,
                        ajax: '{{route('get-funeral-plans')}}',
                        columns: [
                            {data: 'plan_name', name: 'plan_name'},
                            {data: 'plan_description', name: 'plan_description'},
                            {data: 'premium', name: 'premium'},
                            {data: 'policy_holder_covered', name: 'policy_holder_covered'},
                            {data: 'spouse_covered', name: 'spouse_covered'},
                            {data: 'number_of_children', name: 'number_of_children'},
                            {data: 'number_of_dependents', name: 'number_of_dependents'},
                            {data: 'action', name: 'action', orderable: false, searchable: false}
                        ]
                    });
                    $('select[name="funeral-plan-table_length"]').css("display","inline");
                });

            });
            function confirm_delete(obj){
                var r = confirm("Are you sure want to delete this funeral plan!");
                if (r == true) {
                    $.get('/funeral-plan/delete/'+obj.id,function(data,status){
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
