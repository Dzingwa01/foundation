@extends('layouts.admin-layout')

@section('content')
    <div class="container">

        <div class="row">
            <h5 style="font-weight: bolder;text-align: center">Edit Employee</h5>
            <form id="update-employee-form" class="col s12 card hoverable">
                @csrf
                <div class="row">
                    <div class="input-field col m5 s11">
                        <label for="">Branch</label><br/><br/>
                        <select  required id="branch_id" style="length:250px!important;">
                            @foreach($branches as $branch)
                                <option value="{{$branch->id}}" {{$user->branch->branch_name==$branch->branch_name?'selected':''}}>{{$branch->branch_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m6">
                        <input required id="name" value="{{$user->name}}" type="text" class="validate">
                        <label for="name">Name</label>
                    </div>
                    <div class="input-field col m6">
                        <input required id="surname" type="text" value="{{$user->surname}}" class="validate">
                        <label for="surname">Surname</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m6">
                        <input required id="email" type="email" value="{{$user->email}}" class="validate">
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field col m6">
                        <input required id="contact_number" value="{{$user->contact_number}}" type="tel" class="validate">
                        <label for="contact_number">Contact Number</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m6">
                        <input required id="dob" value="{{$user->dob}}" type="date" class="validate">
                        <label for="dob">Date Of Birth</label>
                    </div>
                    <div class="input-field col m6">
                        <input  id="contact_number_two" value="{{$user->contact_number_two}}" type="tel" class="validate">
                        <label for="contact_number_two">Secondary Contact</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m5 s11">
                        <label for="role_id">Job Title</label><br/><br/>
                        <select required required id="role_id" style="length:250px!important;">
                            @foreach($roles as $role)
                                <option value="{{$role->id}}" {{$role->id==$user->roles[0]->id?'selected':''}}>{{$role->display_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-field col offset-m1 m5 s11 ">
                        <label for="role_id">Account Status</label><br/><br/>
                        <select required id="account_status" style="length:250px!important;">
                            <option value="active" {{$user->account_status=='active'?'selected':''}}>Active</option>
                            <option value="disabled" {{$user->account_status=='disabled'?'selected':''}}>Disabled</option>
                        </select>

                    </div>
                </div>
                <div class="row">
                    <div class="col offset-m4">
                        <a href="{{url('users')}}" class=" waves-effect waves-green btn">Cancel<i
                                    class="material-icons right">close</i> </a>
                        <button class="btn waves-effect waves-light" style="margin-left:2em;" id="update-employee"
                                name="action">Update
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

                $('#update-employee-form').on('submit', function (e) {
                    e.preventDefault();
                    if($('#role_id').val()=='select-title'){
                        alert('Please select the employee job title');
                    }else{
                        let formData = new FormData();
                        formData.append('name', $('#name').val());
                        formData.append('surname', $('#surname').val());
                        formData.append('email', $('#email').val());
                        formData.append('contact_number', $('#contact_number').val());
                        formData.append('contact_number_two', $('#contact_number_two').val());
                        formData.append('role_id', $('#role_id').val());
                        formData.append('branch_id', $('#branch_id').val());

                        formData.append('dob', $('#dob').val());
                        formData.append('account_status', $('#account_status').val());
                        console.log("user ", formData);
                        let user = {!! $user !!};

                        $.ajax({
                            url: "/user/update/"+user.id,
                            processData: false,
                            contentType: false,
                            data: formData,
                            type: 'post',

                            success: function (response, a, b) {
                                console.log("success", response);
                                alert(response.message);
                                window.location.href = '/users';
                            },
                            error: function (response) {
                                console.log("error", response);
                                let message = response.responseJSON.message;
                                console.log("error", message);
                                let errors = response.responseJSON.errors;

                                for (var error in   errors) {
                                    console.log("error", error)
                                    if (errors.hasOwnProperty(error)) {
                                        message += errors[error] + "\n";
                                    }
                                }
                                alert(message);

                            }
                        });
                    }

                });
            });

        </script>
    @endpush
@endsection