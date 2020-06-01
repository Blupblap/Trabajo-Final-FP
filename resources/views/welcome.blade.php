@extends('layouts.app')

@section('content')
<div>
    <h1 id="welcome_title" class="text-center mt-3"><b>{{ config('app.name', 'Laravel') }}</b></h1>
    <div class="container">
        <div id="welcome_login_div" class="d-flex justify-content-around">
            <a class="border border-dark rounded p-2" href="{{ route('login') }}">{{ __('Login') }}</a>
            <a class="border border-dark rounded p-2" href="{{ route('register') }}">{{ __('Register') }}</a>
        </div>
    </div>
</div>
@endsection