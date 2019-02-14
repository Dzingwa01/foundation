@extends('layouts.admin-layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h6 style="text-transform:uppercase;text-align: center;font-weight: bolder;margin-top:2em;">Foundation Mutual - Branches</h6>
        </div>
        <div class="row" style="margin-left: 2em;margin-right: 2em;">
            <div class="col s12" style="margin-bottom: 5em!important;">
                <table class="table table-bordered" style="width: 100%!important;" id="branches-table">
                    <thead>
                    <tr>
                        <th>Branch Name</th>
                        <th>Branch Code</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Contact Number</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large tooltipped btn modal-trigger" data-position="left" data-tooltip="Add New Branch" href="#modal1">
                <i class="large material-icons">add</i>
            </a>

        </div>
        <div id="modal1" class="modal modal-fixed-footer">
            <div class="modal-content">
                <h5 style="font-weight: bolder;text-align: center">Add New Branch</h5>
                <div class="row">
                    <form id="branch-form" class="col s12">
                        @csrf
                        <div class="row">
                            <div class="input-field col m6">
                                <input id="branch_name" type="text" required class="validate">
                                <label for="branch_name">Branch Name</label>
                            </div>
                            <div class="input-field col m6">
                                <input id="branch_code" required type="text" required class="validate">
                                <label for="branch_code">Branch Code</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m6">
                                <textarea id="branch_address" required class="materialize-textarea"></textarea>
                                <label for="branch_address">Address</label>
                            </div>
                            <div class="input-field col m6">
                                <input id="branch_city" type="text" required class="validate">
                                <label for="branch_city">City</label>
                            </div>

                        </div>
                        <div class="row">
                            <div class="input-field col m6">
                                <input id="branch_contact_number" required type="tel" class="validate">
                                <label for="branch_contact_number">Contact Number</label>
                            </div>
                            <div class="input-field col m6">
                                <input id="branch_contact_number_two" required type="tel" class="validate">
                                <label for="branch_contact_number_two">Contact Number 2</label>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn">Cancel<i class="material-icons right">close</i> </a>
                <button class="btn waves-effect waves-light" style="margin-left:2em;" id="save-branch" name="action">Save
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
                    $('#branches-table').DataTable({
                        processing: true,
                        serverSide: true,
                        paging: true,
                        responsive: true,
                        scrollX: 640,
                        ajax: '{{route('get-branches')}}',
                        columns: [
                            {data: 'branch_name', name: 'branch_name'},
                            {data: 'branch_code', name: 'branch_code'},
                            {data: 'branch_address', name: 'branch_address'},
                            {data: 'branch_city', name: 'branch_city'},
                            {data: 'branch_contact_number', name: 'branch_contact_number'},//
                            {data: 'action', name: 'action', orderable: false, searchable: false}
                        ]
                    });
                    $('select[name="branches-table_length"]').css("display","inline");
                });

            });
            $('#save-branch').on('click',function(e){
                // e.preventDefault();
                let formData = new FormData();
                formData.append('branch_code', $('#branch_code').val());
                formData.append('branch_name', $('#branch_name').val());
                formData.append('branch_address', $('#branch_address').val());
                formData.append('branch_city', $('#branch_city').val());
                formData.append('branch_contact_number', $('#branch_contact_number').val());
                formData.append('branch_contact_number_two', $('#branch_contact_number_two').val());

                $.ajax({
                    url: "{{ route('branches.store') }}",
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
