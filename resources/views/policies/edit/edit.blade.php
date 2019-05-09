@extends('layouts.admin-layout')

@section('content')
    <div class="" style="padding:2em;">
        <h5 style="font-weight: bolder;text-align: center;font-weight: bolder;">Edit Client Policy</h5>
        <div class="row">
            <a href="{{url('policies')}}" class="col offset-m11 btn float-right"><i class="material-icons">arrow_back</i> Back</a>
        </div>
        <div class="step-container" style="width: 700px; margin: 0 auto"></div>
        <div class="row">

            <form id="save-proposer-details-form" class="col s12 card hoverable">
                @csrf
                <div class="row" style="margin-top: 2em;">
                    <div class="input-field col m4 s12">
                        <input required name="policy_number" disabled id="policy_number" type="text" value="{{$policy->policy_number}}" class="validate">
                        <label for="policy_number">Policy Number</label>
                    </div>
                    <div class="input-field col m4 s12" >
                        <input name="agent_id" id="agent_id" disabled required type="text" value="{{$policy->agent->name.' '.$policy->agent->surname}}" class="validate">
                        <label for="agent_id">Agent Full Name</label>
                    </div>
                    <div class="input-field col m4 s12">

                        <p>
                            <label>
                                <input class="with-gap" id="pay_slip_seen" name="pay_slip_seen" value="1" type="radio" {{$policy->pay_slip_seen?'checked':''}} />
                                <span>Pay Slip Seen</span>
                            </label>
                            <label>
                                <input id="pay_slip_not_seen" class="with-gap" name="pay_slip_seen" value="0" type="radio" {{!$policy->pay_slip_seen?'checked':''}}/>
                                <span>No Pay Slip</span>
                            </label>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m4 s12">
                        <select  required name="title" id="title">
                            <option value="Mr" {{isset($policy->nominees)&&$policy->client->title=='Mr'?'selected':''}}>Mr</option>
                            <option value="Mrs"  {{isset($policy->nominees)&&$policy->client->title=='Mrs'?'selected':''}}>Mrs</option>
                            <option value="Ms"  {{isset($policy->nominees)&&$policy->client->title=='Ms'?'selected':''}}>Ms</option>
                        </select>
                    </div>
                    <div class="input-field col m4 s12" >
                        <input name="date_of_birth" id="date_of_birth" required type="date" class="validate" value="{{$policy->client->date_of_birth}}">
                        <label for="date_of_birth">Date Of Birth</label>
                    </div>
                    <div class="input-field col m4 s12">
                        <input required name="national_id_number" id="national_id_number" type="text" class="validate" value="{{$policy->client->national_id_number}}">
                        <label for="national_id_number">National ID Number</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m6">
                        <input required id="name" name="name" type="text" class="validate" value="{{$policy->client->name}}">
                        <label for="name">Name</label>
                    </div>
                    <div class="input-field col m6">
                        <input name="middle_name" id="middle_name" type="text" class="validate" value="{{$policy->client->middle_name}}">
                        <label for="middle_name">Middle Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m6">
                        <input required name="surname" id="surname" type="text" class="validate" value="{{$policy->client->surname}}">
                        <label for="surname">Surname</label>
                    </div>

                    <div class="input-field col m6">
                        <input name="maiden_name" id="maiden_name" type="text" class="validate" value="{{$policy->client->maiden_name}}">
                        <label for="maiden_name">Maiden Name</label>
                    </div>

                </div>
                <div class="row">
                    <div class="input-field col m6">
                        <select name="gender" required id="gender">
                            <option value="select-gender">*** Select Gender ***</option>
                            <option value="Female" {{$policy->client->gender=="Female"?'selected':''}}>Female</option>
                            <option value="Male" {{$policy->client->gender=="Male"?'selected':''}}>Male</option>

                        </select>
                        <label for="gender">Gender</label>
                    </div>
                    <div class="input-field col m6">
                        <select name="marital_status" required id="marital_status">
                            <option value="select-marital-status">*** Select Marital Status ***</option>
                            <option value="Married" {{$policy->client->marital_status=="Married"?'selected':''}}>Married</option>
                            <option value="Single" {{$policy->client->marital_status=="Single"?'selected':''}}>Single</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col m6">
                        <input name="email" required id="email" type="email" class="validate" value="{{$policy->client->email}}">
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field col m6">
                        <input name="contact_number"  required id="contact_number" type="tel" class="validate" value="{{$policy->client->cell_number}}">
                        <label for="contact_number">Contact Number</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m6">
                        <textarea required id="residential_address" name="residential_address"  class="materialize-textarea">{{$policy->client->residential_address}}</textarea>
                        <label for="residential_address">Residential Address</label>
                    </div>

                    <div class="input-field col m6">
                        <textarea name="postal_address" id="postal_address" class="materialize-textarea">{{$policy->client->postal_address}}</textarea>
                        <label for="postal_address">Postal Address</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m6">
                        <input required id="name_of_company" name="name_of_company" type="text" class="validate" value="{{$policy->client->name_of_company}}">
                        <label for="name_of_company">Company Name</label>
                    </div>
                    <div class="input-field col m4 s12" >
                        <input name="start_date" id="start_date" required type="date" class="validate" value="{{$policy->start_date}}">
                        <label for="start_date">Policy Start Date</label>
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
                        <a href="{{url('nominee-details-edit/'.$policy->id)}}" style="margin-left:2em;" class=" waves-effect waves-green btn">Next<i
                                    class="material-icons right">arrow_forward</i> </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('custom-scripts')

        <script>
            $(document).ready(function () {
                $('.step-container').stepMaker({
                    steps: ['Proposer Details', 'Nominee Details', 'Funeral Cover Details', 'Dependants','Banking Details'],
                    currentStep: 1
                });
                sessionStorage.setItem('pay_slip_seen',1);
                // $('.datepicker').datepicker();
                $('select').formSelect();
                $('input:radio').click(function () {
                    var payslip_seen = $(this).val();
                    sessionStorage.setItem('pay_slip_seen',payslip_seen);
                });

                $('#save-proposer-details-form').on('submit', function (e) {
                    e.preventDefault();
                    if($('#title').val()=='select-title'){
                        alert('Please select the Client Title');
                    }else if($('#marital_status').val()=='select-marital-status'){
                        alert('Please select marital status');
                    }else if($('#gender').val()=='select-gender'){
                        alert('Please select gender');
                    }
                    else{
                        let formData = new FormData();
                        formData.append('policy_number', $('#policy_number').val());
                        formData.append('pay_slip_seen',sessionStorage.getItem('pay_slip_seen'));
                        formData.append('title', $('#title').val());
                        formData.append('name', $('#name').val());
                        formData.append('surname', $('#surname').val());
                        formData.append('email', $('#email').val());
                        formData.append('cell_number', $('#contact_number').val());
                        formData.append('middle_name', $('#middle_name').val());
                        formData.append('gender', $('#gender').val());
                        formData.append('marital_status', $('#marital_status').val());
                        formData.append('date_of_birth', $('#date_of_birth').val());
                        formData.append('maiden_name', $('#maiden_name').val());
                        formData.append('start_date', $('#start_date').val());
                        formData.append('national_id_number',$('#national_id_number').val());

                        formData.append('postal_address', $('#postal_address').val());
                        formData.append('residential_address', $('#residential_address').val());
                        formData.append('name_of_company', $('#name_of_company').val());

                        $.ajax({
                            url: "{{ url('clients/update/'.$policy->client->id)}}",
                            processData: false,
                            contentType: false,
                            data: formData,
                            type: 'post',
                            dataType: "json",

                            success: function (response, a, b) {
                                console.log("success", response);
                                alert(response.message);
                                // window.location.href = '/nominee-details/'+response.policy.id;
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