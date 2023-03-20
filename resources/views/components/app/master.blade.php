    <!-- Basic Page Needs -->
    <meta charset="utf-8">

    <!-- Metas -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="author" content="ED">
    @if (config('app.env') == 'production')
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endif
    <meta name="asd" content="{{ csrf_token() }}">

    <title>PSS</title>
    <meta name="description" content="">
    <meta name="keywords" content="" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="" />
    <meta property="og:url" content="" />
    <meta property="og:title" content="PSS" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="" />
    <meta name="twitter:card" content="photo" />
    <meta property="twitter:url" content="" />
    <meta name="twitter:title" content="PSS" />
    <meta name="twitter:image" content="" />
    <meta property="twitter:description" content="" />

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ config('app.url') }}/images/logo.png" />


    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name=asd]').attr('content')
            }
        });
    </script>
