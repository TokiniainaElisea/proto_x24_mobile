@extends('layout')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="card-body bg-success text-light">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center my-2 mb-2">

            <div class="d-flex align-items-center">

                <div class=" bg-opacity-10 rounded-3
                        d-flex align-items-center justify-content-center me-3"
                    style="width: 48px; height: 48px;">

                    <i class="bi bi-building-fill text-primary fs-4"></i>

                </div>

                <div>

                    <h2 class="fw-bold mb-0">
                        Société
                    </h2>

                    <small class="text-muted">
                        Gérez les informations de votre entreprise
                    </small>

                </div>

            </div>

        </div>

        <livewire:company-page />
    </div>
@endsection
