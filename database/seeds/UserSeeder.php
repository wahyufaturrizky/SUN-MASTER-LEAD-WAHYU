<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // $role_super_admin = Role::create(['name' => 'superadmin']); // Super Admin
        $role_admin = Role::create(['name' => 'admin']); // Administrator
        
		// $user_super_admin = new User();
		// $user_super_admin->name = "Super Admin";
		// $user_super_admin->email = "superadmin@superadmin.com";
        // $user_super_admin->password = bcrypt("superadmin@superadmin.com");
        // $user_super_admin->mobile = '+6285773020031';
        // $qrcode = Storage::disk('profile_qrcode')->put($user_super_admin->mobile . '.png',base64_decode(DNS2D::getBarcodePNG($user_super_admin->mobile, "QRCODE", 20, 20)));
        // $user_super_admin->qrcode = $user_super_admin->mobile . '.png';
        // // $user_super_admin->profile_image = "theadmin/img/avatar/default.jpg";
		// $user_super_admin->save();
		// $user_super_admin->assignRole('superadmin');

        $user_admin = new User();
        $user_admin->name = "Admin";
        $user_admin->email = "admin@admin.com";
        $user_admin->password = bcrypt("freeman10");
        $user_admin->save();
        $user_admin->assignRole('admin');
    }
}
