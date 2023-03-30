<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Product Category') }}</h1>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"></div>
                @foreach($ProductCategory as $PC)
                    <form action="{{ route('product-category.update', $PC->product_category_id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Category Name</label>
                                <div class="col-sm-9">
                                    <input type="text" value="{{ old('product_category_name') ?? $PC->product_category_name }}" name="product_category_name" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>