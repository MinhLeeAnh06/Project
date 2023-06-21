@forelse($productDetails as $productDetail)
    <tr class="text-center">
        <td>{{ $productDetail->productName }}</td>
        <td>{{ $productDetail->size }}</td>
        <td>{{ $productDetail->color }}</td>
        <td>{{ $productDetail->qty }}</td>
    </tr>
@empty
@endforelse
