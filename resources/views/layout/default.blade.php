<!DOCTYPE html>
<html>
<head>
    <head itemscope itemtype="http://schema.org/WebSite">
    <!-- Meta Begin -->
    <title itemprop='name'>Booking</title>
    <meta property="og:title" name="title" content="" />
    <meta property="og:description" name="description" content="" />
    <meta property="og:url" content="http://twentysixdigital.co.uk/" />
    <!-- Meta End -->

    <meta name="robots" content="Index, Follow" />
    <meta name="revisit-after" content="5" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- StyleSheets -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css?v=23" media="all" />

    <!-- External JavaScripts -->
    <script type="text/javascript" src="/js/modernizer.js"></script>
</head>
    <body class="svg">
        <div class="outer-wrapper">
            @include('layout.header')
            <div class="container">
                @yield('content')
            </div>
            @include('layout.footer')


            <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    </body>
</html>