<div class="d-flex align-items-center gap-1">
    @can('roles.manage')
        <x-dropdown align="end" color="light" icon="lucide-ellipsis" buttonClass="btn-sm">
            <x-dropdown.header>Manage</x-dropdown.header>

            <x-dropdown.item
                icon="lucide-edit"
                class="editRole"
                data-id="{{ $role->id }}"
            >
                Edit
            </x-dropdown.item>

            @unless($role->is_system)
                <x-dropdown.item
                    icon="lucide-trash"
                    class="text-danger deleteRole"
                    data-id="{{ $role->id }}"
                >
                    Delete
                </x-dropdown.item>
            @endunless
        </x-dropdown>
    @endcan
</div>
