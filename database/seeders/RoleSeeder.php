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
        $artDirectortRole = Role::create(['name' => 'art_director']);
        $customerRole = Role::create(['name' => 'customer']);
        $guestRole = Role::create(['name' => 'guest']);

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // User model permissions
        // create user permission
        $permission = Permission::create(['name' => 'users.create']);
        $adminRole->givePermissionTo($permission);

        // index user permission
        $permission = Permission::create(['name' => 'users.index']);
        $adminRole->givePermissionTo($permission);

        // show user permission
        $permission = Permission::create(['name' => 'users.show']);
        $adminRole->givePermissionTo($permission);
        $customerRole->givePermissionTo($permission);

        // update user permission
        $permission = Permission::create(['name' => 'users.update']);
        $adminRole->givePermissionTo($permission);
        $customerRole->givePermissionTo($permission);

        // delete user permission
        $permission = Permission::create(['name' => 'users.delete']);
        $adminRole->givePermissionTo($permission);
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // create service permission
        $permission = Permission::create(['name' => 'services.create']);
        $adminRole->givePermissionTo($permission);

        // index service permission
        $permission = Permission::create(['name' => 'services.index']);
        $adminRole->givePermissionTo($permission);

        // show service permission
        $permission = Permission::create(['name' => 'services.show']);
        $adminRole->givePermissionTo($permission);

        // update service permission
        $permission = Permission::create(['name' => 'services.update']);
        $adminRole->givePermissionTo($permission);

        // delete service permission
        $permission = Permission::create(['name' => 'services.delete']);
        $adminRole->givePermissionTo($permission);
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // create a booking permission
        $permission = Permission::create(['name' => 'bookings.create']);
        $adminRole->givePermissionTo($permission);
        $customerRole->givePermissionTo($permission);
        $guestRole->givePermissionTo($permission);
        
        // index booking permission
        $permission = Permission::create(['name' => 'bookings.index']);
        $adminRole->givePermissionTo($permission);
        $customerRole->givePermissionTo($permission);
        $stylistRole->givePermissionTo($permission);
        $artDirectortRole->givePermissionTo($permission);

        // show booking permission
        $permission = Permission::create(['name' => 'bookings.show']);
        $adminRole->givePermissionTo($permission);
        $stylistRole->givePermissionTo($permission);
        $artDirectortRole->givePermissionTo($permission);

        // update booking permission
        $permission = Permission::create(['name' => 'bookings.update']);
        $adminRole->givePermissionTo($permission);
        $stylistRole->givePermissionTo($permission);
        $artDirectortRole->givePermissionTo($permission);

        // delete booking permission
        $permission = Permission::create(['name' => 'bookings.delete']);
        $adminRole->givePermissionTo($permission);
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // create service permission
        $permission = Permission::create(['name' => 'promocodes.create']);
        $adminRole->givePermissionTo($permission);

        // index service permission
        $permission = Permission::create(['name' => 'promocodes.index']);
        $adminRole->givePermissionTo($permission);

        // show service permission
        $permission = Permission::create(['name' => 'promocodes.show']);
        $adminRole->givePermissionTo($permission);

        // update service permission
        $permission = Permission::create(['name' => 'promocodes.update']);
        $adminRole->givePermissionTo($permission);

        // delete service permission
        $permission = Permission::create(['name' => 'promocodes.delete']);
        $adminRole->givePermissionTo($permission);
    }
}
