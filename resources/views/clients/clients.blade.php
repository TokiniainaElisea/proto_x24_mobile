@extends('layout')

@section('title', 'Liste des clients')

@section('content')
    <div class="container p-2">
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


            <div class="d-flex align-items-center">

                <div class=" bg-opacity-10 rounded-3
                d-flex align-items-center justify-content-center me-3"
                    style="width: 48px; height: 48px;">

                    <i class="bi bi-people-fill text-primary fs-4"></i>

                </div>

                <div>

                    <h2 class="fw-bold mb-0">
                        Gestion des clients
                    </h2>

                </div>

            </div>


            <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#new_client">

                <i class="bi bi-person-plus-fill me-1"></i>

            </button>

        </div>

        @include('clients.parts.search_client')
        @include('clients.parts.new_client_modal', [
            'id' => 'new_client',
        ])
        @include('clients.parts.list_clients')
    </div>
@endsection
