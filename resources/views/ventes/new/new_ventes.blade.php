@extends('layout')

@section('content')
<div class="container">

<div class="d-flex justify-content-between align-items-center mb-4 my-2">

    <div>

        <h2 class="fw-bold mb-1">

            <i class="bi bi-cart-plus-fill text-success me-2"></i>
            Nouvelle vente

        </h2>
    </div>

    <a
        href="{{ route('ventes') }}"
        class="btn btn-outline-secondary">

        <i class="bi bi-arrow-left me-1"></i>
    </a>

</div>

<div class="card border-0 shadow-sm mb-4">

    <div class="card-body p-0">

        <livewire:order-page />

    </div>

</div>

</div>

@endsection