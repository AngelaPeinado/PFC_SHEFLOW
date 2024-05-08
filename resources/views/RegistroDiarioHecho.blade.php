@extends('layouts.app')

@section('content')
    <div class="container-fluid position-relative d-flex flex-column justify-content-center align-items-center vh-100" style="margin-top: 20px;">
        <div class="position-absolute top-90 start-50 translate-middle" style="margin-top: 165px;">
            <button onclick="window.location='{{ route('estadisticas') }}'" class="cta">
                <span>{{ __('Ver estadísticas') }}</span>
                <svg width="13px" height="10px" viewBox="0 0 13 10">
                    <path d="M1,5 L11,5"></path>
                    <polyline points="8 1 12 5 8 9"></polyline>
                </svg>
            </button>
        </div>
        <img src="SheFlowRegistroDiarioHecho.png" class="d-block mx-auto mt-5" style="width: 70%;" alt="...">
    </div>
@endsection
