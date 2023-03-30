<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Product Category') }}</h1>
    </x-slot>

    <x-slot name="script">
        <script>
            var datatable = $('#crudProductCategory').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! url()->current() !!}'
                },
                columns: [
                    {data: 'no', name: 'no', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                    }, width: '5%', class: 'text-center'},
                    { data: 'product_category_name', name: 'product_category_name'},
                    {
                        data: 'action',
                        name: 'action',
                        width: '15%',
                        orderable: false,
                        searchable: false,
                    }
                ]
            })
        </script>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="flex pb-4 -ml-3">
                        <a href="{{ route('product-category.create') }}" class="btn btn-primary shadow-none">
                            <span class="fas fa-plus"></span> Create
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="crudProductCategory" class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Category Name</th>
                                    <th class="text-center">Option</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>