@extends('layouts.admin-layout')

@section('content')
    <div class="container">

        <h5 style="font-weight: bolder;text-align: center">Update Branch</h5>
        <div class="row">
            <form id="branch-form" class="col s12 card hoverable">
                @csrf
                <div class="row">
                    <div class="input-field col m6 s12">
                        <input id="branch_name" type="text" value="{{$branch->branch_name}}" required class="validate">
                        <label for="branch_name">Branch Name</label>
                    </div>
                    <div class="input-field col m6 s12">
                        <textarea id="branch_address" required class="materialize-textarea">{{$branch->branch_address}} </textarea>
                        <label for="branch_address">Address</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m6 s12">
                        <input id="branch_city" type="text" value="{{$branch->branch_city}}" required class="validate">
                        <label for="branch_city">City</label>
                    </div>
                    <div class="input-field col m6 s12">
                        <input id="branch_contact_number" value="{{$branch->branch_contact_number}}" required type="tel" class="validate">
                        <label for="branch_contact_number">Contact Number</label>
                    </div>
                </div>
                <div class="row">

                    <div class="input-field col m6 s12">
                        <input id="branch_contact_number_two" value="{{$branch->branch_contact_number_two}}" required type="tel" class="validate">
                        <label for="branch_contact_number_two">Contact Number 2</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col offset-m4">
                        <a href="{{url('branches')}}" class="waves-effect waves-green btn">Cancel<i class="material-icons right">close</i> </a>
                        <button class="btn waves-effect waves-light" style="margin-left:2em;" id="save-branch" name="action">Update
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    @push('custom-scripts')

        <script>
            $(document).ready(function () {
                $('#role_id').select2();
                $('#account_status').select2();
                $('#branch_id').select2();

                $('#branch-form').on('submit',function(e){
                    e.preventDefault();
                    let formData = new FormData();
                    formData.append('branch_name', $('#branch_name').val());
                    formData.append('branch_address', $('#branch_address').val());
                    formData.append('branch_city', $('#branch_city').val());
                    formData.append('branch_contact_number', $('#branch_contact_number').val());
                    formData.append('branch_contact_number_two', $('#branch_contact_number_two').val());
                    let branch = {!! $branch !!}
                    $.ajax({
                        url: "/branch/update/"+branch.id,
                        processData: false,
                        contentType: false,
                        data: formData,
                        type: 'post',

                        success: function (response, a, b) {
                            console.log("success",response);
                            alert(response.message);
                            window.location.href = '/branches';
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
            });

        </script>
    @endpush
@endsection