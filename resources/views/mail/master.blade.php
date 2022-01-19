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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;700;900&display=swap" rel="stylesheet"/>

    <style>
        .font-normal {
            font-family: 'Roboto';
            font-size: 1.00rem;
            font-weight: 400;
        }

        .font-title {
            font-family: 'Armata';
            font-size: 1.50rem;
            font-weight: 400;
        }

        .text-normal {
            color: #333;
        }

        .text-link {
            color: #0ad;
            text-decoration: none;
        }

        .text-success {
            color: #0a0;
        }

        .text-error {
            color: #c00;
        }

        .text-center {
            text-align: center;
        }

        .bg-pre {
            background-color: #ddd;
        }

        .mb-1 {
            margin-bottom: 0.75rem;
        }

        .mb-2 {
            margin-bottom: 2.50rem;
        }

        .p-1 {
            padding: 1.00rem;
        }

        .overflow-scroll {
            overflow: scroll;
        }
    </style>
</head>



<body class="font-normal text-normal p-1">
    <div class="font-title text-center mb-2">
        {{ config('app.name') }}: @yield('title')
    </div>

    @yield('content')
</body>



</html>
