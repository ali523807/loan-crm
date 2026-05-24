@extends('layouts.app')

@section('title', 'Products')

@section('content')

    <div class="px-2">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <x-heading>Manage Products</x-heading>
                <x-text>This is the standard text component for body copy and general content throughout your
                    application.
                </x-text>
            </div>

            <x-button data-bs-toggle="#productModal" id="add-product-btn" color="dark">
                <x-lucide-plus class="w-4 h-4"/>
                <span class="d-none d-sm-inline-block">Add Product</span>
            </x-button>
        </div>

        <x-card class="mt-2" id="bulk-actions" style="display:none">

            <div>You have selected <span class="fw-bold" id="selected-count"></span> entries</div>

            <div class="mt-1">
                <!-- Uses global ajaxUrl -->
                <button data-action="delete" class="btn btn-sm btn-danger">Delete Selected</button>

                <!-- Custom url for this button -->
                <button data-action="export" data-url="/api/items/export" class="btn btn-sm btn-secondary">
                    Export Selected
                </button>
            </div>
        </x-card>

        <x-card class="mt-3" body-class="px-0 pt-0 pb-1">
            <div class="table-responsive">
                <x-table id="products-table" class="table table-borderless">
                    <thead>
                    <x-table.row>
                        <x-table.header><input type="checkbox" id="select-all"></x-table.header>
                        <x-table.header>#</x-table.header>
                        <x-table.header>Name</x-table.header>
                        <x-table.header>Price</x-table.header>
                        <x-table.header>Description</x-table.header>
                        <x-table.header>Actions</x-table.header>
                    </x-table.row>
                    </thead>
                    <tbody>

                    </tbody>
                </x-table>
            </div>
        </x-card>

        @include('products._form')

    </div>

@endsection

@push('js')
    <script type="module">
        $(function () {
            let form = useForm('#productForm');
            let modal = useModal('#productModal');

            const toggleEmptyRow = () => {
                const hasItems = $('#quotation-items-table tbody tr[data-product-id]').length > 0;
                $('#quotation-empty-row').toggle(!hasItems);
            };

            let table = $('#products-table').jpDataTable({
                url: route('products.index'),
                columns: [
                    {data: 'select', name: 'select', orderable: false, searchable: false},
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'price', name: 'price'},
                    {data: 'description', name: 'description'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                bulk: {
                    enabled: true,
                    rowSelector: '.row-select',
                    masterSelector: '#select-all',
                    actionsSelector: '#bulk-actions',
                    ajaxUrl: '/api/items/bulk-action', // fallback url
                    paramName: 'ids',
                    // 👇 called every time selection changes
                    onSelectionChange: function (ids, count) {
                        $('#selected-count').text(count); // example badge update
                    }
                }
            })

            $('#add-product-btn').click(function () {
                form.reset();
                modal.open('Create New Product');
            });

            $('#productForm').on('submit', function (e) {
                e.preventDefault();
                var data = new FormData($('#productForm')[0]);
                $.easyAjax({
                    url: "{{ route('products.storeOrUpdate') }}",
                    container: '#productForm',
                    data: data,
                    onComplete: () => {
                        modal.close();
                        form.reset();
                        table.draw(false);
                    }
                })

            });

            $('body').on('click', '.editProduct', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                axios.get(route('products.edit', {product: id})).then((response) => {
                    form.fill(response.data);
                    modal.open('Edit Product');
                });
            });

            $('body').on('click', '.deleteProduct', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.easyDelete({
                    url: route('products.delete', {product: id}),
                    confirmationMessage: 'Do you really want to delete this product?',
                    onComplete: () => {
                        table.draw(false);
                    }
                })
            });

        });
    </script>
@endpush
