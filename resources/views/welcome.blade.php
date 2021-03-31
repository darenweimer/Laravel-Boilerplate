@extends('app')

@section('content')
    <div style="text-align:center;">
        <div style="margin-top:4.00rem; margin-bottom:1.50rem; font-size:3.00rem;">
            Laravel Boilerplate
        </div>

        <div>
            Framework Version: {{ app()->version() }}
        </div>
    </div>
@endsection
