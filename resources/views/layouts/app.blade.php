<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">



<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <title>
        {{ config('app.name') }}
    </title>

    <link href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Display:wght@250;375;550;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@250;375;550;700;900&display=swap" rel="stylesheet"/>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet"/>

    <script src="{{ mix('js/app.js') }}" defer></script>
</head>



<body class="bg-canvas font-default font-normal text-base text-default tracking-wide antialiased">
    @routes
    @inertia
</body>



</html>
