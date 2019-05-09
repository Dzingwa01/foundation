<?php

namespace App\Http\Controllers;

use App\FuneralPlan;
use App\Policy;
use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class FuneralPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('funeral-plans.index');
    }

    public function getFuneralPlans(){
        $funeral_plans = FuneralPlan::all();

        return Datatables::of($funeral_plans)->addColumn('action', function ($funeral_plan) {
            $re = '/funeral-plan/edit/' . $funeral_plan->id;
            $sh = '/funeral-plan/show/' . $funeral_plan->id;
            $del = $funeral_plan->id;
            return '<a href=' . $sh . ' title="Edit Funeral Plan" style="color:green"><i class="material-icons">remove_red_eye</i></a><a href=' . $re . ' title="Edit Funeral Plan" style="color:blue"><i class="material-icons">edit</i></a><a id=' . $del . ' onclick="confirm_delete(this)" title="Delete Funeral Plan" style="color:red"><i class="material-icons">delete_forever</i></a>';
        })
            ->make(true);
    }

    public function getFuneralPlansForPolicies(){
        $funeral_plans = FuneralPlan::all();

        return Datatables::of($funeral_plans)->addColumn('action', function ($funeral_plan) {
            $del = $funeral_plan->id;
            return '<input id='.$del.' name="group1" value='.$del.' class="check" type="radio" />';
        })
            ->make(true);
    }

    public function getFuneralPlansForPoliciesEdit(Policy $policy){
        $funeral_plans = FuneralPlan::all();
        $policy_plan = $policy->funeral_plan;

        return Datatables::of($funeral_plans)->addColumn('action', function ($funeral_plan) use($policy_plan) {
            $del = $funeral_plan->id;
            if(isset($policy_plan)&&$funeral_plan->id==$policy_plan->id){
                return '<input id='.$del.' value='.$del.' class="check" name="group1" type="radio" checked />';
            }else{
                return '<input id='.$del.' value='.$del.' class="check" name="group1" type="radio"  />';
            }

        })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('funeral-plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->input();
        DB::beginTransaction();
        try{
            $funeral_plan = FuneralPlan::create($input);
            DB::commit();

            return response()->json(['message'=>'Funeral Plan created successfully','funeral_plan'=>$funeral_plan],200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'An error occurred while saving funeral plan '.$e->getMessage(),'funeral_plan'=>null],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FuneralPlan  $funeral_plan
     * @return \Illuminate\Http\Response
     */
    public function show(FuneralPlan $funeral_plan)
    {
        //
        return view('funeral-plans.view',compact('funeral_plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FuneralPlan  $funeral_plan
     * @return \Illuminate\Http\Response
     */
    public function edit(FuneralPlan $funeral_plan)
    {
        //
        return view('funeral-plans.edit',compact('funeral_plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FuneralPlan  $funeral_plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FuneralPlan $funeral_plan)
    {
        //
        DB::beginTransaction();
        try{
            $funeral_plan->update($request->input());
            DB::commit();
            return response()->json(['message'=>'Funeral Plan updated successfully'],200);

        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'An error occurred while updating the plan, please contact your adminstrator '.$e->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FuneralPlan  $funeral_plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(FuneralPlan $funeral_plan)
    {
        //
        DB::beginTransaction();
        try{
            $funeral_plan->delete();
            DB::commit();
            return response()->json(['message'=>'Funeral Plan deleted successfully'],200);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'An error occurred while deleting the funeral plan '.$e->getMessage()],500);
        }
    }
}
