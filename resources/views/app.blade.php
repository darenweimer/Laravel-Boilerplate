<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">



<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <title>
        {{ config('app.name') }}
    </title>

    <link href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"/>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet"/>

    <script src="{{ mix('js/app.js') }}" defer></script>
</head>



<body class="bg-primary font-primary font-normal text-base text-primary tracking-wide">
    @routes
    @inertia
</body>



</html>
