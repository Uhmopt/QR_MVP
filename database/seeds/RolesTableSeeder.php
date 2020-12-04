<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         //Roles
         $admin=Role::create(['name' => 'admin']);
         $owner=Role::create(['name' => 'owner']);
         $driver=Role::create(['name' => 'driver']);
         $client=Role::create(['name' => 'client']);
         $manager=Role::create(['name' => 'manager']);

         //Permissions
         $admin->givePermissionTo(Permission::create(['name' => 'manage restorants']));
         $admin->givePermissionTo(Permission::create(['name' => 'manage drivers']));
         $admin->givePermissionTo(Permission::create(['name' => 'manage orders']));
         $admin->givePermissionTo(Permission::create(['name' => 'edit settings']));
         $admin->givePermissionTo(Permission::create(['name' => 'manage branch']));

         $owner->givePermissionTo(Permission::create(['name' => 'view orders']));
         $owner->givePermissionTo(Permission::create(['name' => 'edit restorant']));
         $owner->givePermissionTo(Permission::create(['name' => 'edit branch']));

         $driver->givePermissionTo(Permission::create(['name' => 'edit orders']));

         $manager->givePermissionTo(Permission::create(['name' => 'view branch']));

         $backedn = Permission::create(['name' => 'access backedn']);
         $admin->givePermissionTo($backedn);
         $owner->givePermissionTo($backedn);
         $driver->givePermissionTo($backedn);

         //ADD ADMIN USER ROLE
        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' =>  'App\User',
            'model_id'=> 1
        ]);
        
         

         
        
    }
}