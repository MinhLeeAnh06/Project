<tr data-order-id="{{ $order->order_id }}" style="@if($order->status == 4) background-color: #afabab @endif">
    <td class="text-center">{{ $order->order_id }}</td>
    <td class="text-center">{{ $order->amount }}</td>
    <td class="text-center">{{ number_format($order->total). ' VND' }}</td>
    @if($order->payment_type)
        <td class="text-left">
            <ul>
                <li>Ngân hàng: {{ $order->payment->vnp_BankCode }}</li>
                <li>Mã thanh toán: {{ $order->payment->vnp_TransactionNo }}</li>
                <li>Tổng tiền: {{ number_format($order->payment->vnp_Amount). ' VND' }}</li>
                <li>Thời gian: {{ $order->payment->created_at }}</li>
            </ul>
        </td>
    @else
        <td class="text-left">Thanh toán sau khi nhận hàng</td>
    @endif
    <td class="text-center text-status">{{ getStatusOrder($order->status) }}</td>
    <td class="text-center">{{ $order->created_at }}</td>
    <td class="text-center">
        <div class="mt-2">
            <a href="{{ route('user.show.order', ['orderId' => $order->order_id]) }}" class="btn btn-warning mb-2">Xem đơn hàng</a>
            <button class="btn btn-danger btn-cancel-order"
                    data-url="{{ route('user.cancel.order', ['orderId' => $order->order_id, 'status' => 4]) }}"
                    @if($order->status >= 2) disabled @endif>Hủy đơn hàng</button>
        </div>
    </td>
</tr>
