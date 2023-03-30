<tr>
    <td>{{ $product->product_name }}</td>
    <td class="text-center">{{ $product->product_desc }}</td>
    <td class="text-center">Rp. {{ $product->product_price }}</td>
    <td class="text-center">{{ $product->product_stock }}</td>
    <td class="text-center"><input class="border-2 rounded" type="number" min="1" wire:model="quantity"></td>
    <td class="text-center">
        <button class="btn btn-primary" wire:click="addToCart">Add To Cart</button>
    </td>
</tr>