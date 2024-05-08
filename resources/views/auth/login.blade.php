@extends('layouts.app')

@section('content')
    &nbsp;<br><br><br><br><br>
    <section class="vh-100 bg-image-vertical">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-6 text-black">
                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                        <form method="POST" action="{{ route('login') }}" style="width: 23rem;">
                            @csrf

                            <div class="form-outline mb-4">
                                <input type="email" id="email" name="email"
                                       class="form-control form-control-lg @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" required autocomplete="email" autofocus
                                       placeholder="{{ __('Email Address') }}"/>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="password" name="password"
                                       class="form-control form-control-lg @error('password') is-invalid @enderror"
                                       required autocomplete="current-password"
                                       placeholder="{{ __('Password') }}"/>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                                    </div>
                                </div>
                            </div>

                            <button class="cta">
                                <span>{{ __('Login') }}</span>
                                <svg width="13px" height="10px" viewBox="0 0 13 10">
                                    <path d="M1,5 L11,5"></path>
                                    <polyline points="8 1 12 5 8 9"></polyline>
                                </svg>
                            </button>
                        </form>
                    </div>
                    <!-- Enlaces para restablecer contraseña y registrarse -->
                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                        <p class="small mb-2">
                            <a class="text-muted" href="#!">{{ __('Forgot Your Password?') }}</a>
                        </p>
                    </div>
                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="login.png"
                         alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                </div>
            </div>
        </div>
    </section>
@endsection

