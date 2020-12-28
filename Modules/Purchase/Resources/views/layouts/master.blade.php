<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>

        <style>
            body {
                font-family: sans-serif;
                width: 100%;
                height: 100%;;
            }
        </style>

       {{-- Laravel Mix - CSS File --}}
       {{-- <link rel="stylesheet" href="{{ mix('css/sale.css') }}"> --}}

    </head>
    <body>
        <div class='app-content'>
            @yield('content')
        </div>

        {{-- Laravel Mix - JS File --}}
        {{-- <script src="{{ mix('js/sale.js') }}"></script> --}}
    </body>
</html>
