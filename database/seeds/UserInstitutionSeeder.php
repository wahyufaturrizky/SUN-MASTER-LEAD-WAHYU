<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\User;

class UserInstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name','admin')->first();

        $permissions = ['open_page_dashboard','open_page_leads','open_page_schools','open_page_postal_code','open_page_field_of_study','open_page_major','open_page_event','open_page_branch','open_page_country','open_page_marketing_source','open_page_institution','open_page_institution_group','open_page_institution_contact'];
        foreach($permissions as $per){
            $check = Permission::where('name', $per)->first();
            if(is_null($check)){
                Permission::create(['name' => $per]);
                $role_admin->givePermissionTo($per);
            }
        }
        // $role_super_admin = Role::create(['name' => 'superadmin']); // Super Admin
        $role_institution = Role::create(['name' => 'institution']); // Manage Institution

        // Permission::create(['name' => 'open_page_institution']);
        // Permission::create(['name' => 'open_page_institution_group']);
        // Permission::create(['name' => 'open_page_institution_contact']);

        $role_institution->givePermissionTo('open_page_institution','open_page_institution_group','open_page_institution_contact');

        $role_admin->givePermissionTo('open_page_institution','open_page_institution_group','open_page_institution_contact');

        $user_institution = new User();
        $user_institution->name = "Institution";
        $user_institution->email = "institution@suneducationgroup.com";
        $user_institution->password = bcrypt("freeman10");
        $user_institution->save();
        $user_institution->assignRole('institution');
    }
}
