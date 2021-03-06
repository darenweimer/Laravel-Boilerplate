@extends('layouts.error')

@section('title')
    HTTP 401
@endsection

@section('content')
    <p class="text-center">
        You must be authorized to access this resource.
    </p>

    <p class="mt-4 text-center">
        <a href="/" class="text-link">
            Click here to return home
            <i class="fa-solid fa-home fa-fw"></i>
        </a>
    </p>
@endsection
