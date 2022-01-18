@extends('layouts.error')

@section('title')
    HTTP 419
@endsection

@section('content')
    <p class="text-center">
        Your session has expired. Please log in again.
    </p>

    <p class="mt-4 text-center">
        <a href="/" class="text-link">
            <i class="fas fa-home"></i>
            Click here to return home
        </a>
    </p>
@endsection
