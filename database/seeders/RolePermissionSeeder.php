<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'edit articles']); 
        Permission::create(['name' => 'delete articles']); 
        
        $role1 = Role::create(['name' => 'writer']); 
        $role1->givePermissionTo('edit articles'); 
        $role1->givePermissionTo('delete articles'); 
        $role2 = Role::create(['name' => 'admin']); 
        
        $user = \App\Models\User::factory()->create([ 
            'name' => 'Example User', 
            'email' => 'writer@example.com', 
            'password' => Hash::make('writer')
        ]); 
        $user->assignRole($role1); 
        
        $user = \App\Models\User::factory()->create([ 
            'name' => 'Example Admin User', 
            'email' => 'admin@example.com', 
            'password' => Hash::make('admin')
        ]);
        $user->assignRole($role2); 
         
    }
}
