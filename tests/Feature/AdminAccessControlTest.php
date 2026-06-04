<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseTransactions::class);

beforeEach(function () {
    $this->seed(RolesAndPermissionsSeeder::class);
});

it('allows super admin to access role management', function () {
    $user = User::query()
        ->where('email', 'superadmin@loancrm.test')
        ->firstOrFail();

    $this->actingAs($user)
        ->get(route('roles.index'))
        ->assertOk();
});

it('blocks admins without a required permission', function () {
    $user = User::factory()->create();
    $user->roles()->attach(Role::query()->where('name', 'sales-executive')->value('id'));

    $this->actingAs($user)
        ->get(route('roles.index'))
        ->assertForbidden();
});

it('uses the current loan crm permission set', function () {
    expect(Permission::query()->whereIn('name', [
        'categories.view',
        'categories.manage',
        'products.view',
        'products.manage',
    ])->exists())->toBeFalse()
        ->and(Permission::query()->whereIn('name', [
            'customers.view',
            'communications.send',
            'documents.upload',
            'generated-documents.manage',
            'documents.verify',
            'loans.disburse',
        ])->count())->toBe(6);
});

it('allows sales users to access current lead workflow modules', function () {
    $user = User::factory()->create();
    $user->roles()->attach(Role::query()->where('name', 'sales-executive')->value('id'));

    expect($user->fresh()->hasPermissionTo('customers.view'))->toBeTrue()
        ->and($user->fresh()->hasPermissionTo('communications.send'))->toBeTrue()
        ->and($user->fresh()->hasPermissionTo('documents.upload'))->toBeTrue()
        ->and($user->fresh()->hasPermissionTo('generated-documents.manage'))->toBeTrue();
});

it('prevents inactive admins from logging in', function () {
    User::factory()->create([
        'email' => 'inactive@example.com',
        'password' => 'password',
        'active' => false,
    ]);

    $this->post('/login', [
        'email' => 'inactive@example.com',
        'password' => 'password',
    ])->assertSessionHasErrors('email');
});
