@extends('layouts.admin-layout')

@section('content')
    <div class="container">
        <h5 style="font-weight: bolder;text-align: center">Edit Funeral Plan</h5>
        <div class="row">
            <a href="{{url('funeral-plans')}}" class="col offset-m11 btn float-right"><i class="material-icons">arrow_back</i> Back</a>
        </div>
        <div class="row">

            <form id="save-funeral-plan-form" class="col s12 card hoverable">
                @csrf
                <input id="plan-id" value="{{$funeral_plan->id}}" hidden>
                <div class="row">
                    <div class="input-field col m6">
                        <input required id="plan_name" value="{{$funeral_plan->plan_name}}" type="text"
                               class="validate">
                        <label for="plan_name">Funeral Plan Name</label>
                    </div>
                    <div class="input-field col m6">
                        <textarea required id="plan_description"
                                  class="materialize-textarea">{{$funeral_plan->plan_description}}</textarea>
                        <label for="plan_description">Description</label>
                    </div>
                </div>
                <div class="row">
                    <p>
                        <label>
                            <input class="policy_holder_covered" name="group1" value="1" type="radio" {{$funeral_plan->policy_holder_covered?'checked':''}} />
                            <span>Covers Policy Holder</span>
                        </label>

                        <label>
                            <input class="policy_holder_covered" name="group1" value="0" type="radio" {{!$funeral_plan->policy_holder_covered?'checked':''}} />
                            <span>Does Not Cover Policy Holder</span>
                        </label>

                        <label>
                            <input class="spouse_covered" name="group2" value="1" type="radio" {{$funeral_plan->spouse_covered?'checked':''}} />
                            <span>Spouse Covered</span>
                        </label>

                        <label>
                            <input class="spouse_covered" name="group2" value="0" {{!$funeral_plan->spouse_covered?'checked':''}} type="radio" />
                            <span>Spouse Not Covered</span>
                        </label>
                    </p>
                </div>
                <div class="row">
                    <div class="input-field col m6">
                        <input required id="number_of_dependents" step="0.01" type="number"
                               value="{{$funeral_plan->number_of_dependents}}" class="validate">
                        <label for="number_of_dependents">Number of Dependants</label>

                    </div>
                    <div class="input-field col m6">
                        <input required id="number_of_children" step="0.01" type="number" value="{{$funeral_plan->number_of_children}}" class="validate">
                        <label for="number_of_children">Number of Children</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m6">
                        <input required id="premium" step="0.01" value="{{$funeral_plan->premium}}" type="number"
                               class="validate">
                        <label for="premium">Premium</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col offset-m4">
                        <a href="{{url('funeral-plans')}}" class=" waves-effect waves-green btn">Cancel<i
                                    class="material-icons right">close</i> </a>
                        <button class="btn waves-effect waves-light" style="margin-left:2em;" id="save-funeral-plan"
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


                $('.policy_holder_covered').click(function () {
                    let cover = $(this).val();
                    sessionStorage.setItem('policy_holder_covered',cover);
                });

                $('.spouse_covered').click(function () {
                    let cover_spouse = $(this).val();
                    sessionStorage.setItem('spouse_covered',cover_spouse);
                });

                $('#save-funeral-plan-form').on('submit', function (e) {
                    e.preventDefault();
                    let formData = new FormData();
                    formData.append('plan_name', $('#plan_name').val());
                    formData.append('plan_description', $('#plan_description').val());
                    formData.append('premium', $('#premium').val());
                    formData.append('number_of_dependents', $('#number_of_dependents').val());

                    formData.append('number_of_children', $('#number_of_children').val());
                    formData.append('spouse_covered', sessionStorage.getItem('spouse_covered'));
                    formData.append('policy_holder_covered', sessionStorage.getItem('policy_holder_covered'));

                    let funeral_plan_id = $('#plan-id').val();
                    let url = '/funeral-plan-update/' + funeral_plan_id;

                    $.ajax({
                        url: url,
                        processData: false,
                        contentType: false,
                        data: formData,
                        type: 'post',

                        success: function (response, a, b) {
                            console.log("success", response);
                            alert(response.message);
                            window.location.href = '/funeral-plans';
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


                });
            });

        </script>
    @endpush
@endsection