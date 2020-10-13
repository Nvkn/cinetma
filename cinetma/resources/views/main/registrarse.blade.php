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
    <form method="POST" action="{{ route('register') }}">
        @csrf
        {{-- Email --}}
        <input type="email" id="email" class="fadeIn input-estilo second @error('email') is-invalid @enderror" name="email" placeholder="E-mail" value="{{ old('email') }}" required autocomplete="email">

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        {{-- Nick --}}
        <input type="text" id="nick" class="fadeIn input-estilo second @error('nick') is-invalid @enderror" name="nick" placeholder="Alias" value="{{ old('nick') }}" required autocomplete="nick">

        @error('nick')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        {{-- Password --}}
        <input type="password" id="password" class="fadeIn third @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required autocomplete="new-password">

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        {{-- Confirm Password --}}
        <input type="password" id="password_confirmation" class="fadeIn third" name="password_confirmation" placeholder="Repita su contraseña" required autocomplete="new-password">

        {{-- Botón Registrarse --}}
        <input type="submit" class="fadeIn fourth" value="Registrarse">
    </form>

</div>
</div>


@endsection