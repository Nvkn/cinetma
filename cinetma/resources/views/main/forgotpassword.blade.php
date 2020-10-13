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
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            {{-- E-mail --}}
            <input type="email" id="email" class="fadeIn second input-estilo @error('email') is-invalid @enderror" name="email" placeholder="E-mail" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            {{-- Botón --}}
            <input type="submit" class="fadeIn fourth mt-2 mb-4" value="Enviar email">
        </form>

    </div>
</div>


@endsection