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
        <form method="POST"  action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            {{-- E-mail --}}
            <input type="email" id="email" class="fadeIn first input-estilo @error('email') is-invalid @enderror" name="email" placeholder="E-mail" value="{{ $email ?? old('email') }}" required focus>

            {{-- Contraseña --}}
            <input id="password" type="password" class="fadeIn second input-estilo @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Contraseña">


            {{-- Confirmar contraseña --}}
            <input id="password-confirm" type="password" class="fadeIn third input-estilo" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar contraseña">


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
            <input type="submit" class="fadeIn fourth mt-2 mb-4" value="Cambiar contraseña">
        </form>

    </div>
</div>


@endsection