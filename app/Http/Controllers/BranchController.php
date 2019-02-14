<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Http\Requests\BranchStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
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
        return view('branches.index');
    }

    public function getBranches(){
        $branches = Branch::orderBy('branch_name','asc')->get();

        return Datatables::of($branches)->addColumn('action', function ($branch) {
            $re = '/branch/edit/' . $branch->id;
            $del = '/branch/delete/' . $branch->id;
            return '<a href=' . $re . ' title="Edit Branch" style="color:green;"><i class="material-icons">create</i></a><a href=' . $del . ' title="Delete Branch" style="color:red"><i class="material-icons">delete_forever</i></a>';
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
    public function store(BranchStoreRequest $request)
    {
        //
        $input = $request->validated();
        DB::beginTransaction();
        try{
            $branch = Branch::create($input);
            DB::commit();
            return response()->json(['message'=>'Branch saved successfully','branch'=>$branch],200);

        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'Branch could not be saved at the moment '.$e->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        //
        return view('branches.edit',compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(BranchStoreRequest $request, Branch $branch)
    {
        //
        $input = $request->validated();
        DB::beginTransaction();
        try{
            $branch->update($input);
            DB::commit();
            return response()->json(['message'=>'Branch updated successfully','branch'=>$branch],200);

        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['message'=>'Branch could not be updated at the moment '.$e->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        //
        DB::beginTransaction();
        try{
            $branch->delete();
            DB::commit();
            return redirect('branches');
        }catch (\Exception $e){
            DB::rollBack();
            return redirect('branches');
        }
    }
}
