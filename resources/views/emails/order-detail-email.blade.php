<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>جز ئیات سفارش</title>
    <style>
        .container {
            margin: 0 auto 0 auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .my {
            margin: 20px 0 20px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="item"><h2> کاربر محترم : {{ $user->name }}</h2></div>
    <div class="item"><h3>جزئیات سفارش شماره {{ $order->id }}</h3></div>
    <div class="item my">
        <ul>
            @foreach($order->products as $item)
                <li>{{ $item->title }}</li>
            @endforeach
        </ul>

    </div>
</div>

</body>
</html>
