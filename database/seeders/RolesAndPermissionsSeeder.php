<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'dashboard' => [
                'dashboard.view' => 'View Dashboard',
            ],
            'users' => [
                'admin-users.view' => 'View Admin Users',
                'admin-users.manage' => 'Manage Admin Users',
            ],
            'roles' => [
                'roles.view' => 'View Roles',
                'roles.manage' => 'Manage Roles',
            ],
            'leads' => [
                'leads.view' => 'View Leads',
                'leads.manage' => 'Manage Leads',
            ],
            'customers' => [
                'customers.view' => 'View Customers',
            ],
            'documents' => [
                'documents.upload' => 'Upload Documents',
                'documents.verify' => 'Verify Documents',
                'generated-documents.manage' => 'Generate Loan Letters',
            ],
            'communications' => [
                'communications.send' => 'Send Customer Communications',
            ],
            'finance' => [
                'financial.verify' => 'Financial Verification',
                'loans.approve' => 'Approve Loans',
                'loans.disburse' => 'Disburse Loans',
            ],
        ];

        $permissionModels = collect($permissions)
            ->flatMap(fn (array $items, string $group): array => collect($items)
                ->map(fn (string $displayName, string $name): Permission => Permission::query()->updateOrCreate(
                    ['name' => $name],
                    ['display_name' => $displayName, 'group' => $group],
                ))
                ->all());

        $roles = [
            'super-admin' => [
                'display_name' => 'Super Admin',
                'description' => 'Full system access.',
                'permissions' => $permissionModels->pluck('name')->all(),
            ],
            'manager' => [
                'display_name' => 'Manager',
                'description' => 'Can manage operations and approve loan decisions.',
                'permissions' => [
                    'dashboard.view',
                    'admin-users.view',
                    'roles.view',
                    'leads.view',
                    'leads.manage',
                    'customers.view',
                    'documents.upload',
                    'documents.verify',
                    'generated-documents.manage',
                    'communications.send',
                    'financial.verify',
                    'loans.approve',
                    'loans.disburse',
                ],
            ],
            'sales-executive' => [
                'display_name' => 'Sales Executive',
                'description' => 'Can manage leads, customers, follow-ups, messages, and customer-facing letters.',
                'permissions' => [
                    'dashboard.view',
                    'leads.view',
                    'leads.manage',
                    'customers.view',
                    'documents.upload',
                    'generated-documents.manage',
                    'communications.send',
                ],
            ],
            'verification-officer' => [
                'display_name' => 'Verification Officer',
                'description' => 'Can review leads, verify documents, and request missing files.',
                'permissions' => [
                    'dashboard.view',
                    'leads.view',
                    'customers.view',
                    'documents.upload',
                    'documents.verify',
                    'communications.send',
                ],
            ],
            'finance-officer' => [
                'display_name' => 'Finance Officer',
                'description' => 'Can process financial checks, loan letters, communication, and disbursement.',
                'permissions' => [
                    'dashboard.view',
                    'leads.view',
                    'customers.view',
                    'generated-documents.manage',
                    'communications.send',
                    'financial.verify',
                    'loans.disburse',
                ],
            ],
        ];

        foreach ($roles as $name => $roleData) {
            $role = Role::query()->updateOrCreate(
                ['name' => $name],
                [
                    'display_name' => $roleData['display_name'],
                    'description' => $roleData['description'],
                    'is_system' => true,
                ],
            );

            $role->permissions()->sync(
                Permission::query()
                    ->whereIn('name', $roleData['permissions'])
                    ->pluck('id')
                    ->all(),
            );
        }

        Permission::query()
            ->whereIn('name', [
                'categories.view',
                'categories.manage',
                'products.view',
                'products.manage',
            ])
            ->delete();

        $superAdmin = User::query()->firstOrCreate(
            ['email' => 'superadmin@loancrm.test'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'active' => true,
            ],
        );

        $superAdmin->roles()->syncWithoutDetaching([
            Role::query()->where('name', 'super-admin')->value('id'),
        ]);
    }
}
