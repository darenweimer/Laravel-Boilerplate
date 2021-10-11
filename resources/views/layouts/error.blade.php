<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">



<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <title>
        {{ config('app.name') }}
    </title>

    <link href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Armata:wght@400&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"/>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet"/>

    <script src="{{ mix('js/app.js') }}" defer></script>
</head>



<body class="bg-default font-default font-normal text-base text-default tracking-wide">
    <div class="flex flex-cols h-screen content-center items-center">
        <div class="w-full max-w-lg m-auto">
            <div class="font-title font-medium text-4xl text-center tracking-widest">
                @yield('title')
            </div>

            <div class="mt-4 text-lg text-justify">
                @yield('content')
            </div>
        </div>
    </div>
</body>



</html>