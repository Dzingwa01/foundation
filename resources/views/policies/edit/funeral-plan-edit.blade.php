@extends('layouts.admin-layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h6 style="text-transform:uppercase;text-align: center;font-weight: bolder;margin-top:2em;">Funeral Details Edit</h6>
            {{--<a class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>--}}
        </div>
        <div class="step-container" style="width: 700px; margin: 0 auto"></div>
        <div class="row" style="margin-left: 2em;margin-right: 2em;">
            <div class="col s12" style="margin-bottom: 5em!important;">
                <table class="table table-bordered" style="width: 100%!important;" id="funeral-plan-table">
                    <thead>
                    <tr>
                        <th>Select</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Premium</th>
                        <th>Dependants</th>

                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col offset-m4">
                <a href="{{url('policies')}}" class=" waves-effect waves-green btn">Cancel<i
                            class="material-icons right">close</i> </a>
                <button class="btn waves-effect waves-light" style="margin-left:2em;" id="save-user"
                        name="action">Update
                    <i class="material-icons right">send</i>
                </button>
                <a href="{{url('dependants-details/'.$policy->id)}}" style="margin-left:2em;" class=" waves-effect waves-green btn">Next<i
                            class="material-icons right">arrow_forward</i> </a>
            </div>
        </div>


        <style>
            th{
                text-transform: uppercase!important;
            }

            .check {
                opacity: 1 !important;
                pointer-events: auto !important;
            }
        </style>
    </div>
    @push('custom-scripts')

        <script>
            $(document).ready(function () {
                $('select').formSelect();
                $('.step-container').stepMaker({
                    steps: ['Proposer Details', 'Nominee Details', 'Funeral Cover Details', 'Dependants','Banking Details'],
                    currentStep: 3
                });
                $(function () {
                    $('#funeral-plan-table').DataTable({
                        processing: true,
                        serverSide: true,
                        paging: true,
                        responsive: true,
                        scrollX: 640,
                        ajax: '{{url('get-funeral-plans-policies-edit/'.$policy->id)}}',
                        columns: [
                            {data: 'action', name: 'action', searchable: false},
                            {data: 'plan_name', name: 'plan_name'},
                            {data: 'plan_description', name: 'plan_description'},
                            {data: 'premium', name: 'premium'},
                            {data: 'number_of_dependents', name: 'number_of_dependents'},
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
