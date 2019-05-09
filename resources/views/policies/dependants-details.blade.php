@extends('layouts.admin-layout')

@section('content')
    <div class="" style="padding:2em;">
        <h5 style="font-weight: bolder;text-align: center;font-weight: bolder;">Nominee Details</h5>
        <div class="row">
            <a href="{{url('policies')}}" class="col offset-m11 btn float-right"><i class="material-icons">arrow_back</i> Back</a>
        </div>
        <div class="step-container" style="width: 700px; margin: 0 auto"></div>
        <div class="row card hoverable">
            <input id="policy_number" value="{{$policy->id}}" hidden>
            <div class="row">
                <div class="input-field col m4 s12">
                    <input required id="policy_details" value="{{$policy->policy_number}}" disabled type="text" class="validate">
                    <label for="policy_details">Policy Number </label>
                </div>
            </div>
            <div id="children" class="row" {{!$funeral_plan->number_of_children>0?'hidden':''}}>
                <h5 style="text-align: center; text-transform: uppercase;font-weight: bolder;">Children</h5>
                <table class="responsive-table highlight">
                    <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Sex</th>
                        <th>Date Of Birth</th>
                        <th>Relationship</th>
                        <th>ID Number</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i=0;$i<$funeral_plan->number_of_children;$i++)
                        <tr><td><input id="{{'row'.$i.'_fullname'}}" placeholder="Full Name" type="text" /> </td><td><select name="gender" required id="{{'row'.$i.'_gender'}}">
                                    <option value="select-gender">*** Select Gender ***</option>
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                            </td><td><input id="{{'row'.$i.'_dob'}}" placeholder="Date Of Birth" type="date" /> </td><td><input id="{{'row'.$i.'_relationship'}}" type="text" placeholder="Relationship" /> </td><td><input id="{{'row'.$i.'_idnumber'}}" type="text" placeholder="ID Number"/> </td></tr>
                    @endfor
                    </tbody>
                </table>
            </div>
            <div id="dependants" class="row" {{!$funeral_plan->number_of_dependents>0?'hidden':''}}>

                <h5 style="text-align: center; text-transform: uppercase;font-weight: bolder;">Dependants</h5>
                <table id="dependants" class="responsive-table highlight">
                    <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Sex</th>
                        <th>Date Of Birth</th>
                        <th>Relationship</th>
                        <th>ID Number</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i=0;$i<$funeral_plan->number_of_dependents;$i++)
                        <tr class="rows"><td><input placeholder="Full Name" id="{{'dependant'.$i.'_fullname'}}" type="text" /> </td><td><select name="gender" required id="{{'dependant'.$i.'_gender'}}">
                                    {{--<option value="select-gender">*** Select Gender ***</option>--}}
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                            </td><td><input id="{{'dependant'.$i.'_dob'}}" placeholder="Date Of Birth" type="date" /> </td><td><input placeholder="Relationship" id="{{'dependant'.$i.'_relationship'}}" type="text" /> </td><td><input placeholder="ID Number" id="{{'dependant'.$i.'_idnumber'}}" type="text" /> </td></tr>
                    @endfor
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col offset-m4">
                    <a href="{{url('funeral-cover-details/'.$policy->id)}}" class=" waves-effect waves-green btn">Back<i
                                class="material-icons right">arrow_back</i> </a>
                    {{--<button id="save-dependants"  style="margin-left: 2em;" class=" waves-effect waves-green btn">Next<i--}}
                                {{--class="material-icons right">arrow_forward</i> </button>--}}
                    <a href="{{url('banking-details/'.$policy->id)}}" style="margin-left: 2em;" class=" waves-effect waves-green btn">Next<i
                    class="material-icons right">arrow_forward</i> </a>

                </div>
            </div>
        </div>
    </div>
    @push('custom-scripts')

        <script>
            $(document).ready(function () {
                $('.step-container').stepMaker({
                    steps: ['Proposer Details', 'Nominee Details', 'Funeral Cover Details', 'Dependants','Banking Details'],
                    currentStep: 4
                });
                sessionStorage.setItem('is_covered',1);
                // $('.datepicker').datepicker();
                $('select').formSelect();
                $('input:radio').click(function () {
                    var is_covered = $(this).val();
                    sessionStorage.setItem('is_covered',is_covered);
                });


                $('#save-dependants').on('click', function () {
                  let dependants = [];
                    let children = [];
                    $('#dependants .rows').each(function (i, row) {
                        let attributes = [];
                        var $row = $(row);
                            $input = $row.find('input');
                            {
                                $input.each(function(td,input_val){
                                    var input = $(input_val);

                                    if(td==0&&input.val().length==0&& i==0){
                                        alert("Please enter at least one dependent");
                                        return false;
                                    }else if(td==0&&input.val().length==0){
                                        return false;
                                    }
                                    else{
                                        let attr_value = input.val();
                                        attributes.push(attr_value);
                                    }
                                });
                                dependants.push(attributes);
                            }
                    });

                    saveDependantsInfo();

                    $('#children .rows').each(function (i, row) {
                        let attributes = [];
                        var $row = $(row);
                        $input = $row.find('input');
                        {
                            $input.each(function(td,input_val){
                                var input = $(input_val);

                                if(td==0&&input.val().length==0&& i==0){
                                    alert("Please enter at least one dependent");
                                    return false;
                                }else if(td==0&&input.val().length==0){
                                    return false;
                                }
                                else{
                                    let attr_value = input.val();
                                    attributes.push(attr_value);
                                }
                            });
                            children.push(attributes);
                        }
                    });
                    saveChildrenInfo(children);
                });
            });

             function saveDependantsInfo(dependants) {
                 if(dependants.length==0){
                     let formData = new FormData();
                     formData.append('dependants',JSON.stringify(dependants));
                     $.ajax({
                         url: "{{ url('save-policy-dependants/'.$policy->id)}}",
                         processData: false,
                         contentType: false,
                         data: formData,
                         type: 'post',
                         dataType: "json",

                         success: function (response, a, b) {
                             console.log("success", response);
                             alert(response.message);
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
            }

            function saveChildrenInfo(children) {
                 if(children.length>0){
                     let formData = new FormData();
                     formData.append('dependants',JSON.stringify(children));
                     $.ajax({
                         url: "{{ url('save-policy-children/'.$policy->id)}}",
                         processData: false,
                         contentType: false,
                         data: formData,
                         type: 'post',
                         dataType: "json",

                         success: function (response, a, b) {
                             console.log("success", response);
                             alert(response.message);
                             window.location.href = {{'banking-details/'.$policy->id}};

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

            }

        </script>
    @endpush
@endsection