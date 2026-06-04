<x-modal id="roleModal" title="Create Role">
    <x-form id="roleForm">
        <x-modal.body class="space-y-3">
            <input type="hidden" name="id">

            <x-input name="display_name" label="Role Name" placeholder="Example: Branch Manager"/>
            <x-textarea name="description" label="Description" placeholder="Describe this role"/>

            <div>
                <label class="form-label fw-bold">Permissions</label>

                <div class="row g-3">
                    @foreach($permissions as $group => $items)
                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <h6 class="text-capitalize mb-3">{{ str_replace('-', ' ', $group) }}</h6>

                                <div class="d-grid gap-2">
                                    @foreach($items as $permission)
                                        <label class="form-check d-flex align-items-center gap-2">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   name="permissions[]"
                                                   value="{{ $permission->id }}">
                                            <span class="form-check-label">{{ $permission->display_name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </x-modal.body>

        <x-modal.footer>
            <x-button color="light" data-bs-dismiss="modal">Cancel</x-button>
            <x-button color="dark" type="submit">Submit</x-button>
        </x-modal.footer>
    </x-form>
</x-modal>
