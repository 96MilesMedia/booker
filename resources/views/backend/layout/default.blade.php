<!DOCTYPE html>
<html>
<head>
    <head itemscope itemtype="http://schema.org/WebSite">
    <!-- Meta Begin -->
    <title itemprop='name'>Admin</title>
    <meta property="og:title" name="title" content="" />
    <meta property="og:description" name="description" content="" />
    <meta property="og:url" content="http://twentysixdigital.co.uk/" />
    <!-- Meta End -->

    <meta name="robots" content="No-Follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- StyleSheets -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="/css/backend/app.css?v=1" media="all" />
    <link rel="stylesheet" type="text/css" href="/css/pignose.calendar.css" media="all" />

    <!-- External JavaScripts -->
    <script type="text/javascript" src="/js/modernizer.js"></script>

    <meta name="csrf-token" content="{!! csrf_token() !!}">
</head>
    <body class="svg">
        <div class="mdl-layout mdl-js-layout">
            @include('backend.layout.header')
                <main class="mdl-layout__content">
                    <div class="page-content">

                        <div class="mdl-grid">
                            <div class="mdl-cell--1-col">

                            </div>
                            <div class="mdl-cell--10-col">
                                @yield('content')
                            </div>
                            <div class="mdl-cell-1-col">

                            </div>
                        </div>
                    </div>
                </main>
        </div>
        @include('backend.layout.footer')

        <!-- Generic Snack Bar HTML -->
        <div class="mdl-js-snackbar mdl-js-snackbar--success mdl-snackbar">
            <div class="mdl-snackbar__text"></div>
            <button class="mdl-snackbar__action" type="button"></button>
        </div>

        <!-- Generic JavaScript Libraries -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="/js/material.min.js"></script>

        <!-- Start: Date Picker Module Code -->
        <script type="text/javascript" src="/js/calander/bootstrap.min.js"></script>
        <script type="text/javascript" src="/js/calander/prism.min.js"></script>
        <script type="text/javascript" src="/js/calander/moment.min.js"></script>
        <script type="text/javascript" src="/js/calander/pignose.calendar.js"></script>

        <!-- Vue Components -->
        <script type="text/javascript" src="/js/vue.min.js"></script>
        <script src="https://cdn.jsdelivr.net/vue.resource/1.0.3/vue-resource.min.js"></script>
        <script type="text/javascript">
            Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
        </script>
        <script type="text/javascript" src="/js/components/booking-count.js"></script>

        @foreach ($scripts as $script)
            <script type="text/javascript" src="/js/{!! $script !!}"></script>
        @endforeach


        <script type="text/javascript">
            $('.input-calendar').pignoseCalendar({
                buttons: true,
                format: 'DD-MM-YYYY'
            });
        </script>
        <!-- End: Date Picker Module Code -->

        <!-- Snack Bar Implementation Code -->
        <script>
            var notification = document.querySelector('.mdl-js-snackbar');

            @if (session('success'))

            setTimeout(function () {
                notification.MaterialSnackbar.showSnackbar({
                    message: '{!! session('success') !!}'
                });
            }, 300);

            @endif
        </script>

        <dialog class="mdl-dialog">
            <h4 class="mdl-dialog__title">Attention!</h4>
            <div class="mdl-dialog__content">
                <p>Please confirm you wish to proceed with the selected action as it may not be reversable.</p>
            </div>
            <div class="mdl-dialog__actions">
                <button type="button" class="mdl-button agree">Confirm</button>
                <button type="button" class="mdl-button close">Cancel</button>
            </div>
        </dialog>
    </body>
</html>