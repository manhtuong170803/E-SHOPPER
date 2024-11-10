
    <h2>Xin chào {{ $orderData['user']['name'] }}, cảm ơn bạn đã đặt hàng!</h2>
    <p>Thông tin đơn hàng của bạn:</p>

    <table>
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng cộng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orderData['cart'] as $product)
            <tr>
                <td>{{ $product['name'] }}</td>
                <td>${{ $product['price'] }}</td>
                <td style="text-align: center;">{{ $product['quantity'] }}</td>
                <td>${{ $product['price'] * $product['quantity'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        <p>Phí ship: ${{ $orderData['ship'] }}</p> 
        <p>Tổng thanh toán: ${{ $orderData['total'] }}</p>
        <p>Chúng tôi sẽ liên hệ với bạn sớm nhất để xác nhận đơn hàng.</p>
    </div>
   
