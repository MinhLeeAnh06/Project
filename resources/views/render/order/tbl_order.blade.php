<tr data-order-id="{{ $order->order_id }}">
    <td class="text-center">{{ $order->order_id }}</td>
    <td class="text-center">{{ $order->user_name }}</td>
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
    <td class="text-center">
        <div>
            <button class="btn btn-{{ $order->status >= 1 ? 'success' : 'primary' }} btn-approve-order btn-action" @if($order->status > 1) disabled @endif
                    data-url="{{ route('admin.order.update.status', ['orderId' => $order->order_id, 'status' => $order->status ? 0 : 1]) }}">
                {{ $order->status >= 1 ? 'Hủy xét duyệt' : 'Xét duyệt' }}</button>
            <button class="btn btn-{{ $order->status <= 1 ? 'primary' : 'success' }} btn-delivering btn-action"
                    data-url="{{ route('admin.order.update.status', ['orderId' => $order->order_id, 'status' => 2]) }}"
                    @if($order->status < 1 || $order->status == 3) disabled @endif>Giao hàng</button>
        </div>
        <div class="mt-2">
            <button class="btn btn-{{ $order->status <= 2 ? 'primary' : 'success' }} btn-delivering-success btn-action"
                    data-url="{{ route('admin.order.update.status', ['orderId' => $order->order_id, 'status' => 3]) }}"
                    @if($order->status <= 1 || $order->status == 3) disabled @endif>Giao hàng thành công</button>
        </div>
        <div class="mt-2">
            <a href="{{ route('admin.order.show', ['id' => $order->order_id]) }}" class="btn btn-warning">Xem đơn hàng</a>
            <a href="#" class="btn btn-danger">Xóa đơn hàng</a>
        </div>
    </td>
</tr>
