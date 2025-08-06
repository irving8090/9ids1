@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #0d1b2a, #1b263b);
        color: #ffffff;
    }
    .card {
        background-color: #1e3d59;
        border: none;
        border-radius: 1rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
    }
    .card-header {
        background-color: #0077b6;
        color: #ffffff;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
    }
    .card-body {
        background-color: #1e3d59;
        border-bottom-left-radius: 1rem;
        border-bottom-right-radius: 1rem;
    }
    .alert-success {
        background-color: #4bbf73;
        color: #ffffff;
        border: none;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-white">
                <div class="card-header text-center">
                    <h4 class="mb-0">{{ __('Panel del Club de Natación') }}</h4>
                </div>

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <img src="https://cdn-icons-png.flaticon.com/512/2164/2164900.png" alt="Natación" width="80" class="mb-4">

                    <h5 class="fw-bold">{{ __('¡Bienvenido al sistema del club!') }}</h5>
                    <p class="text-muted">Tu acceso fue exitoso. Explora las clases, membresías y más.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
