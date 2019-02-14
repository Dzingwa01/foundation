<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $super_admin = [
            'super-delete' => true,
            'super-add' => true,
            'super-update' => true,
            'super-view' => true,
        ];

        $agent_perms = [
            'agent-delete' => true,
            'agent-add' => true,
            'agent-update' => true,
            'agent-view' => true,
        ];

        $office_clerk = [
            'data-capture-delete' => true,
            'data-capture-add' => true,
            'data-capture-update' => true,
            'data-capture-view' => true,
        ];

        $claims_perms = [
            'claims-clerk-delete' => true,
            'claims-clerk-add' => true,
            'claims-clerk-update' => true,
            'claims-clerk-view' => true,
        ];

        $client_services = [
            'client-services-delete' => true,
            'client-services-add' => true,
            'client-services-update' => true,
            'client-services-view' => true,
        ];

        $it_manager_perms = [
            'it-manager-delete' => true,
            'it-manager-add' => true,
            'it-manager-update' => true,
            'it-manager-view' => true,
        ];

        $funeral_services_manager_perms = [
            'funeral-services-manager-delete' => true,
            'funeral-services-manager-add' => true,
            'funeral-services-manager-update' => true,
            'funeral-services-manager-view' => true,
        ];

        $supervisor_perms =[
        'supervisor-delete' => true,
            'supervisor-add' => true,
            'supervisor-update' => true,
            'supervisor-view' => true,
        ];

        $undertaker_perms =[
            'undertaker-delete' => true,
            'undertaker-add' => true,
            'undertaker-update' => true,
            'undertaker-view' => true,
        ];

        $premiums_accounting_perms =[
            'premiums_accounting-delete' => true,
            'premiums_accounting-add' => true,
            'premiums_accounting-update' => true,
            'premiums_accounting-view' => true,
        ];

        $super_user = Role::create([
            'name' => 'app-admin',
            'display_name'=>'Operations Manager',
            'permissions' =>$super_admin,
            'guard_name'=>'web'
        ]);

        $data_capturer = Role::create([
            'name' => 'data-capturer',
            'display_name'=>'Data Capturer',
            'permissions' =>$office_clerk,
            'guard_name'=>'web'
        ]);

        $premiums_accounting = Role::create([
            'name' => 'premium-accounting-clerk',
            'display_name'=>'Premium Accounting',
            'permissions' =>$premiums_accounting_perms,
            'guard_name'=>'web'
        ]);

        $claims_clerk = Role::create([
            'name' => 'claims-clerk',
            'display_name'=>'Claims Clerk',
            'permissions' =>$claims_perms,
            'guard_name'=>'web'
        ]);

        $client_servs = Role::create([
            'name' => 'client-services',
            'display_name'=>'Client Services',
            'permissions' =>$client_services,
            'guard_name'=>'web'
        ]);

        $agent = Role::create([
            'name' => 'agent',
            'display_name'=>'Agent',
            'permissions' =>$agent_perms,
            'guard_name'=>'web'
        ]);

        $it_manager = Role::create([
            'name' => 'it-manager',
            'display_name'=>'IT Manager',
            'permissions' =>$it_manager_perms,
            'guard_name'=>'web'
        ]);

        $supervisor = Role::create([
            'name' => 'supervisor',
            'display_name'=>'Supervisor',
            'permissions' =>$supervisor_perms,
            'guard_name'=>'web'
        ]);

        $undertaker = Role::create([
            'name' => 'undertaker',
            'display_name'=>'Undertaker',
            'permissions' =>$undertaker_perms,
            'guard_name'=>'web'
        ]);

        $funeral_services_manager = Role::create([
            'name' => 'funaral-services-manager',
            'display_name'=>'Funeral Services Manager',
            'permissions' =>$funeral_services_manager_perms,
            'guard_name'=>'web'
        ]);

    }
}
