@extends('layouts.app')

@section('content')
    &nbsp;<br><br><br><br><br>
    <section class="vh-100 bg-image-vertical">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-6 text-black">
                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                        <form method="POST" action="{{ route('register') }}" style="width: 23rem;">
                            @csrf
                            <div class="form-outline mb-4">
                                <input type="text" id="nombre" name="nombre" class="form-control form-control-lg @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus placeholder="{{ __('Name') }}"/>
                                @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" id="apellidos" name="apellidos" class="form-control form-control-lg @error('apellidos') is-invalid @enderror" value="{{ old('apellidos') }}" required autocomplete="apellidos" autofocus placeholder="{{ __('Last Name') }}"/>
                                @error('apellidos')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-outline mb-4">
                                <input type="email" id="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Email') }}"/>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-outline mb-4">
                                <input type="date" id="fecha_nacim" name="fecha_nacim" class="form-control form-control-lg @error('fecha_nacim') is-invalid @enderror" value="{{ old('fecha_nacim') }}" required autocomplete="fecha_nacim" autofocus placeholder="{{ __('Birthdate') }}"/>
                                @error('fecha_nacim')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" required autocomplete="new-password" placeholder="{{ __('Password') }}"/>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="password-confirm" name="password_confirmation" class="form-control form-control-lg" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}"/>
                            </div>

                            <button class="cta">
                                <span>{{ __('Register') }}</span>
                                <svg width="13px" height="10px" viewBox="0 0 13 10">
                                    <path d="M1,5 L11,5"></path>
                                    <polyline points="8 1 12 5 8 9"></polyline>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="register.png" alt="Imagen de registro" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                </div>
            </div>
        </div>
    </section>
@endsection
