<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Create OTP</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .btn{
            padding: 20px;
            background-color: #1b4b72;
            color: white;
            border-radius: 5px;
            font-size: 2rem;
            cursor: pointer;
        }

    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <form method="post" action="{{route('otp.store')}}">
        <input type="submit" value="Request For OTP" class="btn">
    </form>
</div>
</body>
</html>
