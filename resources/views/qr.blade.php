<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>QR Code للموقع</title>
</head>

<body style="text-align:center; margin-top:50px;">
    <h2>امسح الكود لزيارة موقعنا</h2>
    {!! QrCode::size(250)->generate($url) !!}
    <p>{{ $url }}</p>
</body>

</html>
