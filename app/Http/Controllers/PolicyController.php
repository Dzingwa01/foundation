<?php

namespace App\Http\Controllers;

use App\Policy;
use App\User;
use Carbon\Carbon;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('policies.index');
    }

    public function getPolicies(){

        $policies = Policy::with('client','funeral_plan','agent')->get();

        return Datatables::of($policies)
            ->addColumn('agent_fullname',function ($policy){
                if(isset($policy->agent)){
                    return $policy->agent->name.' '.$policy->agent->surname;
                }else{
                    return '';
                }
            })
            ->addColumn('policy_start_date',function ($policy){
                return Carbon::parse($policy->start_date)->format('m/d/Y');
            })
            ->addColumn('policy_created_date',function ($policy){
                return Carbon::parse($policy->created_at)->format('m/d/Y');
            })
            ->addColumn('funeral_plan',function ($policy){
                if(isset($policy->funeral_plan)){
                    return $policy->funeral_plan->plan_name;
                }else{
                    return '';
                }
            })
            ->addColumn('action', function ($policy) {
            $re = '/policy/show/' . $policy->id;
            $sh = '/policy/edit/' . $policy->id;
            $del = $policy->id;
            return '<a href=' . $re . ' title="View Policy" style="color:green;"><i class="material-icons">remove_red_eye</i></a><a href=' . $sh . ' title="Edit Policy" style="color:blue"><i class="material-icons">create</i></a><a id=' . $del . ' onclick="confirm_delete(this)" title="Delete Policy" style="color:red"><i class="material-icons">delete_forever</i></a>';
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
        $current_year = Carbon::now()->year;
        $start_date = (new Carbon('first day of January ' . $current_year));
        $policy_count = count(Policy::where('created_at','>=',$start_date)->get());
        if($policy_count == 0){
            $policy_count = 01;
        }else if($policy_count<10){
            $policy_count = '0'.$policy_count+1;
        }
        $current_user = Auth::user();
        $agent = User::find($current_user->id);

        $policy_number = $policy_count.'/'.$current_year;
        return view('policies.create',compact('policy_number','agent'));
    }

    public function funeralPlanDetails(Policy $policy){
        return view('policies.funeral-plan',compact('policy'));
    }

    public function bankindDetails(Policy $policy){
        return view('policies.banking-details',compact('policy'));
    }

    public function nomineeEdit(Policy $policy){
        $nominee = $policy->nominee;
        return view('policies.edit.nominee-details-edit',compact('nominee','policy'));
    }

    public function funeralCoverEdit(Policy $policy){
        $funeral_plan = $policy->funeral_plan;
        return view('policies.edit.funeral-plan-edit',compact('policy','funeral_plan'));
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
        $input = $request->all();
        $current_year = Carbon::now()->year;
        $start_date = (new Carbon('first day of January ' . $current_year));
        $policy_count = count(Policy::where('created_at','>=',$start_date)->get());
        if($policy_count == 0){
            $policy_count = 01;
        }else if($policy_count<10){
            $policy_count = '0'.$policy_count+1;
        }

        $policy_number = $policy_count.'/'.$current_year;

        DB::beginTransaction();
        try{
            $client = \App\Client::create($input);
            $policy = Policy::create(['pay_slip_seen'=>$input['pay_slip_seen'],'policy_number'=>$policy_number,'client_id'=>$client->id,'agent_id'=>Auth::user()->id,'start_date'=>$input['start_date']]);
            DB::commit();
            return response()->json(['message'=>'Proposer Details Saved Successfully','client'=>$client,'policy'=>$policy],200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'An error occurred while saving proposer details '.$e->getMessage()],500);
        }
    }

    public function savePolicyPlan(Request $request, Policy $policy){
        DB::beginTransaction();
        try{
            $policy->funeral_plan_id = $request->input(['funeral_plan_id']);
            $policy->save();
            DB::commit();
            return response()->json(['message'=>'Policy funeral plan saved successfully','policy'=>$policy],200);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'Policy funeral plan could not be saved .'.$e->getMessage()],500);
        }
    }

    public function nomineeDetails(Policy $policy){
        $policy->load('nominee');

        return view('policies.nominee-details',compact('policy'));
    }

    public function dependantsDetails(Policy $policy){
        $funeral_plan = $policy->funeral_plan;
//        dd($funeral_plan);
        return view('policies.dependants-details',compact('policy','funeral_plan'));
    }

    public function policyCreateBack(Policy $policy){
        return view('policies.create',compact('policy'));
    }

    public function savePolicyChildren(Request $request,Policy $policy){
        DB::beginTransaction();
        try{
            $children = json_decode($request->input(['children']));
            foreach ($children as $child){

            }
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'An error occurred while saving the children for the policy '.$e->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function show(Policy $policy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function edit(Policy $policy)
    {
        //
        return view('policies.edit.edit',compact('policy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Policy $policy)
    {
        //
        DB::beginTransaction();
        try{
            $policy->update($request->all());
            DB::commit();
            return response()->json(['message'=>'Proposer Details Saved Successfully','policy'=>$policy],200);

        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'An error occurred while saving Proposer Details'],500);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Policy $policy)
    {
        //
        DB::beginTransaction();
        try{
            $policy->delete();
            DB::commit();
            return response()->json(['message'=>'Policy deleted successfully'],200);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'An error occurred while deleting the Policy '.$e->getMessage()],500);
        }
    }
}
