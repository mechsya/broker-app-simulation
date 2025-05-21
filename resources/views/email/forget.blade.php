<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <p>Hello {{ $recipient }}</p>
    <p>Click the link below to reset your password</p>
    <a href="{{ env('APP_URL') }}/auth/reset?email={{ $emailRecipient }}">
        click in here
    </a>
</body>

</html>
