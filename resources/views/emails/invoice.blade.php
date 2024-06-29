<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
</head>
<body>
<h1>Invoice</h1>
<p>User name: {{$user->name}}</p>
<p>Order ID: {{ $order->id }}</p>
<p>Transaction ID: {{ $order->transaction_id }}</p>
<p>Payment Method: {{ $order->payment_method }}</p>
<p>Order Status: {{ $order->order_status }}</p>
<p>Address: {{ $order->shipping_address }}</p>
<p>City: {{ $order->shipping_city }}</p>
{{--<p>Roles: {{ $order->roles }}</p>--}}
<!-- Add more details as necessary -->

<h2>Products</h2>
<table border="1" cellpadding="10" cellspacing="0">
    <thead>
    <tr>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->product_price }}</td>
            <td>{{ $product->quantity * $product->product_price }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
