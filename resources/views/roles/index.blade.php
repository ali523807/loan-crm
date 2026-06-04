@extends('layouts.app')

@section('title', 'Roles & Permissions')

@section('content')
    <div class="px-2">
        <div class="d-flex align-items-center justify-content-between gap-3">
            <div>
                <x-heading>Roles & Permissions</x-heading>
                <x-text>Control what each admin role can view or manage inside the CRM.</x-text>
            </div>

            @can('roles.manage')
                <x-button data-bs-toggle="#roleModal" id="add-role-btn" color="dark">
                    <x-lucide-plus class="w-4 h-4"/>
                    <span class="d-none d-sm-inline-block">Add Role</span>
                </x-button>
            @endcan
        </div>

        <x-card class="mt-3" body-class="px-0 pt-0 pb-1">
            <div class="table-responsive">
                <x-table id="roles-table" class="table table-borderless">
                    <thead>
                    <x-table.row>
                        <x-table.header>#</x-table.header>
                        <x-table.header>Name</x-table.header>
                        <x-table.header>Description</x-table.header>
                        <x-table.header>Permissions</x-table.header>
                        <x-table.header>Users</x-table.header>
                        <x-table.header>Actions</x-table.header>
                    </x-table.row>
                    </thead>
                    <tbody></tbody>
                </x-table>
            </div>
        </x-card>

        @include('roles._form')
    </div>
@endsection

@push('js')
    <script type="module">
        $(function () {
            let form = useForm('#roleForm');
            let modal = useModal('#roleModal');

            let table = $('#roles-table').jpDataTable({
                url: route('roles.index'),
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'display_name', name: 'display_name'},
                    {data: 'description', name: 'description'},
                    {data: 'permissions', name: 'permissions', orderable: false, searchable: false},
                    {data: 'users', name: 'users', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });

            $('#add-role-btn').click(function () {
                form.reset();
                $('#roleForm').find('[name="permissions[]"]').prop('checked', false);
                modal.open('Create Role');
            });

            $('#roleForm').on('submit', function (e) {
                e.preventDefault();

                $.easyAjax({
                    url: "{{ route('roles.storeOrUpdate') }}",
                    container: '#roleForm',
                    data: new FormData($('#roleForm')[0]),
                    file: true,
                    onComplete: () => {
                        modal.close();
                        form.reset();
                        table.draw(false);
                    }
                });
            });

            $('body').on('click', '.editRole', function (e) {
                e.preventDefault();

                axios.get(route('roles.edit', {role: $(this).data('id')})).then((response) => {
                    form.fill(response.data);
                    $('#roleForm').find('[name="permissions[]"]').prop('checked', false);
                    response.data.permissions.forEach((id) => {
                        $('#roleForm').find(`[name="permissions[]"][value="${id}"]`).prop('checked', true);
                    });
                    modal.open('Edit Role');
                });
            });

            $('body').on('click', '.deleteRole', function (e) {
                e.preventDefault();

                $.easyDelete({
                    url: route('roles.delete', {role: $(this).data('id')}),
                    confirmationMessage: 'Do you really want to delete this role?',
                    onComplete: () => table.draw(false)
                });
            });
        });
    </script>
@endpush
