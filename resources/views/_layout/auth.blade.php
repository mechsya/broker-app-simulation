<!DOCTYPE html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <!-- Primary Meta Tags -->
    <title>King Trade Investment</title>
    <link rel="icon" type="image/png" href="{{ asset('') }}favicon.png">
    <meta name="title" content="{{ env('APP_NAME') }}" />
    <meta name="description"
        content="Discover top investment solutions with {{ env('APP_NAME') }}, a leading broker offering secure, fast, and easy trading services. Join now to start your investment journey with expert support and advanced technology" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ env('APP_URL') }}" />
    <meta property="og:title" content="{{ env('APP_NAME') }}" />
    <meta property="og:description"
        content="Discover top investment solutions with {{ env('APP_NAME') }}, a leading broker offering secure, fast, and easy trading services. Join now to start your investment journey with expert support and advanced technology" />
    <meta property="og:image" content="{{ asset('') }}thumbnail.png" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{ env('APP_URL') }}" />
    <meta property="twitter:title" content="{{ env('APP_NAME') }}" />
    <meta property="twitter:description"
        content="Discover top investment solutions with {{ env('APP_NAME') }}, a leading broker offering secure, fast, and easy trading services. Join now to start your investment journey with expert support and advanced technology" />
    <meta property="twitter:image" content="{{ asset('') }}thumbnail.png" />

    <!-- Meta Tags Generated with https://metatags.io -->
    <link href="{{ asset('') }}landing-page/images/banner/favicon_cca1b9442d3fee8271ec1d949c711916.png"
        rel="SHORTCUT ICON" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('') }}login/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('') }}login/css/fontawesome-all.min.css" />
    <link rel="stylesheet" href="{{ asset('') }}login/font/flaticon.css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('') }}login/style.css" />
</head>

<body
    style="background-image: url(https://rivankurniawan.com/images/background_login_page2.jpg); background-repeat: no-repeat; background-size: cover">
    @yield('content')

    <script src="{{ asset('') }}login/js/jquery-3.5.0.min.js"></script>
    <script src="{{ asset('') }}login/js/popper.min.js"></script>
    <script src="{{ asset('') }}login/js/bootstrap.min.js"></script>
    <script src="{{ asset('') }}login/js/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('') }}login/js/particles.js"></script>
    <script src="{{ asset('') }}login/js/particles-1.js"></script>
    <script src="{{ asset('') }}login/js/validator.min.js"></script>
    <script src="{{ asset('') }}login/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('') }}login/script.js"></script>
    @yield('javascript')
</body>

</html>
