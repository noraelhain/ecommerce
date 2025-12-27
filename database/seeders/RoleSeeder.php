<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin= Role::create(['name'=>'admin']);
        $user= Role::create(['name'=>'user']);  //view category
        $provider=Role::create(['name'=>'provider']); // create , update

        $admin->givePermissionTo(Permission::all());

        $user->givePermissionTo('view category');

        $provider->givePermissionTo(['creat category','update categroy']);

        $user =User::first();

        // $user->assignRole('admin');

        // $user->givePermission('view category');

        
    }
}
