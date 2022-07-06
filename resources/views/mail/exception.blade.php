@extends('mail.master')

@section('title')
    <span class="text-error">
        An application exception has occurred!
    </span>
@endsection

@section('content')
    <div class="mb-3">
        <div class="font-bold">
            Application URL:
        </div>

        <a href="{{ config('app.url') }}" class="text-link">
            {{ config('app.url') }}
        </a>
    </div>

    <div class="mb-3">
        <div class="font-bold">
            Environment:
        </div>

        {{ config('app.env') }}
    </div>

    <div class="mb-3">
        <div class="font-bold">
            Exception:
        </div>

        <span class="text-error">
            {{ $exception['class'] }}
        </span>
    </div>

    <div class="mb-3">
        <div class="font-bold">
            Message:
        </div>

        {{ $exception['message'] }}
    </div>

    <div class="mb-3">
        <div class="font-bold">
            File:
        </div>

        {{ $exception['file'] }}

        <span class="font-semibold">
            ({{ $exception['line'] }})
        </span>
    </div>

    <div class="mb-3">
        <div class="font-bold">
            Occurred:
        </div>

        {{ now()->format('m/d/Y H:i:s P') }}
    </div>

    <div class="mt-8 mb-8">
        <div class="font-bold">
            Stack Trace:
        </div>

        <pre class="pl-5 pr-5 pt-3 pb-3 overflow-scroll rounded-md bg-pre"><!--
            -->{{ $exception['trace'] }}<!--
        --></pre>
    </div>
@endsection
