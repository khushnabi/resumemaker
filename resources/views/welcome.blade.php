<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Mada&display=swap" rel="stylesheet">
        <script>
            (function() {
                window.Laravel = {
                    csrfToken:'{{ csrf_token() }}'
                };
            })();
        </script>

        <!-- Styles -->
        <style>
            body {
                background:#f1f1f1;
                font-family: 'Mada', sans-serif;
            }
        </style>
    </head>
    <body>

   <div id="root">
   </div>
       <script src="{!! asset('js/app.js') !!}"></script>
    </body>
</html>
