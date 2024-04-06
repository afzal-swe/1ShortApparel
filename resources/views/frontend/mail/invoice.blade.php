<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>

    <h1>Successfully Order Placed</h1><br>
    <strong>Order Id : {{ $order['order_id'] }}</strong>
    <strong>Order Date : {{ $order['date'] }}</strong>
    <strong>Total Amount : {{ $order['total'] }}</strong>
    <hr>
    <strong>Name : {{ $order['c_name'] }}</strong>
    <strong>Phone : {{ $order['c_phone'] }}</strong>
    <strong>Address : {{ $order['c_address'] }}</strong>
    
</body>
</html>