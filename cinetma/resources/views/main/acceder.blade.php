@extends('layouts.main')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/auth.css') }}">
@endsection


@section('content')

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
            <h1 class="pb-2 pt-4">Cinetma</h1>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- E-mail --}}
            <input type="email" id="email" class="fadeIn second input-estilo @error('email') is-invalid @enderror" name="email" placeholder="E-mail" value="{{ old('email') }}" required autocomplete="email">

            {{-- Contraseña --}}
            <input type="password" id="password" class="fadeIn third @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required autocomplete="current-password">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            {{-- Botón --}}
            <input type="submit" class="fadeIn fourth mt-2 mb-4" value="Log In">
        </form>

        <!-- Remind Passowrd -->

        @if (Route::has('password.request'))
        <div id="formFooter">
            <a class="underlineHover" href="{{ route('password.request') }}">¿Has olvidado la contraseña?</a>
        </div>
        @endif

    </div>
</div>


@endsection