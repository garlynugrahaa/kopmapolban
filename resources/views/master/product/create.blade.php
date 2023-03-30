<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Product') }}</h1>
    </x-slot>

    <x-slot name="script">
        <script>
            CKEDITOR.replace('product_desc');
        </script>

        <script>
            function onScanSuccess(decodedText, decodedResult) {
                var audio = new Audio("{{ asset('media/beep.mp3') }}");
                audio.play();
                $("#product_code").val(decodedText);
                window.location.href = "/product/check/" + decodedText;
                html5QrcodeScanner.clear();
                html5QrcodeScanner.stop();
            }

            function onScanFailure(error) {
                console.warn(`Code scan error = ${error}`);
            }

            let html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: {width: 250, height: 250} }, false);
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        </script>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div id="reader" class="col-sm-6"></div>
                    </div>
                </div>
                <form action="{{ route('product.store') }}" method="post">
                    @csrf

                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Product Code</label>
                            <div class="col-sm-9">
                                <input type="number" value="{{ old('product_code') ?? Session::get('success')}}" name="product_code" id="product_code" class="form-control" required>
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
                                <input type="text" value="{{ old('product_name') }}" name="product_name" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Product Stock</label>
                            <div class="col-sm-9">
                                <input type="number" value="{{ old('product_stock') }}" name="product_stock" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Product Price</label>
                            <div class="col-sm-9">
                                <input type="number" value="{{ old('product_price') }}" name="product_price" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Product Desc</label>
                            <div class="col-sm-9">
                                <textarea name="product_desc" class="form-control">{!! old('product_desc') !!}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Expired Date</label>
                            <div class="col-sm-9">
                                <input type="date" value="{{ old('product_exp') }}" name="product_exp" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>