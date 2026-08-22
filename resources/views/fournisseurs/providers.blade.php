@extends('layout')

@section('title', 'Liste des fournisseurs')

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="card-body bg-success text-light">
                {{ session('success') }}
            </div>
        @endif
        @if (session('failure'))
            <div class="card-body bg-danger text-light">
                {{ session('failure') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-2 my-2">

            <div>

                <h2 class="fw-bold mb-1">
                    <i class="bi bi-truck text-primary me-2"></i>
                    Fournisseurs
                </h2>

            </div>

            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#new_provider">

                <i class="bi bi-plus-circle-fill me-1"></i>

            </button>

        </div>
        @include('fournisseurs.parts.provider_table')
        @include('fournisseurs.parts.new_provider', ['id' => 'new_provider'])
    </div>
@endsection
