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

                </div>


                <div class="row">
                    <div class="input-field col m6">
                        <input required id="bank_name" type="text" class="validate" value="">
                        <label for="bank_name">Bank Name</label>
                    </div>
                    <div class="input-field col m6">
                        <input required name="bank_branch" id="bank_branch" type="text" class="validate">
                        <label for="surname">Branch</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m6">
                        <input required id="bank_account_number" type="text" class="validate" value="">
                        <label for="bank_account_number">Bank Account Number</label>
                    </div>
                    <div class="input-field col m6">
                        <input required name="bank_account_name" id="bank_account_name" type="text" class="validate">
                        <label for="surname">Account Name</label>
                    </div>
                </div>

                <div class="row">

                    <div class="input-field col m6">
                        <input name="branch_code"  required id="branch_code" type="text" class="validate">
                        <label for="branch_code">Contact Number</label>
                    </div>
                </div>


                <div class="row">
                    <div class="col offset-m4">
                        <a href="{{url('dependants-details/'.$policy->id)}}" class=" waves-effect waves-green btn">Back<i
                                    class="material-icons right">arrow_back</i> </a>

                        <button class="btn waves-effect waves-light" style="margin-left:2em;" id="save-user"
                                name="action">Save
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
                    currentStep: 5
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