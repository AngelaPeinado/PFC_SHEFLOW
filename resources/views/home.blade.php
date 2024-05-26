@extends('layouts.app')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center vh-100">
        <div class="text-center">
            <h1>Bienvenida a SheFlow</h1>
            <br/>
            <p>Aunque más de 800 millones de personas en todo el mundo tienen su período en cualquier día dado, los períodos todavía pueden ser difíciles de hablar abiertamente. Es importante reconocer las señales de alerta cuando se trata de tu período y la salud uterina.</p>
            <p><strong>SheFlow está aquí para ayudarte a entenderlo todo mejor.</strong></p>
            <form action="{{ route('form.index') }}" method="get">
                <button type="submit" class="cta">
                    <span>{{ __('Start') }}</span>
                    <svg width="13px" height="10px" viewBox="0 0 13 10">
                        <path d="M1,5 L11,5"></path>
                        <polyline points="8 1 12 5 8 9"></polyline>
                    </svg>
                </button>
            </form>
        </div>
    </div>
@endsection
