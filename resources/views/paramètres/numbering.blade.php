@extends('layout')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center mb-2 my-2">

            <div class=" bg-opacity-10 rounded-3
                    d-flex align-items-center justify-content-center me-3"
                style="width: 48px; height: 48px;">

                <i class="bi bi-123 text-primary fs-4"></i>

            </div>

            <div>

                <h2 class="fw-bold mb-0">
                    Numérotation
                </h2>

                <small class="text-muted">
                    Personnalisez les préfixes utilisés par l'application
                </small>

            </div>

        </div>

        <livewire:numbering-page />
    </div>
@endsection
