<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Add Product Stock ') }}</h1>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"></div>
                @foreach($Product as $P)
                    <form action="/product/add_stock" method="post">
                        @csrf
                        @method('POST')

                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Product Code</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ old('product_code') ?? $P->id }}" name="product_code" id="product_code" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Product Name</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ old('product_name') ?? $P->product_name}}" name="product_name" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Add Stock</label>
                            <div class="col-sm-9">
                                <input type="hidden" value="{{ old('product_stock') ?? $P->product_stock}}" name="product_stock">
                                <input type="number" value="{{ old('add_stock') ?? 1}}" name="add_stock" class="form-control" required>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                @endforeach
            </form>
        </div>
    </div>
</div>
</x-app-layout>