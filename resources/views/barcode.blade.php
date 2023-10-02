<!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Laravel 8 QR Code Demo - codeanddeploy.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    </head>

    <body>
        <div class="container mt-5">

            <h3>SCAN QR CODE FOR MORE LARAVEL TUTORIALS.</h3>

            <br><br>

            <div class="mb-3">{!! DNS2D::getBarcodeHTML("$link", 'QRCODE') !!}</div>
        </div>
        </div>
    </body>
</html>
