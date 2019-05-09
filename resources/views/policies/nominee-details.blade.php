@extends('layouts.admin-layout')

@section('content')
    <div class="" style="padding:2em;">
        <h5 style="font-weight: bolder;text-align: center;font-weight: bolder;">Nominee Details</h5>
        <div class="row">
            <a href="{{url('policies')}}" class="col offset-m11 btn float-right"><i class="material-icons">arrow_back</i> Back</a>
        </div>
        <div class="step-container" style="width: 700px; margin: 0 auto"></div>
        <div class="row">

            <form id="save-nominee-details-form" class="col s12 card hoverable">
                @csrf
                <input id="policy_number" value="{{$policy->id}}" hidden>
                <div class="row">
                    <div class="input-field col m4 s12">
                    <input required id="policy_details" value="{{$policy->policy_number}}" disabled type="text" class="validate">
                        <label for="policy_details">Policy Number </label>
                    </div>
                    <div class="input-field col m4 s12">
                        <p>
                            <label>
                                <input class="with-gap" id="is_covered" name="is_covered" value="1" type="radio" {{$policy->is_covered?'checked':''}} />
                                <span>Covered</span>
                            </label>
                            <label>
                                <input id="not_covered" class="with-gap" name="not_covered" value="0" type="radio" {{!$policy->is_covered?'checked':''}}/>
                                <span>Not Covered</span>
                            </label>
                        </p>
                    </div>
                </div>

                <div class="row" style="margin-top: 2em;">
                    <div class="input-field col m6 s12">
                        <select  required id="title">
                            <option value="select-title">*** Select Title ***</option>
                            <option value="Mr" {{isset($policy->nominees)&&$policy->nominee->title=='Mr'?'selected':''}}>Mr</option>
                            <option value="Mrs"  {{isset($policy->nominees)&&$policy->nominee->title=='Mrs'?'selected':''}}>Mrs</option>
                            <option value="Ms"  {{isset($policy->nominees)&&$policy->nominee->title=='Ms'?'selected':''}}>Ms</option>
                        </select>
                    </div>

                    <div class="input-field col m6 s12">
                        <input required id="national_id_number" type="text" class="validate" value="{{isset($policy->nominees)?$policy->nominee->national_id_number:''}}">
                        <label for="national_id_number">National ID Number</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m6">
                        <input required id="name" type="text" class="validate" value="{{isset($policy->nominees)?$policy->nominee->name:''}}">
                        <label for="name">Name</label>
                    </div>
                    <div class="input-field col m6">
                        <input required name="surname" id="surname" type="text" class="validate" value="{{isset($policy->nominees)?$policy->nominee->surname:''}}">
                        <label for="surname">Surname</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m6">
                        <select name="gender" required id="gender">
                            <option value="select-gender">*** Select Gender ***</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>

                        </select>
                        <label for="gender">Gender</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col m6">
                        <input name="email" required id="email" type="email" class="validate" value="{{isset($policy->nominees)?$policy->nominee->email:''}}">
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field col m6">
                        <input name="contact_number"  required id="contact_number" type="tel" class="validate" value="{{isset($policy->nominees)?$policy->nominee->contact_number:''}}">
                        <label for="contact_number">Contact Number</label>
                    </div>
                </div>

                <div class="row">
                <div class="input-field col m6 s12" >
                    <input name="date_of_birth" id="date_of_birth" required type="date" class="validate" value="{{isset($policy->nominees)?$policy->nominee->date_of_birth:''}}">
                    <label for="date_of_birth">Date Of Birth</label>
                </div>
                <div class="input-field col m6 s12">
                    <input required name="relationship" id="relationship" type="text" class="validate" value="{{isset($policy->nominees)?$policy->nominee->relationship:''}}">
                    <label for="relationship">Relationship</label>
                </div>
                </div>


                <div class="row">
                    <div class="col offset-m4">
                        <a href="{{url('policies')}}" class=" waves-effect waves-green btn">Back<i
                                    class="material-icons right">arrow_back</i> </a>
                        <button class="btn waves-effect waves-light" style="margin-left:2em;" id="save-user"
                                name="action">Next
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
                $('.step-container').stepMaker({
                    steps: ['Proposer Details', 'Nominee Details', 'Funeral Cover Details', 'Dependants','Banking Details'],
                    currentStep: 2
                });
                sessionStorage.setItem('is_covered',1);
                // $('.datepicker').datepicker();
                $('select').formSelect();
                $('input:radio').click(function () {
                    var is_covered = $(this).val();
                    sessionStorage.setItem('is_covered',is_covered);
                });


                $('#save-nominee-details-form').on('submit', function (e) {
                    e.preventDefault();
                    if($('#title').val()=='select-title'){
                        alert('Please select the Client Title');
                    }else if($('#gender').val()=='select-gender'){
                        alert('Please select gender');
                    }
                    else{
                        let formData = new FormData();
                        formData.append('title', $('#title').val());
                        formData.append('name', $('#name').val());
                        formData.append('surname', $('#surname').val());
                        formData.append('email', $('#email').val());
                        formData.append('contact_number', $('#contact_number').val());
                        formData.append('gender', $('#gender').val());
                        formData.append('national_id_number',$('#national_id_number').val());
                        formData.append('date_of_birth', $('#date_of_birth').val());
                        formData.append('relationship', $('#relationship').val());
                        formData.append('is_covered', sessionStorage.getItem('is_covered'));

                        formData.append('policy_number', $('#policy_number').val());

                        $.ajax({
                            url: "{{ route('nominees.store') }}",
                            processData: false,
                            contentType: false,
                            data: formData,
                            type: 'post',
                            dataType: "json",

                            success: function (response, a, b) {
                                console.log("success", response);
                                alert(response.message);

                                window.location.href = '/funeral-cover-details/'+response.policy.id;
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