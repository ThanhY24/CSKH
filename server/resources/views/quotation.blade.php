<!-- @php
  $imageName = $imageName; 
@endphp -->
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
  <p>Trung tâm kinh doanh của VNPT tại Cần Thơ trân trọng gửi đến quý khách báo giá sản phẩm, với tất cả thông tin chi tiết đã được nêu bên dưới! Chú quý khách một ngày tốt lành!</p>
  <p>{{asset('images/'.$imageName)}}</p>
  <img src="{{asset('images/'.$imageName)}}" alt="" >
  <!-- style="width:100px;height:100px;border:1px solid;" -->
</body>
</html>
