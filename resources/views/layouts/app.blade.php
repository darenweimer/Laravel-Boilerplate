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

    @routes

    @vite('resources/js/app.js')

    @inertiaHead

    <script>
        if (!('theme' in localStorage)) {
            localStorage.theme = 'system';
        }

        if ((localStorage.theme === 'dark') || ((localStorage.theme === 'system') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>



<body class="bg-canvas font-default font-normal text-base text-default tracking-wide antialiased">
    @inertia
</body>



</html>
