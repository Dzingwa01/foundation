@extends('layouts.admin-layout')

@section('content')
    <div class="container">
        <h5 style="font-weight: bolder;text-align: center">Funeral Plan Details - {{$funeral_plan->plan_name}}</h5>
        <div class="row">
            <a href="{{url('funeral-plans')}}" class="col offset-m11 btn float-right"><i class="material-icons">arrow_back</i> Back</a>
        </div>
        <div class="row">

            <form id="save-funeral-plan-form" class="col s12 card hoverable">
                @csrf
                <input id="plan-id"  value="{{$funeral_plan->id}}" hidden>
                <div class="row">
                    <div class="input-field col m6">
                        <input required id="plan_name" value="{{$funeral_plan->plan_name}}" type="text" class="validate">
                        <label for="plan_name">Funeral Plan Name</label>
                    </div>
                    <div class="input-field col m6">
                        <textarea required id="plan_description" class="materialize-textarea">{{$funeral_plan->plan_description}}</textarea>
                        <label for="plan_description">Description</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m6">
                        <input required id="number_of_dependents" step="0.01" type="number" value="{{$funeral_plan->number_of_dependents}}" class="validate">
                        <label for="number_of_dependents">Number of Dependants</label>
                    </div>
                    <div class="input-field col m6">
                        <input required id="premium" step="0.01" value="{{$funeral_plan->premium}}" type="number" class="validate">
                        <label for="premium">Premium</label>
                    </div>
                </div>


            </form>
        </div>
    </div>
    @push('custom-scripts')

        <script>


        </script>
    @endpush
@endsection