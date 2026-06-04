<div class="d-flex align-items-center gap-1">
    @can('admin-users.manage')
        <x-dropdown align="end" color="light" icon="lucide-ellipsis" buttonClass="btn-sm">
            <x-dropdown.header>Manage</x-dropdown.header>

            <x-dropdown.item
                icon="lucide-edit"
                class="editAdminUser"
                data-id="{{ $adminUser->id }}"
            >
                Edit
            </x-dropdown.item>

            @unless($adminUser->is(auth()->user()) || $adminUser->isSuperAdmin())
                <x-dropdown.item
                    icon="lucide-trash"
                    class="text-danger deleteAdminUser"
                    data-id="{{ $adminUser->id }}"
                >
                    Delete
                </x-dropdown.item>
            @endunless
        </x-dropdown>
    @endcan
</div>
