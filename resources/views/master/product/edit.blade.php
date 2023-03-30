<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Product ') }}</h1>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"></div>
                @foreach($Product as $P)
                    <form action="{{ route('product.update', $P->product_id) }}" method="post">
                        @csrf
                        @method('PUT')

                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Product Code</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ old('product_code') ?? $P->id }}" name="product_code" id="product_code" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Product Category</label>
                            <div class="col-sm-9">
                                <select value="{{ old('product_category_id') }}" name="product_category_id" class="form-control">
                                    @foreach($ProductCategory as $PC)
                                        <option value="{{ $PC->product_category_id }}">{{ $PC->product_category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Product Name</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ old('product_name') ?? $P->product_name}}" name="product_name" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Product Stock</label>
                            <div class="col-sm-9">
                                <input type="number" value="{{ old('product_stock') ?? $P->product_stock}}" name="product_stock" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Product Price</label>
                            <div class="col-sm-9">
                                <input type="number" value="{{ old('product_price') ?? $P->product_price}}" name="product_price" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Product Desc</label>
                            <div class="col-sm-9">
                                <textarea name="product_desc" class="form-control">{!! old('product_desc') ?? $P->product_desc !!}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Expired Date</label>
                            <div class="col-sm-9">
                                <input type="date" value="{{ old('product_exp') ?? $P->product_exp}}" name="product_exp" class="form-control" required>
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