@extends('layouts.app')

@section('title', 'Admin Users')

@section('content')
    <div class="px-2">
        <div class="d-flex align-items-center justify-content-between gap-3">
            <div>
                <x-heading>Admin Users</x-heading>
                <x-text>Create admins and assign roles based on their responsibility.</x-text>
            </div>

            @can('admin-users.manage')
                <x-button data-bs-toggle="#adminUserModal" id="add-admin-user-btn" color="dark">
                    <x-lucide-plus class="w-4 h-4"/>
                    <span class="d-none d-sm-inline-block">Add Admin</span>
                </x-button>
            @endcan
        </div>

        <x-card class="mt-3" body-class="px-0 pt-0 pb-1">
            <div class="table-responsive">
                <x-table id="admin-users-table" class="table table-borderless">
                    <thead>
                    <x-table.row>
                        <x-table.header>#</x-table.header>
                        <x-table.header>Name</x-table.header>
                        <x-table.header>Email</x-table.header>
                        <x-table.header>Roles</x-table.header>
                        <x-table.header>Status</x-table.header>
                        <x-table.header>Actions</x-table.header>
                    </x-table.row>
                    </thead>
                    <tbody></tbody>
                </x-table>
            </div>
        </x-card>

        @include('admin-users._form')
    </div>
@endsection

@push('js')
    <script type="module">
        $(function () {
            let form = useForm('#adminUserForm');
            let modal = useModal('#adminUserModal');

            let table = $('#admin-users-table').jpDataTable({
                url: route('admin-users.index'),
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'roles', name: 'roles', orderable: false, searchable: false},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });

            $('#add-admin-user-btn').click(function () {
                form.reset();
                $('#adminUserForm').find('[name="roles[]"]').prop('checked', false);
                $('#adminUserForm').find('[name="active"]').prop('checked', true);
                modal.open('Create Admin');
            });

            $('#adminUserForm').on('submit', function (e) {
                e.preventDefault();

                $.easyAjax({
                    url: "{{ route('admin-users.storeOrUpdate') }}",
                    container: '#adminUserForm',
                    data: new FormData($('#adminUserForm')[0]),
                    file: true,
                    onComplete: () => {
                        modal.close();
                        form.reset();
                        table.draw(false);
                    }
                });
            });

            $('body').on('click', '.editAdminUser', function (e) {
                e.preventDefault();

                axios.get(route('admin-users.edit', {adminUser: $(this).data('id')})).then((response) => {
                    form.fill(response.data);
                    $('#adminUserForm').find('[name="password"], [name="password_confirmation"]').val('');
                    $('#adminUserForm').find('[name="roles[]"]').prop('checked', false);
                    response.data.roles.forEach((id) => {
                        $('#adminUserForm').find(`[name="roles[]"][value="${id}"]`).prop('checked', true);
                    });
                    modal.open('Edit Admin');
                });
            });

            $('body').on('click', '.deleteAdminUser', function (e) {
                e.preventDefault();

                $.easyDelete({
                    url: route('admin-users.delete', {adminUser: $(this).data('id')}),
                    confirmationMessage: 'Do you really want to delete this admin user?',
                    onComplete: () => table.draw(false)
                });
            });
        });
    </script>
@endpush
