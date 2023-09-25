<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>
<body class="antialiased">
    <p>Xin chào, {{$data["staff"]["staff_name"]}}</p>
    <p>Bạn vừa được giao một công việc mới <span style="font-weight:600">"{{$data['transaction']['transaction_name']}}"</span> vào lúc <span style="font-weight:600">{{ \Carbon\Carbon::parse($data["transaction"]["transaction_start_date"])->format('H:i Y-m-d') }}</span> và có thời hạn cuối cùng để hoàn thành là vào lúc <span style="font-weight:600">{{ \Carbon\Carbon::parse($data["transaction"]["transaction_deadline_date"])->format('H:i Y-m-d') }}</span></p>
</body>
</html>
