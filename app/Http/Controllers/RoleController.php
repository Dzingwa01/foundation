<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleStoreRequest;
use App\Role;
use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('roles.index');
    }

    public function getRoles(){
        $roles = Role::orderBy('display_name','asc')->get();

        return Datatables::of($roles)->addColumn('action', function ($role) {
            $re = '/role/edit/' . $role->id;
            $del = '/role/delete/' . $role->id;
            return '<a href=' . $re . ' title="Edit Role" style="color:green;"><i class="material-icons">create</i></a><a href=' . $del . ' title="Delete Role" style="color:red"><i class="material-icons">delete_forever</i></a>';
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        //
        $input = $request->validated();
        DB::beginTransaction();
        try{
            $role = Role::create(['name'=>$input['name'],'display_name'=>$input['display_name'],'guard_name'=>$input['guard_name'],'permissions'=>[]]);
            DB::commit();
            return response()->json(['message'=>'Role saved successfully','role'=>$role],200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'An error occurred while saving the role, '.$e->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
        return view('roles.edit',compact('role'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleStoreRequest $request, Role $role)
    {
        //
        $input = $request->validated();
        DB::beginTransaction();
        try{
            $role->update(['name'=>$input['name'],'display_name'=>$input['display_name'],'guard_name'=>$input['guard_name'],'permissions'=>[]]);
            DB::commit();
            return response()->json(['message'=>'Role updated successfully','role'=>$role],200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'An error occurred while updating the role, '.$e->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
        DB::beginTransaction();
        try{
            $role->delete();
            DB::commit();
            return redirect('roles');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect('roles');
        }
    }
}
