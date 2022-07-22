@extends('layouts.error')

@section('title')
    HTTP 403
@endsection

@section('content')
    <p class="text-center">
        You don't have permission to access this resource.
    </p>

    <p class="mt-4 text-center">
        <a href="/" class="text-link">
            Click here to return home
            <i class="fa-solid fa-home fa-fw"></i>
        </a>
    </p>
@endsection
