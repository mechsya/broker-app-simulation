<body>
    <p>Hello {{ $recipient }}</p>
    <p>Click the link below to reset your password</p>
    <a href="{{ env('APP_URL') }}/auth/reset?email={{ $emailRecipient }}">
        click in here
    </a>
</body>
