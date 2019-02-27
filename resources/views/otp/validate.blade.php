<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Validate OTP</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

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

        .container {
            max-width: 600px;
            margin: 20px auto;
        }

    </style>
</head>
<body>
<div class="container">
    <h2>Validate your One Time Password</h2>

    @isset($callId)
        <div class="alert alert-info alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            Call with ID {{$callId}} has been made to your authorised phone number.
        </div>
     @endisset

    <form method="post" action="{{route('otp.validate')}}">
        @csrf
        <div class="form-group">
            <input type="number" name="otpCode" placeholder="Enter the OTP provided to you" class="form-control" required>
        </div>

        <input type="submit" value="Validate OTP" class="btn btn-success">
    </form>
</div>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>
