@extends('layouts.error')

@section('title')
    HTTP 404
@endsection

@section('content')
    <p class="text-center">
        The requested page could not be found.
    </p>

    <p class="mt-4 text-center">
        <a href="/" class="text-link">
            <i class="fa-solid fa-home"></i>
            Click here to return home
        </a>
    </p>
@endsection
