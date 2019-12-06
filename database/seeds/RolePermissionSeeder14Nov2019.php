<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\User;

class RolePermissionSeeder14Nov2019 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_super_admin = Role::where('name','admin')->first();
        $role_super_admin->name = 'Super Admin';
        $role_super_admin->save();

        $role_admin = Role::create(['name' => 'Administrator']);
        $permissions = ['open_page_dashboard','open_page_schools','open_page_postal_code','open_page_field_of_study','open_page_major','open_page_event','open_page_branch','open_page_country','open_page_marketing_source','open_page_institution','open_page_institution_group','open_page_institution_contact'];
        foreach($permissions as $per){
            $check = Permission::where('name', $per)->first();
            if(is_null($check)){
                Permission::create(['name' => $per]);
                $role_admin->givePermissionTo($per);
            }
        }

        $role_pm = Role::where('name','institution')->first();
        $role_pm->name = 'Product Manager';
        $role_pm->save();
        $role_pm->givePermissionTo('open_page_country');

        $role_digital_marketing = Role::where('name','digital_marketing')->first();
        $role_digital_marketing->name = 'Digital Marketing';
        $role_digital_marketing->save();
    }
}
