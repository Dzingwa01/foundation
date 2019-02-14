<?php

namespace App\Http\Controllers;
use App\Branch;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Role;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::orderBy('name','asc')->get();
        return view('users.index',compact('roles'));
    }

    public function getUserProfile(){
        $user = Auth::user()->load('roles');
        if($user->roles[0]->name=='app-admin'){
            return view('admin.profile',compact('user'));
        }else{
            return view('agent.profile',compact('user'));
        }
    }

    public function getUsers(){
        $users = User::with('roles')->where('id','!=',Auth::user()->id)->get();
        return Datatables::of($users)->addColumn('action', function ($user) {
            $re = '/user/edit/' . $user->id;
            $sh = '/user/block/' . $user->id;
            $del = '/user/delete/' . $user->id;
            return '<a href=' . $re . ' title="Edit User"><i class="material-icons">create</i></a><a href=' . $sh . ' title="Disable User" style="color:darkslategrey"><i class="material-icons">block</i></a><a href=' . $del . ' title="Delete" style="color:red"><i class="material-icons">delete_forever</i></a>';
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
        $roles = Role::orderBy('name','asc')->get();
        $branches = Branch::orderBy('branch_name','asc')->get();
        return view('users.create-employee',compact('roles','branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        //
        $input = $request->validated();
        DB::beginTransaction();
        $dobs = explode('-',$input['dob']);
        $year = substr($dobs[0],0,2);
        $employee_code = "FMS".$year.$dobs[1].$dobs[2].substr($input['name'],0,1).substr($input['surname'],0,1);
        try{
            $user = User::create(['branch_id'=>$input['branch_id'],'employee_code'=>$employee_code,'account_status'=>$input['account_status'],'dob'=>$input['dob'],'name'=>$input['name'],'surname'=>$input['surname'],'contact_number'=>$input['contact_number'],'contact_number_two'=>$input['contact_number_two'],'email'=>$input['email'],'password'=>Hash::make('secret')]);

            $user->roles()->attach($input['role_id']);
            $user = $user->load('roles');
//            $verification_url = url('account-completion/'.$user->id);
//            Mail::to($user)->send(new InviteUser($user,$verification_url));
            DB::commit();
            return response()->json(['user'=>$user,'message'=>'User created successfully and an email has been sent for account activation'],200);

        }catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'User could not be saved at the moment ' . $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        $user->load('branch','roles');
        $roles = Role::orderBy('name','asc')->get();
        $branches = Branch::orderBy('branch_name','asc')->get();

        return view('users.edit-employee',compact('user','roles','branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        //
        $input = $request->validated();
        DB::beginTransaction();

        try{
            $user->update(['branch_id'=>$input['branch_id'],'account_status'=>$input['account_status'],'dob'=>$input['dob'],'name'=>$input['name'],'surname'=>$input['surname'],'contact_number'=>$input['contact_number'],'contact_number_two'=>$input['contact_number_two']]);

            $user->roles()->sync($input['role_id']);
            $user = $user->load('roles');
//            $verification_url = url('account-completion/'.$user->id);
//            Mail::to($user)->send(new InviteUser($user,$verification_url));
            DB::commit();
            return response()->json(['user'=>$user,'message'=>'Employee updated successfully'],200);

        }catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Employee could not be updated at the moment ' . $e->getMessage()], 400);
        }
    }

    public function blockEmployee(User $user)
    {
        //

        DB::beginTransaction();

        try{
            $user->update(['account_status'=>'disabled']);
            DB::commit();
            return redirect('users');

        }catch (\Exception $e) {
            DB::rollback();
            return redirect('users');
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        DB::beginTransaction();
        try{
            $user->delete();
            DB::commit();
            return redirect('users');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect('users');
        }
    }
}
