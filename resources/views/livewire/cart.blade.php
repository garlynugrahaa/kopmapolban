<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-2">
                        <p>Cart List</p> 
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-danger" wire:click="clearCart"><span class="fas fa-trash"></span> Clear Cart</button>
                        @if ($content->count() > 0)
                            <button class="btn btn-primary" wire:click="CheckOut"><span class="fa fa-check"></span> Checkout</button>
                        @endif   
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Name Product</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                            ?>
                            @if ($content->count() > 0)
                                @foreach ($content as $id => $item)
                                <tr>
                                    <td class="text-center">{{ $no++; }}</td>
                                    <td>{{ $item->get('name') }}</td>
                                    <td class="text-center">{{ $item->get('quantity') }}</td>
                                    <td class="text-center">Rp. {{ $item->get('price') }}</td>
                                    <td class="text-center">
                                        <button class="ml-2 btn btn-warning" wire:click="updateCartItem({{ $id }}, 'minus')"><span class="fa fa-minus"></span></button>
                                        <button class="ml-2 btn btn-warning" wire:click="updateCartItem({{ $id }}, 'plus')"><span class="fa fa-plus"></span></button>
                                        <button class="ml-2 btn btn-danger" wire:click="removeFromCart({{ $id }})"><span class="fas fa-trash"></span></button>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="5">cart is empty!</td>
                                </tr>                            
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="text-right" colspan="3"><b>Total</b></td>
                                <td class="text-center"> <b>Rp. {{ $total }}</b></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>