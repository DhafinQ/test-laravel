<?php

namespace Tests\Unit;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRoleTest extends TestCase
{
    use RefreshDatabase;
    
    // Testing jika user memiliki role admin
    public function test_a_user_can_have_a_role()
    {
        $role = Role::create(['name' => 'admin']);

        $user = User::factory()->create();

        $user->assignRole('admin');

        // Return true karena user memiliki role admin
        $this->assertTrue($user->hasRole('admin'));
    }

    // Testing jika user memiliki permission.
    public function test_a_user_can_have_permissions()
    {
        $permission_edit = Permission::create(['name' => 'edit articles']);
        $permission_delete = Permission::create(['name' => 'delete articles']);

        $role = Role::create(['name' => 'writer']);
        $role2 = Role::create(['name' => 'viewer']);
        $role->givePermissionTo($permission_edit);
        $role->givePermissionTo($permission_delete);

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $user1->assignRole('writer');
        $user2->assignRole('viewer');

        // Return True karena user writer memiliki permission edit articles
        $this->assertTrue($user1->can('edit articles'));
        // Return false karena user viewer tidak memiliki permission edit articles
        $this->assertFalse($user2->can('edit articles'));
    }
}
