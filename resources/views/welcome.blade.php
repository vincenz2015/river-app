<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <link rel="stylesheet" href="/css/app.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;700&display=swap" rel="stylesheet">

    </head>
    <body>
            <div id="app">
            </div>
            <script src="{{ mix('js/app.js') }}"></script>
        </body>
</html>
