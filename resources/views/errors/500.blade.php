@extends('layouts.error')

@section('title')
    HTTP 500
@endsection

@section('content')
    <p class="text-center">
        The application has encountered an error.
    </p>

    <p class="mt-4 text-center">
        <a href="/" class="text-link">
            Click here to return home
            <i class="fa-solid fa-home fa-fw"></i>
        </a>
    </p>
@endsection
