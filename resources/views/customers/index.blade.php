@extends('layouts.app')

@section('title', 'Customers')

@section('content')
    <div class="px-2">
        <div>
            <x-heading>Customers</x-heading>
            <x-text>Customer records created from submitted loan applications.</x-text>
        </div>

        <x-card class="mt-3" body-class="px-0 pt-0 pb-1">
            <div class="table-responsive">
                <x-table id="customers-table" class="table table-borderless">
                    <thead>
                    <x-table.row>
                        <x-table.header>#</x-table.header>
                        <x-table.header>Name</x-table.header>
                        <x-table.header>Mobile</x-table.header>
                        <x-table.header>Email</x-table.header>
                        <x-table.header>PAN</x-table.header>
                        <x-table.header>Applications</x-table.header>
                        <x-table.header>Created</x-table.header>
                        <x-table.header>Actions</x-table.header>
                    </x-table.row>
                    </thead>
                    <tbody></tbody>
                </x-table>
            </div>
        </x-card>
    </div>
@endsection

@push('js')
    <script type="module">
        $(function () {
            $('#customers-table').jpDataTable({
                url: route('customers.index'),
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'full_name', name: 'full_name'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'email', name: 'email'},
                    {data: 'pan_number', name: 'pan_number'},
                    {data: 'applications', name: 'applications'},
                    {data: 'created', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });
        });
    </script>
@endpush
