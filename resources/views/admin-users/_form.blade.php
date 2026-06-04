<x-modal id="adminUserModal" title="Create Admin">
    <x-form id="adminUserForm">
        <x-modal.body class="space-y-3">
            <input type="hidden" name="id">

            <x-input name="name" label="Name" placeholder="Enter admin name"/>
            <x-input name="email" label="Email" type="email" placeholder="admin@example.com"/>

            <div class="row g-3">
                <div class="col-md-6">
                    <x-input name="password" label="Password" type="password" placeholder="Leave blank when editing"/>
                </div>

                <div class="col-md-6">
                    <x-input name="password_confirmation" label="Confirm Password" type="password" placeholder="Confirm password"/>
                </div>
            </div>

            <div>
                <label class="form-label fw-bold">Roles</label>

                <div class="row g-2">
                    @foreach($roles as $role)
                        <div class="col-md-6">
                            <label class="form-check d-flex align-items-center gap-2 border rounded p-2">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="roles[]"
                                       value="{{ $role->id }}">
                                <span class="form-check-label">{{ $role->display_name }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <input type="hidden" name="active" value="0">
            <label class="form-check d-flex align-items-center gap-2">
                <input class="form-check-input" type="checkbox" name="active" value="1" checked>
                <span class="form-check-label">Active admin account</span>
            </label>
        </x-modal.body>

        <x-modal.footer>
            <x-button color="light" data-bs-dismiss="modal">Cancel</x-button>
            <x-button color="dark" type="submit">Submit</x-button>
        </x-modal.footer>
    </x-form>
</x-modal>
