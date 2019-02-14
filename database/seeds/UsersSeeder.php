<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $password = \Illuminate\Support\Facades\Hash::make('secret');
        $verification_time = \Carbon\Carbon::now();
        $branch = \App\Branch::create(['branch_name'=>'Head Office','branch_code'=>'HREHQ01','branch_city'=>'Harare','branch_contact_number'=>'00263 4 771916','branch_contact_number_two'=>'00263 776 038509','branch_address'=>'Foundation Mutual Hse 3 Luck Street Harare']);

        $byo = \App\Branch::create(['branch_name'=>'Bulawayo Regional Offixe','branch_code'=>'BYOQ01','branch_city'=>'Bulawayo','branch_contact_number'=>'00263 4 771916','branch_contact_number_two'=>'00263 776 038509','branch_address'=>'Foundation Mutual Hse 3 Luck Street Harare']);

        $super = User::create(['account_status'=>'active','employee_code'=>'FMS800220','name'=>'Talent','surname'=>'Nharara','email'=>'admin@foundationmutual.co.zw'
            ,'contact_number'=>'076 677 777','branch_id'=>$branch->id,'email_verified_at'=>$verification_time,'password'=>$password]);

        $super_role = Role::where('name','app-admin')->first();
        $super->roles()->attach($super_role->id);

        $agent = User::create(['account_status'=>'active','employee_code'=>'FMS881008','name'=>'Agent','surname'=>'User','email'=>'agent@foundationmutual.co.zw'
            ,'contact_number'=>'076 677 777','branch_id'=>$branch->id,'email_verified_at'=>$verification_time,'password'=>$password]);

        $agent_role = Role::where('name','agent')->first();
        $agent->roles()->attach($agent_role->id);

        $prems = User::create(['account_status'=>'active','employee_code'=>'FMS891008','name'=>'Agent','surname'=>'User','email'=>'premiums@foundationmutual.co.zw'
            ,'contact_number'=>'076 677 777','branch_id'=>$branch->id,'email_verified_at'=>$verification_time,'password'=>$password]);

        $prems_role = Role::where('name','premium-accounting-clerk')->first();
        $prems->roles()->attach($prems_role->id);

        $clerk = User::create(['account_status'=>'active','employee_code'=>'FMS760428','name'=>'Clerk','surname'=>'User','email'=>'datacapturer@foundationmutual.co.zw'
            ,'contact_number'=>'076677777','branch_id'=>$branch->id,'email_verified_at'=>$verification_time,'password'=>$password]);

        $clerk_role = Role::where('name','data-capturer')->first();
        $clerk->roles()->attach($clerk_role->id);

        $claims_clerk = User::create(['account_status'=>'active','employee_code'=>'FMS860324','name'=>'Claims','surname'=>'Clerk','email'=>'claims@foundationmutual.co.zw'
            ,'contact_number'=>'076677777','branch_id'=>$branch->id,'email_verified_at'=>$verification_time,'password'=>$password]);

        $claims_role = Role::where('name','claims-clerk')->first();
        $claims_clerk->roles()->attach($claims_role->id);
    }
}
