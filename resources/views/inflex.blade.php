@extends('layouts.app')

@section('content')
    <div class="container-fluid position-relative d-flex justify-content-center align-items-center vh-100">
        <div class="d-flex flex-column align-items-center">
            <button onclick="window.location='{{ route('registroDiarioSintomas') }}'" class="cta mb-3">
                <span>{{ __('Ir a registrar mis síntomas!') }}</span>
                <svg width="13px" height="10px" viewBox="0 0 13 10">
                    <path d="M1,5 L11,5"></path>
                    <polyline points="8 1 12 5 8 9"></polyline>
                </svg>
            </button>
            <button onclick="window.location='{{ route('registroDiarioEjercicio') }}'" class="cta">
                <span>{{ __('Ir a registrar ejercicio!') }}</span>
                <svg width="13px" height="10px" viewBox="0 0 13 10">
                    <path d="M1,5 L11,5"></path>
                    <polyline points="8 1 12 5 8 9"></polyline>
                </svg>
            </button>
        </div>
        <img src="SheFlowRegistrarSintomas.png" class="d-block ml-auto" style="width: 35%;" alt="...">
    </div>
@endsection
