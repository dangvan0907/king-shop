<?php

namespace Tests;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use WithFaker;

    protected function loginWithSuperAdmin()
    {
        $user = User::factory()->create();
        $role = Role::where('name', 'supper-admin')->pluck('id');
        $user->roles()->attach($role);
        return $this->actingAs($user);
    }

    protected function loginWithUser()
    {
        $user = User::factory()->create();

        return $this->actingAs($user);
    }

    protected function loginUserWithPermission($permission)
    {
        $user = User::factory()->create();
        $role = Role::factory()->create();
        $permission = Permission::where('name', $permission)->first();

        $user->roles()->attach($role->pluck('id'));
        $role->permissions()->attach($permission->pluck('id'));
        return $this->actingAs($user);
    }
}
