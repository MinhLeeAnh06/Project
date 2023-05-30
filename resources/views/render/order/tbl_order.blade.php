<tr>
    <td class="text-center">{{ $order->order_id }}</td>
    <td class="text-center">{{ $order->user_name }}</td>
    <td class="text-center">{{ $order->amount }}</td>
    <td class="text-center">{{ $order->total }}</td>
    <td class="text-center">{{ $order->payment_type ? 'onl' : 'off' }}</td>
    <td class="text-center">
        <button class="btn btn-{{ $order->status ? 'success' : 'danger' }} @if(!$order->payment_type) btn-approve-order @endif"
                data-order-id="{{ $order->order_id }}"
                data-url="{{ route('admin.order.update.status', ['status' => $order->status, 'orderId' => $order->order_id]) }}">
            {{ $order->status ? 'Đã xét duyệt' : 'Chưa xét duyệt' }}</button>
    </td>
    <td class="text-center">
        <a href="{{ route('admin.order.show', ['id' => $order->order_id]) }}" class="btn btn-warning">Show</a>
        <a href="#" class="btn btn-danger">Delete</a>
    </td>
</tr>
