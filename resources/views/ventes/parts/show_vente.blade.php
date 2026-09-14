@extends('layout')

@section('title', 'Détails de la vente')

@section('content')

    <div class="container">

        {{-- En-tête --}}
        <div class="d-flex justify-content-between align-items-center mb-2 my-2">

            <div>

                <h2 class="fw-bold mb-0">
                    <i class="bi bi-receipt-cutoff text-primary me-2"></i>
                    Détails de la vente
                </h2>

                <small class="text-muted">
                    Commande : <strong>{{ $sale->sale_reference }}</strong>
                </small>
                <a href="{{ route('downloadInvoice', $sale) }}" class="btn text-info"> <i class="bi bi-download"></i> Facture </a>
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-outline-warning mb-2">
                <i class="bi bi-arrow-left"></i>
                Retour
            </a>

        </div>


        {{-- Informations principales --}}
        <div class="row mb-3">

            {{-- Client --}}
            <div class="col-md-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-header bg-dark text-white">
                        <i class="bi bi-person-fill text-primary me-2"></i>
                        Informations du client
                    </div>

                    <div class="card-body">

                        <div class="d-flex justify-content-between mb-3">

                            <div>
                                <small class="text-muted d-block">
                                    Nom
                                </small>

                                <strong>
                                    {{ $sale->client->name ?? 'Non défini' }}
                                    {{ $sale->client->firstname ?? '' }}
                                </strong>
                            </div>

                            <div class="text-end">

                                <small class="text-muted d-block">
                                    N° client
                                </small>

                                <strong>
                                    {{ $sale->client->client_number ?? 'Non défini' }}
                                </strong>

                            </div>

                        </div>


                        <div class="d-flex justify-content-between mb-3">

                            <div>
                                <small class="text-muted d-block">
                                    Téléphone
                                </small>

                                <span>
                                    <i class="bi bi-telephone text-success me-1"></i>
                                    {{ $sale->client->phone ? '0' . $sale->client->phone : 'Indisponible' }}
                                </span>
                            </div>

                            <div class="text-end">

                                <small class="text-muted d-block">
                                    Ville
                                </small>

                                <span>
                                    <i class="bi bi-geo-alt text-danger me-1"></i>
                                    {{ $sale->client->town ?? 'Indisponible' }}
                                </span>

                            </div>

                        </div>


                        <div>

                            <small class="text-muted d-block">
                                Adresse
                            </small>

                            <span>
                                {{ $sale->client->adress ?? 'Indisponible' }}
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Résumé vente --}}
            <div class="col-md-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-header bg-dark text-white">
                        <i class="bi bi-info-circle-fill text-info me-2"></i>
                        Informations sur la vente
                    </div>

                    <div class="card-body">

                        <div class="d-flex justify-content-between mb-3">

                            <div>
                                <small class="text-muted d-block">
                                    N° de commande
                                </small>

                                <strong>
                                    {{ $sale->sale_reference }}
                                </strong>
                            </div>

                            <div class="text-end">

                                <small class="text-muted d-block">
                                    Date
                                </small>

                                <strong>
                                    {{ $sale->created_at }}
                                </strong>

                            </div>

                        </div>


                        <div class="d-flex justify-content-between mb-3">

                            <div>
                                <small class="text-muted d-block">
                                    Mode de paiement
                                </small>

                                <span class="badge bg-primary">
                                    <i class="bi bi-credit-card me-1"></i>
                                    {{ $sale->payment_method ?? 'Non défini' }}
                                </span>
                            </div>

                            <div class="text-end">

                                <small class="text-muted d-block">
                                    Nombre de produits
                                </small>

                                <strong>
                                    {{ $sale->saledetail->sum('quantity') }}
                                </strong>

                                <small class="text-muted">
                                    article(s)
                                </small>

                            </div>

                        </div>


                        <div class="d-flex justify-content-between align-items-center">

                            <span class="fw-semibold">
                                Total de la vente
                            </span>

                            <span class="badge bg-success fs-5">
                                {{ number_format($sale->total_price, 0, ',', ' ') }} Ar
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Produits --}}
        <div class="card border-0 shadow-sm mb-3">

            <div class="card-header bg-dark text-white">
                <i class="bi bi-cart-check-fill text-success me-2"></i>
                Produits de la commande
            </div>

            <div class="card-body">

                <div class="sale-table-wrapper">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0 sale-table">

                            <thead class="table-light">

                                <tr>

                                    <th>
                                        Produit
                                    </th>

                                    <th>
                                        Ref
                                    </th>

                                    <th class="text-center">
                                        PU
                                    </th>

                                    <th class="text-center">
                                        Qte
                                    </th>

                                    <th class="text-end">
                                        Total
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach ($sale->saledetail as $detail)
                                    <tr>

                                        {{-- ================= PRODUIT ================= --}}
                                        <td>

                                            <div class="d-flex align-items-center product-cell">

                                                @if ($detail->product->image_path ?? false)
                                                    <img src="{{ asset($detail->product->image_path) }}" alt="product"
                                                        class="rounded me-2 product-image">
                                                @else
                                                    <div
                                                        class="bg-light rounded d-flex align-items-center justify-content-center me-2 product-image">

                                                        <i class="bi bi-box text-muted"></i>

                                                    </div>
                                                @endif


                                                <strong class="product-name">

                                                    {{ $detail->product->name_product ?? 'Produit supprimé' }}

                                                </strong>

                                            </div>

                                        </td>


                                        {{-- ================= REFERENCE ================= --}}
                                        <td class="reference-cell">

                                            {{ $detail->product->reference ?? '---' }}

                                        </td>


                                        {{-- ================= PRIX ================= --}}
                                        <td class="text-center price-cell">

                                            {{ number_format($detail->price ?? $detail->product->price, 0, ',', ' ') }}
                                            Ar

                                        </td>


                                        {{-- ================= QUANTITE ================= --}}
                                        <td class="text-center">

                                            <span class="badge bg-info text-dark quantity-badge">

                                                {{ $detail->quantity }}

                                            </span>

                                        </td>


                                        {{-- ================= TOTAL ================= --}}
                                        <td class="text-end fw-semibold total-cell">

                                            {{ number_format(($detail->price ?? $detail->product->price) * $detail->quantity, 0, ',', ' ') }}
                                            Ar

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>


        {{-- Partie financière --}}
        <div class="row mb-3">

            {{-- Remise --}}
            <div class="col-md-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-header bg-dark text-white">
                        <i class="bi bi-percent text-warning me-2"></i>
                        Remise
                    </div>

                    <div class="card-body">

                        @if (($sale->discount ?? 0) > 0)
                            <div class="d-flex justify-content-between align-items-center">

                                <span>
                                    Remise appliquée
                                </span>

                                <span class="badge bg-warning text-dark fs-6">
                                    {{ $sale->discount }} %
                                </span>

                            </div>
                        @else
                            <div class="text-muted">

                                <i class="bi bi-dash-circle me-1"></i>
                                Aucune remise appliquée.

                            </div>
                        @endif

                    </div>

                </div>

            </div>


            {{-- Paiement / total --}}
            <div class="col-md-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-header bg-dark text-white">
                        <i class="bi bi-cash-stack text-success me-2"></i>
                        Résumé financier
                    </div>

                    <div class="card-body">

                        <div class="d-flex justify-content-between mb-2">

                            <span>
                                Sous-total
                            </span>

                            <strong>
                                {{ number_format(
                                    $sale->saledetail->sum(function ($detail) {
                                        return ($detail->price ?? $detail->product->price) * $detail->quantity;
                                    }),
                                    0,
                                    ',',
                                    ' ',
                                ) }}
                                Ar
                            </strong>

                        </div>

                        <div class="d-flex justify-content-between mb-2">

                            <span>
                                Remise
                            </span>

                            <strong class="text-danger">

                                - {{ $sale->discount ?? 0 }} %

                            </strong>

                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center">

                            <strong>
                                Total payé
                            </strong>

                            <span class="badge bg-success fs-5">
                                {{ number_format($sale->total_price, 0, ',', ' ') }} Ar
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Note --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-dark text-white">
                <i class="bi bi-chat-left-text-fill text-info me-2"></i>
                Note de la vente
            </div>

            <div class="card-body">

                @if (!empty($sale->note))
                    <div class="alert alert-light border mb-0">

                        <i class="bi bi-quote text-primary me-2"></i>

                        {{ $sale->note }}

                    </div>
                @else
                    <span class="text-muted">
                        <i class="bi bi-dash-circle me-1"></i>
                        Aucune note pour cette vente.
                    </span>
                @endif

            </div>

        </div>

    </div>
    <style>
        /*
        ============================================================
        CONTENEUR DU TABLEAU
        ============================================================
        */

        .sale-table-wrapper {
            width: 100%;
            max-width: 100%;
        }


        /*
        ============================================================
        SCROLL HORIZONTAL
        ============================================================
        */

        .sale-table-wrapper .table-responsive {
            width: 100%;
            max-width: 100%;
            overflow-x: auto;
            overflow-y: hidden;

            /*
            Permet un scroll horizontal plus agréable
            sur les appareils tactiles.
            */
            -webkit-overflow-scrolling: touch;
        }


        /*
        ============================================================
        TABLEAU
        ============================================================
        */

        .sale-table {
            min-width: 650px;
        }


        /*
        Empêche les cellules de créer
        des retours à la ligne.
        */

        .sale-table th,
        .sale-table td {
            white-space: nowrap;
        }


        /*
        ============================================================
        PRODUIT
        ============================================================
        */

        .product-cell {
            min-width: 190px;
        }


        .product-image {
            width: 35px;
            height: 35px;
            min-width: 35px;

            object-fit: cover;
        }


        .product-name {
            white-space: nowrap;
        }


        /*
        ============================================================
        REFERENCE
        ============================================================
        */

        .reference-cell {
            min-width: 100px;
        }


        /*
        ============================================================
        PRIX
        ============================================================
        */

        .price-cell {
            min-width: 100px;
        }


        /*
        ============================================================
        TOTAL
        ============================================================
        */

        .total-cell {
            min-width: 120px;
        }


        /*
        ============================================================
        QUANTITE
        ============================================================
        */

        .quantity-badge {
            min-width: 30px;
        }


        /*
        ============================================================
        MOBILE
        ============================================================
        */

        @media (max-width: 767.98px) {

            .sale-table {
                min-width: 600px;
                font-size: 0.78rem;
            }


            .sale-table th,
            .sale-table td {
                padding: 0.5rem 0.4rem;
            }


            /*
            Image légèrement plus petite
            */

            .product-image {
                width: 30px;
                height: 30px;
                min-width: 30px;
            }


            /*
            Nom du produit
            */

            .product-cell {
                min-width: 170px;
            }


            .product-name {
                font-size: 0.78rem;
            }


            /*
            Référence
            */

            .reference-cell {
                min-width: 90px;
            }


            /*
            Prix
            */

            .price-cell {
                min-width: 90px;
            }


            /*
            Total
            */

            .total-cell {
                min-width: 110px;
            }

        }


        /*
        ============================================================
        TRÈS PETITS ÉCRANS
        ============================================================
        */

        @media (max-width: 400px) {

            .sale-table {
                min-width: 570px;
                font-size: 0.72rem;
            }


            .sale-table th,
            .sale-table td {
                padding: 0.4rem 0.3rem;
            }


            .product-cell {
                min-width: 160px;
            }


            .product-name {
                font-size: 0.72rem;
            }


            .product-image {
                width: 28px;
                height: 28px;
                min-width: 28px;
            }

        }
    </style>

@endsection
