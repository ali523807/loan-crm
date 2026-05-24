<x-modal id="productModal" title="Create Product">
    <x-form id="productForm">
        <x-modal.body class="space-y-3">
            <input type="hidden" name="id" />
            <x-select id="category" name="category_id" label="Category" placeholder="Select Category">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </x-select>

            <x-input  name="name" label="Name" placeholder="Enter name"/>
            <x-input name="price" label="Price" type="number" placeholder="Enter Price"/>
            <x-textarea id="description" name="description" label="Description" placeholder="Enter description"/>
            <x-select id="status" name="active" label="Status" placeholder="Select Status">
                <option value="1">Active</option>
                <option value="0">In Active</option>
            </x-select>
        </x-modal.body>

        <x-modal.footer>
            <x-button color="light" data-bs-dismiss="modal">Cancel</x-button>
            <x-button color="dark" type="submit">Submit</x-button>
        </x-modal.footer>
    </x-form>
</x-modal>

<script type="module">
    onPageNavigated(() => {
        $('#status').jpSelect2();
        $('#category').jpSelect2();
        $('#description').jpEditor({
            placeholder: "Write your blog post..."
        });
    });
</script>
