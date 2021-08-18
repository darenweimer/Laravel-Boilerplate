@extends('mail.master')

@section('title')
    <span class="text-danger">
        An application exception has occurred!
    </span>
@endsection

@section('content')
    <div class="mb-1">
        Application URL:

        <a class="text-link" href="{{ config('app.url') }}">
            {{ config('app.url') }}
        </a>
    </div>

    <div class="mb-1">
        Environment: {{ config('app.env') }}
    </div>

    <div class="mb-1">
        Exception:

        <span class="text-danger">
            {{ $exception['class'] }}
        </span>
    </div>

    <div class="mb-1">
        Message:

        <span class="text-danger">
            {{ $exception['message'] }}
        </span>
    </div>

    <div class="mb-1">
        File:

        <span class="text-danger">
            {{ $exception['file'] }}
        </span>

        on line

        <span class="text-danger">
            {{ $exception['line'] }}
        </span>
    </div>

    <div class="mb-1">
        Stack Trace:

        <pre class="bg-pre p-1 overflow-scroll"><!--
            -->{{ $exception['trace'] }}<!--
        --></pre>
    </div>
@endsection
