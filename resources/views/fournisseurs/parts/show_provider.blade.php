@extends('layout')

@section('content')
    <div class="container p-2">

        {{-- En-tête --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div class="d-flex align-items-center">

                <div class=" rounded-3
                        d-flex align-items-center justify-content-center me-3"
                    style="width: 52px; height: 52px;">

                    <i class="bi bi-truck text-primary fs-3"></i>

                </div>

                <div>

                    <h2 class="fw-bold mb-0">
                        {{ $provider->name_provider }}
                    </h2>

                    <small class="text-muted">
                        Fiche fournisseur
                    </small>

                </div>

            </div>


            <div class="d-flex gap-2">

                <a href="{{ route('provider') }}" class="btn btn-outline-secondary">

                    <i class="bi bi-arrow-left me-1"></i>

                </a>

                <a href="{{ route('edit_provider', $provider) }}" class="btn btn-primary">

                    <i class="bi bi-pencil-fill me-1"></i>

                </a>

            </div>

        </div>


        {{-- Informations principales --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-dark text-white">

                <h5 class="mb-0">

                    <i class="bi bi-building-fill me-2"></i>
                    Informations du fournisseur

                </h5>

            </div>


            <div class="card-body">

                <div class="row g-4">

                    {{-- Nom fournisseur --}}
                    <div class="col-md-6">

                        <div class="text-muted small mb-1">

                            <i class="bi bi-building me-1 text-primary"></i>
                            Fournisseur

                        </div>

                        <div class="fw-semibold fs-5">

                            {{ $provider->name_provider }}

                        </div>

                    </div>


                    {{-- Contact --}}
                    <div class="col-md-6">

                        <div class="text-muted small mb-1">

                            <i class="bi bi-person-fill me-1 text-success"></i>
                            Personne à contacter

                        </div>

                        <div class="fw-semibold fs-5">

                            {{ $provider->name_contact ?: 'Non renseigné' }}

                        </div>

                    </div>


                    {{-- Email --}}
                    <div class="col-md-6">

                        <div class="text-muted small mb-1">

                            <i class="bi bi-envelope-fill me-1 text-danger"></i>
                            Adresse e-mail

                        </div>

                        @if ($provider->mail)
                            <a href="mailto:{{ $provider->mail }}" class="text-decoration-none fw-semibold">

                                {{ $provider->mail }}

                            </a>
                        @else
                            <span class="text-muted">
                                Non renseignée
                            </span>
                        @endif

                    </div>


                    {{-- Téléphone --}}
                    <div class="col-md-6">

                        <div class="text-muted small mb-1">

                            <i class="bi bi-telephone-fill me-1 text-success"></i>
                            Téléphone

                        </div>

                        @if ($provider->phone)
                            <a href="tel:{{ $provider->phone }}" class="text-decoration-none fw-semibold">

                                {{ $provider->phone }}

                            </a>
                        @else
                            <span class="text-muted">
                                Non renseigné
                            </span>
                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- Localisation --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-dark text-white">

                <h5 class="mb-0">

                    <i class="bi bi-geo-alt-fill me-2"></i>
                    Localisation

                </h5>

            </div>


            <div class="card-body">

                <div class="row g-4">

                    {{-- Adresse --}}
                    <div class="col-md-8">

                        <div class="text-muted small mb-1">

                            <i class="bi bi-signpost-fill me-1 text-danger"></i>
                            Adresse

                        </div>

                        <div class="fw-semibold">

                            {{ $provider->adress ?: 'Non renseignée' }}

                        </div>

                    </div>


                    {{-- Ville --}}
                    <div class="col-md-4">

                        <div class="text-muted small mb-1">

                            <i class="bi bi-buildings-fill me-1 text-primary"></i>
                            Ville

                        </div>

                        <div class="fw-semibold">

                            {{ $provider->town ?: 'Non renseignée' }}

                        </div>

                    </div>


                    {{-- Pays --}}
                    <div class="col-md-4">

                        <div class="text-muted small mb-1">

                            <i class="bi bi-globe-americas me-1 text-info"></i>
                            Pays

                        </div>

                        <div class="fw-semibold">

                            {{ $provider->pays ?: 'Non renseigné' }}

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Note --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-dark text-white">

                <h5 class="mb-0">

                    <i class="bi bi-sticky-fill me-2"></i>
                    Note

                </h5>

            </div>


            <div class="card-body">

                @if ($provider->note)
                    <div class="bg-light rounded-3 p-3">

                        <i class="bi bi-chat-left-text-fill text-primary me-2"></i>

                        {{ $provider->note }}

                    </div>
                @else
                    <div class="text-muted text-center py-3">

                        <i class="bi bi-journal-x fs-3 d-block mb-2"></i>

                        Aucune note enregistrée pour ce fournisseur.

                    </div>
                @endif

            </div>

        </div>


        {{-- Résumé --}}
        <div class="row g-4 mb-4">

            {{-- Contact --}}
            <div class="col-md-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex align-items-center">

                            <div class=" bg-opacity-10 rounded-3
                                    d-flex align-items-center justify-content-center me-3"
                                style="width: 48px; height: 48px;">

                                <i class="bi bi-person-check-fill text-success fs-4"></i>

                            </div>

                            <div>

                                <div class="text-muted small">
                                    Contact
                                </div>

                                <strong>
                                    {{ $provider->name_contact ?: 'Non renseigné' }}
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Ville --}}
            <div class="col-md-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex align-items-center">

                            <div class=" bg-opacity-10 rounded-3
                                    d-flex align-items-center justify-content-center me-3"
                                style="width: 48px; height: 48px;">

                                <i class="bi bi-geo-alt-fill text-primary fs-4"></i>

                            </div>

                            <div>

                                <div class="text-muted small">
                                    Localisation
                                </div>

                                <strong>
                                    {{ $provider->town ?: 'Non renseignée' }}
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Pays --}}
            <div class="col-md-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex align-items-center">

                            <div class=" bg-opacity-10 rounded-3
                                    d-flex align-items-center justify-content-center me-3"
                                style="width: 48px; height: 48px;">

                                <i class="bi bi-globe2 text-info fs-4"></i>

                            </div>

                            <div>

                                <div class="text-muted small">
                                    Pays
                                </div>

                                <strong>
                                    {{ $provider->pays ?: 'Non renseigné' }}
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection