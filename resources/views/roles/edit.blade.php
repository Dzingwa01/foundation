@extends('layouts.admin-layout')

@section('content')
    <div class="container">

        <h5 style="font-weight: bolder;text-align: center">Update Role</h5>
        <div class="row card hoverable">
            <form id="role-form" class="col s12">
                @csrf
                <div class="row">
                    <div class="input-field col m6">
                        <input id="name" type="text" value="{{$role->name}}" required class="validate">
                        <label for="name">Role Name</label>
                    </div>
                    <div class="input-field col m6">
                        <input id="display_name" value="{{$role->display_name}}" type="text" required class="validate">
                        <label for="display_name">Display Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m6">
                        <input id="guard_name" value="{{$role->guard_name}}" required type="text" class="validate">
                        <label for="guard_name">Guard Name</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col offset-m4">
                        <a href="{{url('roles')}}" class="waves-effect waves-green btn">Cancel<i class="material-icons right">close</i> </a>
                        <button class="btn waves-effect waves-light" style="margin-left:2em;" id="update-role" name="action">Update
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

                $('#role-form').on('submit',function(e){
                    e.preventDefault();
                    let formData = new FormData();
                    formData.append('name', $('#name').val());
                    formData.append('display_name', $('#display_name').val());
                    formData.append('guard_name', $('#guard_name').val());

                    let role = {!! $role !!};
                    $.ajax({
                        url: "/role/update/"+role.id,
                        processData: false,
                        contentType: false,
                        data: formData,
                        type: 'post',

                        success: function (response, a, b) {
                            console.log("success",response);
                            alert(response.message);
                            window.location.href = '/roles';
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