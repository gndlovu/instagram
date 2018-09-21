<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Instagram Photos</title>

        <!-- Styles -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/toastr.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css">

        @stack('style')
    </head>
    <body>
        
        <div class="container mt-4">
            @yield('content')
        </div>

        <!-- SCRIPTS -->
        <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
        <script src="{{ asset('js/toastr.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>

        @stack('scripts')

        @if(Session::has('flash_error'))

            <script type="text/javascript">
                notify('error', '{!! Session::get('flash_error') !!}', '', 0);
            </script>

        @endif

    </body>
</html>
