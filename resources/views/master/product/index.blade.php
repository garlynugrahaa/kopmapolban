<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Product') }}</h1>
    </x-slot>

    <x-slot name="script">
        <script>
            const formatCurrency = (value) => {
                const formatter = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                });
                return formatter.format(value);
            };

            var datatable = $('#crudProduct').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! url()->current() !!}'
                },
                columns: [
                    {data: 'no', name: 'no', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                    }, width: '5%', class: 'text-center'},
                    { data: 'id', name: 'id', width: '10%'},
                    { data: 'product_name', name: 'product_name'},
                    { data: 'product_price', name: 'product_price', width: '10%', class: 'text-center'},
                    { data: 'product_stock', name: 'product_stock', width: '10%', class: 'text-center'},
                    { data: 'product_category_name', name: 'product_category_name', class: 'text-center', width: '10%'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true,
                        width: '15%',
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
                        <a href="{{ route('product.create') }}" class="shadow-none btn btn-primary">
                            <span class="fas fa-plus"></span> Create / Add Stock
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="crudProduct" class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Code</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Stock</th>
                                    <th class="text-center">Category</th>
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