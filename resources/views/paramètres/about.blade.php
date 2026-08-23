@extends('layout')

@section('content')
    <div class="container p-2">

        {{-- En-tête --}}
        <div class="d-flex align-items-center my-2 mb-2">

            <div class=" bg-opacity-10 rounded-3
                    d-flex align-items-center justify-content-center me-3"
                style="width: 52px; height: 52px;">

                <i class="bi bi-info fs-1"> </i>

            </div>

            <div>

                <h2 class="fw-bold mb-0">
                    À propos
                </h2>

                <small class="text-muted">
                    Informations sur Proto X-24 mobile
                </small>

            </div>

        </div>


        {{-- Présentation principale --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-body p-4">

                <div class="text-center">

                    {{-- Logo --}}
                    <div class="mx-auto mb-3 rounded-4 bg-opacity-10
                            d-flex align-items-center justify-content-center"
                        style="width: 90px; height: 90px;">

                        <img src="{{ asset('icon.png') }}" alt="Proto X-24" style="width: 70px; height: auto;">

                    </div>

                    <h1 class="fw-bold mb-1">
                        Proto X-24 mobile
                    </h1>

                    <div class="text-muted mb-3">
                        Gestion commerciale
                    </div>

                    <span class="badge bg-primary px-3 py-2">
                        Version 1.0.0
                    </span>

                </div>

                <hr class="my-4">

                <div class="text-center mx-auto" style="max-width: 700px;">

                    <p class="lead mb-2">
                        Une solution simple et moderne pour gérer votre activité commerciale.
                    </p>

                    <p class="text-muted mb-0">
                        Proto X-24 mobile permet de centraliser les produits, les stocks,
                        les clients et les ventes, tout en offrant une vision claire
                        de l'activité de l'entreprise.
                    </p>

                </div>

            </div>

        </div>


        {{-- Fonctionnalités --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-dark text-white">

                <h5 class="mb-0">
                    <i class="bi bi-grid-fill me-2"></i>
                    Fonctionnalités
                </h5>

            </div>

            <div class="card-body">

                <div class="row g-4">

                    {{-- Produits --}}
                    <div class="col-md-4">

                        <div class="d-flex">

                            <div class="bg-opacity-10 rounded-3
                                    d-flex align-items-center justify-content-center me-3"
                                style="width: 45px; height: 45px;">

                                <i class="bi bi-box-seam-fill text-primary"></i>

                            </div>

                            <div>

                                <strong>
                                    Produits
                                </strong>

                                <p class="small text-muted mb-0">
                                    Gestion des produits, catégories,
                                    références et caractéristiques.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Stocks --}}
                    <div class="col-md-4">

                        <div class="d-flex">

                            <div class=" bg-opacity-10 rounded-3
                                    d-flex align-items-center justify-content-center me-3"
                                style="width: 45px; height: 45px;">

                                <i class="bi bi-boxes text-success"></i>

                            </div>

                            <div>

                                <strong>
                                    Stocks
                                </strong>

                                <p class="small text-muted mb-0">
                                    Suivi des entrées, sorties et
                                    niveaux de stock.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Clients --}}
                    <div class="col-md-4">

                        <div class="d-flex">

                            <div class=" bg-opacity-10 rounded-3
                                    d-flex align-items-center justify-content-center me-3"
                                style="width: 45px; height: 45px;">

                                <i class="bi bi-people-fill text-info"></i>

                            </div>

                            <div>

                                <strong>
                                    Clients
                                </strong>

                                <p class="small text-muted mb-0">
                                    Gestion des clients et de leurs
                                    informations.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Ventes --}}
                    <div class="col-md-4">

                        <div class="d-flex">

                            <div class=" bg-opacity-10 rounded-3
                                    d-flex align-items-center justify-content-center me-3"
                                style="width: 45px; height: 45px;">

                                <i class="bi bi-cart-check-fill text-warning"></i>

                            </div>

                            <div>

                                <strong>
                                    Ventes
                                </strong>

                                <p class="small text-muted mb-0">
                                    Enregistrement et suivi des
                                    ventes et commandes.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Bilan --}}
                    <div class="col-md-4">

                        <div class="d-flex">

                            <div class=" bg-opacity-10 rounded-3
                                    d-flex align-items-center justify-content-center me-3"
                                style="width: 45px; height: 45px;">

                                <i class="bi bi-graph-up-arrow text-danger"></i>

                            </div>

                            <div>

                                <strong>
                                    Bilan
                                </strong>

                                <p class="small text-muted mb-0">
                                    Analyse de l'activité, chiffre
                                    d'affaires et performances.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Facturation --}}
                    <div class="col-md-4">

                        <div class="d-flex">

                            <div class=" bg-opacity-10 rounded-3
                                    d-flex align-items-center justify-content-center me-3"
                                style="width: 45px; height: 45px;">

                                <i class="bi bi-receipt text-secondary"></i>

                            </div>

                            <div>

                                <strong>
                                    Facturation
                                </strong>

                                <p class="small text-muted mb-0">
                                    Génération de documents liés
                                    aux ventes.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Informations techniques --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-dark text-white">

                <h5 class="mb-0">
                    <i class="bi bi-code-slash me-2"></i>
                    Informations
                </h5>

            </div>

            <div class="card-body">

                <div class="row g-3">

                    <div class="col-md-6">

                        <div class="text-muted small">
                            Application
                        </div>

                        <strong>
                            Proto X-24 mobile
                        </strong>

                    </div>

                    <div class="col-md-6">

                        <div class="text-muted small">
                            Version
                        </div>

                        <strong>
                            1.0.0
                        </strong>

                    </div>

                    <div class="col-md-6">

                        <div class="text-muted small">
                            Plateforme
                        </div>

                        <strong>
                            Android
                        </strong>

                    </div>

                    <div class="col-md-6">

                        <div class="text-muted small">
                            Base de données
                        </div>

                        <strong>
                            SQLite
                        </strong>

                    </div>

                </div>

            </div>

        </div>


        {{-- Auteur --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-body">

                <div class="d-flex align-items-center">

                    <div class="rounded-circle bg-dark text-white
                            d-flex align-items-center justify-content-center me-3"
                        style="width: 50px; height: 50px;">

                        <i class="bi bi-code-slash fs-5"></i>

                    </div>

                    <livewire:about-footer-page />

                    <div class="text-end">

                        <small class="text-muted">
                            © 2026
                        </small>

                    </div>

                </div>

            </div>

        </div>

        {{-- Footer --}}
        <div class="text-center text-muted small mb-4">

            <i class="bi bi-boxes me-1"></i>

            Proto X-24 mobile · Gestion commerciale

        </div>

    </div>
@endsection
