<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Transaksi') }}</h1>
    </x-slot>

    <x-slot name="script">
        <script>
            function onScanSuccess(decodedText, decodedResult) {
                var audio = new Audio("{{ asset('media/beep.mp3') }}");
                audio.play();
                $("#product_code").val(decodedText);
                // alert("QR berhasil di scan");
                var data = { product_code : decodedText };
                $(function() {
                    $.ajax({
                        type: "get",
                        url: '/master/transaksi',
                        data: data,
                        success: function() {
                            console.log("Valueadded" + data.product_code);
                        }
                    })
                });
                
                window.location = "http://127.0.0.1:8000/master/transaksi?product_code=" + data.product_code;
            }

            function onScanFailure(error) {
                console.warn(`Code scan error = ${error}`);
            }

            let html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: {width: 250, height: 250} }, false);
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);


            $("#add").click(function() {$.ajax({
                    type: 'get',
                    url: '/master/transaksi/index',
                    data: {
                        // '_token': $('input[name=_token]').val(),
                        'product_code': $('input[name=product_code]').val()
                    },
                    success: function(data) {
                        if ((data.errors)) {
                            $('.error').removeClass('hidden');
                            $('.error').text(data.errors.name);
                        } else {
                            $('.error').remove();
                            alert("hai" + data.name);
                            
                        }
                    },
                });
                $('#product_code').val('');
            });

        </script>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <p>Scan Qr Code Disini</p>
                    </div>
                </div>

                <div class="card-body">

                    <form action="">
                        <div class="form-group row add">
                            <div class="col-md-4">
                                <input type="hidden" class="form-control" id="product_code"  placeholder="QR Code Product">
                                <input type="text" class="form-control" id="product_code" name="product_code" placeholder="QR Code Product">
                                <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary" type="submit btn" id="add"> Submmit </button>
                            </div>
                        </div>
                    </form>
                    
                    <div class="form-group row">
                        <div class="col-md-4">
                            <div id="reader"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table table-striped w-100">
            <thead>
                <tr>
                    <th class="text-center">Name Product</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Stock</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">Option</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($Products as $product)
                    <livewire:product-component :product='$product' />
                @endforeach
            </tbody>
        </table>
    </div>
    
    <livewire:cart-component />

</x-app-layout>
