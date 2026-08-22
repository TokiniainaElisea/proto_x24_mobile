@extends('layout')

@section('content')
    <div class="container p-2">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div class="d-flex align-items-center">

                <div class="rounded-3
                d-flex align-items-center justify-content-center me-3"
                    style="width: 48px; height: 48px;">

                    <i class="bi bi-bar-chart-line-fill text-primary fs-4"></i>

                </div>

                <div>

                    <h2 class="fw-bold mb-0">
                        Bilan
                    </h2>

                    <small class="text-muted">
                        Consultez les évolutions de votre activité
                    </small>

                </div>

            </div>

        </div>

        @include('bilan.parts.bilan_filter')
        <hr>
        @include('bilan.parts.bilan_home')
    </div>
@endsection
