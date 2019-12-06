<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\User;

class RolePermissionSeeder20Nov2019 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role Super Admin
        $role_super_admin = Role::where('name','Administrator')->first();
        if(is_null($role_super_admin)){
            $role_super_admin = Role::create(['name' => 'Administrator']);
        }
        $permissions = ['open_page_dashboard','open_page_leads','open_page_schools','open_page_postal_code','open_page_field_of_study','open_page_major','open_page_event','open_page_branch','open_page_country','open_page_marketing_source','open_page_institution','open_page_institution_group','open_page_institution_contact','open_page_users'];
        foreach($permissions as $per){
            $permission = Permission::where('name', $per)->first();
            if(is_null($permission)){
                Permission::create(['name' => $per]);
            }
            $role_super_admin->givePermissionTo($per);
        }

        // Role Administrator
        $role_administrator = Role::where('name','Administrator')->first();
        if(is_null($role_administrator)){
            $role_administrator = Role::create(['name' => 'Administrator']);
        }
        $permissions = ['open_page_dashboard','open_page_schools','open_page_postal_code','open_page_field_of_study','open_page_major','open_page_event','open_page_branch','open_page_country','open_page_marketing_source','open_page_institution','open_page_institution_group','open_page_institution_contact','open_page_users'];
        foreach($permissions as $per){
            $permission = Permission::where('name', $per)->first();
            if(is_null($permission)){
                Permission::create(['name' => $per]);
            }
            $role_administrator->givePermissionTo($per);
        }

        // Role Product Manager
        $role_product_manager = Role::where('name','Product Manager')->first();
        if(is_null($role_product_manager)){
            $role_product_manager = Role::create(['name' => 'Product Manager']);
        }

        $permissions = ['open_page_dashboard','open_page_country','open_page_institution','open_page_institution_group','open_page_institution_contact'];
        foreach($permissions as $per){
            $permission = Permission::where('name', $per)->first();
            if(is_null($permission)){
                Permission::create(['name' => $per]);
            }
            $role_product_manager->givePermissionTo($per);
        }

        // Role Digital Marketing
        $role_digital_marketing = Role::where('name','Digital Marketing')->first();
        if(is_null($role_digital_marketing)){
            $role_digital_marketing = Role::create(['name' => 'Digital Marketing']);
        }

        $permissions = ['open_page_dashboard','open_page_event','open_page_marketing_source'];
        foreach($permissions as $per){
            $permission = Permission::where('name', $per)->first();
            if(is_null($permission)){
                Permission::create(['name' => $per]);
            }
            $role_digital_marketing->givePermissionTo($per);
        }
    }
}
