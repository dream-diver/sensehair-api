<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $stylistRole = Role::create(['name' => 'stylist']);
        $customerRole = Role::create(['name' => 'customer']);
        $guestRole = Role::create(['name' => 'guest']);

        // create user permission
        $permission = Permission::create(['name' => 'users.create']);
        $adminRole->givePermissionTo($permission);

        // index user permission
        $permission = Permission::create(['name' => 'users.index']);
        $adminRole->givePermissionTo($permission);

        // show user permission
        $permission = Permission::create(['name' => 'users.show']);
        $adminRole->givePermissionTo($permission);

        // update user permission
        $permission = Permission::create(['name' => 'users.update']);
        $adminRole->givePermissionTo($permission);

        // delete user permission
        $permission = Permission::create(['name' => 'users.delete']);
        $adminRole->givePermissionTo($permission);

        // create a booking permission
        $permission = Permission::create(['name' => 'bookings.create']);
        $adminRole->givePermissionTo($permission);
        $customerRole->givePermissionTo($permission);
        $guestRole->givePermissionTo($permission);
    }
}
