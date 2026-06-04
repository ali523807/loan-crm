<?php

use App\Models\Role;
use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseTransactions::class);

beforeEach(function () {
    $this->seed(RolesAndPermissionsSeeder::class);
});

it('creates an admin user with assigned roles', function () {
    $superAdmin = User::query()
        ->where('email', 'superadmin@loancrm.test')
        ->firstOrFail();

    $role = Role::query()
        ->where('name', 'manager')
        ->firstOrFail();

    $this->actingAs($superAdmin)
        ->postJson(route('admin-users.storeOrUpdate'), [
            'name' => 'Branch Manager',
            'email' => 'branch.manager@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'roles' => [$role->id],
            'active' => true,
        ])
        ->assertSuccessful();

    $user = User::query()
        ->where('email', 'branch.manager@example.com')
        ->firstOrFail();

    expect($user->roles()->where('name', 'manager')->exists())->toBeTrue();
});

it('requires a role when creating an admin user', function () {
    $superAdmin = User::query()
        ->where('email', 'superadmin@loancrm.test')
        ->firstOrFail();

    $this->actingAs($superAdmin)
        ->postJson(route('admin-users.storeOrUpdate'), [
            'name' => 'No Role Admin',
            'email' => 'no.role@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'active' => true,
        ])
        ->assertJsonValidationErrors('roles');
});
