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

    @include('mail.master-styles')
</head>



<body class="bg-default font-default font-normal text-base text-default tracking-wide antialiased">
    <div class="mt-4 mb-4 font-black text-3xl text-center">
        {{ config('app.name') }}
    </div>

    <div class="mb-10 font-bold text-xl text-center">
        @yield('title')
    </div>

    @yield('content')
</body>



</html>
