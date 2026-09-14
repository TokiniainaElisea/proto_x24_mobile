@extends('layout')

@section('content')
    <div class="container p-2">

        {{-- En-tête --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div class="d-flex align-items-center">

                <div class=" bg-opacity-10 rounded-3
                        d-flex align-items-center justify-content-center me-3"
                    style="width: 52px; height: 52px;">

                    <i class="bi bi-person-vcard-fill text-primary fs-3"></i>

                </div>

                <div>

                    <h2 class="fw-bold mb-0">
                        Fiche client
                    </h2>

                </div>

            </div>

            <a href="{{ route('client') }}" class="btn btn-outline-secondary">

                <i class="bi bi-arrow-left me-1"></i>

            </a>

        </div>


        <div class="row g-4">

            {{-- IDENTITÉ DU CLIENT --}}

            <div class="col-lg-8">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-header bg-dark text-white">

                        <h5 class="mb-0">

                            <i class="bi bi-person-fill me-2"></i>
                            Informations du client

                        </h5>

                    </div>

                    <div class="card-body">

                        {{-- Identité --}}
                        <div class="d-flex align-items-center mb-4">

                            <div class="rounded-circle bg-opacity-10
                                    d-flex align-items-center justify-content-center me-3"
                                style="width: 70px; height: 70px;">

                                @if ($client->client_type === 'société')
                                    <i class="bi bi-building-fill text-primary fs-2"></i>
                                @else
                                    <i class="bi bi-person-fill text-primary fs-2"></i>
                                @endif

                            </div>

                            <div>

                                <div class="d-flex align-items-center gap-2">

                                    <h4 class="fw-bold mb-0">

                                        {{ $client->name }}

                                        @if ($client->firstname)
                                            {{ $client->firstname }}
                                        @endif

                                    </h4>

                                </div>

                                <small class="text-muted">

                                    <i class="bi bi-person-vcard me-1"></i>

                                    N° client :
                                    <strong>{{ $client->client_number }}</strong>

                                </small>
                                <div class="mb-2">
                                    @if ($client->client_type === 'société')
                                        <span class="badge bg-info">

                                            <i class="bi bi-building me-1"></i>
                                            Société

                                        </span>
                                    @else
                                        <span class="badge bg-secondary">

                                            <i class="bi bi-person me-1"></i>
                                            Particulier

                                        </span>
                                    @endif

                                </div>
                            </div>

                        </div>


                        <hr>


                        {{-- Informations --}}
                        <div class="row g-4 mt-1">

                            {{-- Nom --}}
                            <div class="col-md-6">

                                <div class="text-muted small mb-1">

                                    <i class="bi bi-person me-1 text-primary"></i>
                                    Nom

                                </div>

                                <strong>
                                    {{ $client->name ?: 'Non renseigné' }}
                                </strong>

                            </div>


                            {{-- Prénom --}}
                            <div class="col-md-6">

                                <div class="text-muted small mb-1">

                                    <i class="bi bi-person-badge me-1 text-primary"></i>
                                    Prénom

                                </div>

                                <strong>

                                    {{ $client->firstname ?: 'Non renseigné' }}

                                </strong>

                            </div>


                            {{-- Téléphone --}}
                            <div class="col-md-6">

                                <div class="text-muted small mb-1">

                                    <i class="bi bi-telephone-fill me-1 text-success"></i>
                                    Téléphone

                                </div>

                                @if ($client->phone)
                                    <strong>
                                        {{ '0' . $client->phone }}
                                    </strong>
                                @else
                                    <span class="text-muted">
                                        Non renseigné
                                    </span>
                                @endif

                            </div>


                            {{-- Ville --}}
                            <div class="col-md-6">

                                <div class="text-muted small mb-1">

                                    <i class="bi bi-geo-alt-fill me-1 text-danger"></i>
                                    Ville

                                </div>

                                <strong>

                                    {{ $client->town ?: 'Non renseignée' }}

                                </strong>

                            </div>


                            {{-- Type --}}
                            <div class="col-md-6">

                                <div class="text-muted small mb-1">

                                    <i class="bi bi-diagram-3-fill me-1 text-info"></i>
                                    Type de client

                                </div>

                                <strong>

                                    {{ ucfirst($client->client_type) }}

                                </strong>

                            </div>


                            {{-- Numéro client --}}
                            <div class="col-md-6">

                                <div class="text-muted small mb-1">

                                    <i class="bi bi-hash me-1 text-secondary"></i>
                                    Référence client

                                </div>

                                <span class="badge bg-light text-dark border">

                                    {{ $client->client_number }}

                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- RÉSUMÉ --}}

            <div class="col-lg-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-header bg-dark text-white">

                        <h5 class="mb-0">

                            <i class="bi bi-bar-chart-fill me-2"></i>
                            Résumé

                        </h5>

                    </div>

                    <div class="card-body">

                        {{-- Nombre de ventes --}}
                        <div class="d-flex justify-content-between align-items-center mb-4">

                            <div>

                                <div class="text-muted small">
                                    Nombre de ventes
                                </div>

                                <div class="fs-3 fw-bold text-primary">

                                    {{ $client->sales->count() }}

                                </div>

                            </div>

                            <div class="fs-1 text-primary">

                                <i class="bi bi-cart-check-fill"></i>

                            </div>

                        </div>


                        {{-- CA --}}
                        <div class="d-flex justify-content-between align-items-center mb-4">

                            <div>

                                <div class="text-muted small">
                                    Total des achats
                                </div>

                                <div class="fs-3 fw-bold text-success">

                                    {{ number_format($client->sales->sum('total_price'), 0, ',', ' ') }}

                                    <small class="fs-6">
                                        Ar
                                    </small>

                                </div>

                            </div>

                            <div class="fs-1 text-success">

                                <i class="bi bi-cash-stack"></i>

                            </div>

                        </div>


                        {{-- Panier moyen --}}
                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <div class="text-muted small">
                                    Panier moyen
                                </div>

                                <div class="fs-4 fw-bold text-warning">

                                    {{ $client->sales->count() ? number_format($client->sales->avg('total_price'), 0, ',', ' ') : 0 }}

                                    <small class="fs-6">
                                        Ar
                                    </small>

                                </div>

                            </div>

                            <div class="fs-1 text-warning">

                                <i class="bi bi-basket2-fill"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- HISTORIQUE DES VENTES --}}

            <div class="col-12">

                <div class="card border-0 shadow-sm">

                    <div
                        class="card-header bg-dark text-white
                            d-flex justify-content-between align-items-center">

                        <h5 class="mb-0">

                            <i class="bi bi-clock-history me-2"></i>
                            Historique des ventes

                        </h5>

                        <span class="badge bg-primary">

                            {{ $client->sales->count() }}
                            vente(s)

                        </span>

                    </div>


                    <div class="card-body p-0">
                        <div class="sales-table-wrapper">

                            <div class="table-responsive">

                                <table class="table table-hover align-middle mb-0 sales-table">

                                    <thead class="table-light">

                                        <tr>

                                            <th>
                                                Commande
                                            </th>

                                            <th>
                                                Date
                                            </th>

                                            <th>
                                                Total
                                            </th>

                                            <th class="text-center">
                                                Action
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody>

                                        @forelse($sales as $sale)
                                            <tr>

                                                {{-- ================= COMMANDE ================= --}}
                                                <td>

                                                    <span class="fw-semibold text-primary sale-reference">

                                                        <i class="bi bi-receipt me-1"></i>

                                                        {{ $sale->sale_reference }}

                                                    </span>

                                                </td>



                                                {{-- ================= DATE ================= --}}
                                                <td>

                                                    <span class="sale-date">

                                                        <i class="bi bi-calendar-event text-muted me-1"></i>

                                                        {{ $sale->created_at->format('d/m/Y H:i') }}

                                                    </span>

                                                </td>


                                                {{-- ================= TOTAL ================= --}}
                                                <td>

                                                    <span class="badge bg-success sale-total">

                                                        {{ number_format($sale->total_price, 0, ',', ' ') }} Ar

                                                    </span>

                                                </td>


                                                {{-- ================= ACTION ================= --}}
                                                <td class="text-center">

                                                    <a href="{{ route('show_vente', $sale) }}"
                                                        class="btn btn-info btn-sm text-white sale-action"
                                                        title="Voir la vente">

                                                        <i class="bi bi-eye-fill"></i>

                                                    </a>

                                                </td>

                                            </tr>


                                        @empty

                                            <tr>

                                                <td colspan="5" class="text-center py-5 text-muted">

                                                    <i class="bi bi-cart-x fs-1 d-block mb-2"></i>

                                                    Aucune vente enregistrée.

                                                </td>

                                            </tr>
                                        @endforelse

                                    </tbody>

                                </table>

                                {{ $sales->links() }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <style>
        /*
                    

                CONTENEUR
                    

                */

        .sales-table-wrapper {
            width: 100%;
            max-width: 100%;
        }


        /*
                    

                SCROLL HORIZONTAL
                    

                */

        .sales-table-wrapper .table-responsive {
            width: 100%;
            max-width: 100%;

            overflow-x: auto;
            overflow-y: hidden;

            /*
                    Scroll fluide sur mobile
                    */

            -webkit-overflow-scrolling: touch;
        }


        /*
                    

                TABLEAU
                    

                */

        .sales-table {
            min-width: 650px;
        }


        /*
                Empêche les textes de passer
                sur plusieurs lignes.
                */

        .sales-table th,
        .sales-table td {
            white-space: nowrap;
        }


        /*
                    

                COLONNES
                    

                */

        .sale-reference {
            min-width: 120px;
        }


        .sale-client {
            min-width: 150px;
        }


        .sale-date {
            min-width: 140px;
        }


        .sale-total {
            min-width: 110px;
            display: inline-block;
            text-align: center;
        }


        .sale-action {
            min-width: 32px;
        }


        /*
                    

                MOBILE
                    

                */

        @media (max-width: 767.98px) {

            .sales-table {
                min-width: 600px;
                font-size: 0.78rem;
            }


            .sales-table th,
            .sales-table td {
                padding: 0.5rem 0.4rem;
            }


            /*
                    Commande
                    */

            .sale-reference {
                min-width: 110px;
            }


            /*
                    Client
                    */

            .sale-client {
                min-width: 135px;
            }


            /*
                    Date
                    */

            .sale-date {
                min-width: 125px;
            }


            /*
                    Total
                    */

            .sale-total {
                min-width: 100px;
                font-size: 0.75rem;
            }


            /*
                    Bouton
                    */

            .sale-action {
                padding: 0.25rem 0.4rem;
            }

        }


        /*
                    

                TRÈS PETITS ÉCRANS
                    

                */

        @media (max-width: 400px) {

            .sales-table {
                min-width: 560px;
                font-size: 0.72rem;
            }


            .sales-table th,
            .sales-table td {
                padding: 0.4rem 0.3rem;
            }


            .sale-reference {
                min-width: 100px;
            }


            .sale-client {
                min-width: 125px;
            }


            .sale-date {
                min-width: 120px;
            }


            .sale-total {
                min-width: 90px;
                font-size: 0.7rem;
            }

        }
    </style>
@endsection
