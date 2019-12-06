<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name','admin')->first();
        $role_digital_marketing = Role::create(['name' => 'digital_marketing']); // Digital Marketing

        Permission::create(['name' => 'open_page_dashboard']);
        Permission::create(['name' => 'open_page_leads']);
        Permission::create(['name' => 'open_page_schools']);
        Permission::create(['name' => 'open_page_postal_code']);
        Permission::create(['name' => 'open_page_field_of_study']);
        Permission::create(['name' => 'open_page_major']);
        Permission::create(['name' => 'open_page_event']);

        $role_admin->givePermissionTo('open_page_dashboard','open_page_leads','open_page_schools','open_page_postal_code','open_page_field_of_study','open_page_major','open_page_event');
        $role_digital_marketing->givePermissionTo('open_page_event');

        $user_admin = new User();
        $user_admin->name = "Digital Marketing";
        $user_admin->email = "dm@suneducationgroup.com";
        $user_admin->password = bcrypt("DreamBig2019");
        $user_admin->save();
        $user_admin->assignRole('digital_marketing');

    }
}
