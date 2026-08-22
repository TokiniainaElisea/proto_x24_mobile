@extends('layout')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="card-body bg-success text-light">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center mb-2 my-2">

            <div>

                <h2 class="fw-bold mb-1 my-2">
                    <i class="bi bi-cart-check-fill text-primary me-2"></i>
                    Ventes
                </h2>

            </div>

            <a href="{{ route('new_vente') }}" class="btn btn-success">

                <i class="bi bi-plus-circle-fill me-1"></i>

            </a>

        </div>
        @include('ventes.parts.filter')
        @include('ventes.parts.liste_ventes')
    </div>
@endsection
