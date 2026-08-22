@extends('layout')

@section('content')
    <div class="container">

        {{-- ================================================= --}}
        {{-- EN-TÊTE                                           --}}
        {{-- ================================================= --}}

        <div class="stock-page-header d-flex justify-content-between align-items-center mb-2 my-2">

            <div>

                <h2 class="fw-bold mb-1 stock-title">

                    <i class="bi bi-pencil-square text-warning me-2"></i>
                    Gestion du stock

                </h2>

            </div>


            <a href="{{ route('show_product', $product) }}" class="btn btn-outline-secondary stock-back-btn">

                <i class="bi bi-arrow-left me-1"></i>
                <span>Retour</span>

            </a>

        </div>


        {{-- ================================================= --}}
        {{-- CARD                                               --}}
        {{-- ================================================= --}}

        <div class="card shadow-sm my-3 stock-card">

            @include('products.product.mouvement_modal')


            {{-- ================= HEADER ================= --}}

            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

                <h5 class="mb-0 stock-card-title">

                    <i class="bi bi-box-seam me-1"></i>
                    Liste des entrées en stock

                </h5>


                <button class="btn btn-success stock-add-btn" data-bs-target="#new_mouvement" data-bs-toggle="modal"
                    title="Ajouter une entrée">

                    <i class="bi bi-plus-circle"></i>

                    <span class="d-none d-sm-inline ms-1">
                        Ajouter
                    </span>

                </button>

            </div>


            {{-- ================= BODY ================= --}}

            <div class="card-body">

                {{-- ================= SUCCESS ================= --}}

                @if (session('success'))
                    <div class="alert alert-success">

                        {{ session('success') }}

                    </div>
                @endif


                {{-- ================= TABLE ================= --}}

                <div class="stock-table-wrapper">

                    <div class="table-responsive">

                        <table class="table table-hover table-bordered align-middle mb-0 stock-table">

                            <thead>

                                <tr>

                                    <th>
                                        Date d'entrée
                                    </th>

                                    <th>
                                        Qté initiale
                                    </th>

                                    <th>
                                        Stock actuel
                                    </th>

                                    <th>
                                        Prix fournisseur
                                    </th>

                                    <th class="text-center">
                                        Actions
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse($stocks as $stock)
                                    <tr>

                                        {{-- ================= DATE ================= --}}

                                        <td class="stock-date">

                                            {{ \Carbon\Carbon::parse($stock['enter_date'])->format('d/m/Y') }}

                                        </td>


                                        {{-- ================= QUANTITE INITIALE ================= --}}

                                        <td class="stock-quantity">

                                            {{ $stock['initial_quantity'] }}

                                        </td>


                                        {{-- ================= STOCK ACTUEL ================= --}}

                                        <td>

                                            @if ($stock['in_stock'] > 0)
                                                <span class="badge bg-success stock-badge">

                                                    {{ $stock['in_stock'] }}

                                                </span>
                                            @else
                                                <span class="badge bg-danger stock-badge">

                                                    Rupture

                                                </span>
                                            @endif

                                        </td>


                                        {{-- ================= PRIX ================= --}}

                                        <td class="stock-price">

                                            {{ number_format($stock['provider_price'], 2, ',', ' ') }}
                                            Ar

                                        </td>


                                        {{-- ================= ACTIONS ================= --}}

                                        <td class="text-center">

                                            <div class="btn-group stock-actions">

                                                <button data-bs-target="{{ '#edit' . $stock['id'] }}" data-bs-toggle="modal"
                                                    class="btn btn-warning btn-sm" title="Modifier">

                                                    <i class="bi bi-pencil-square"></i>

                                                </button>


                                                <button class="btn btn-danger btn-sm"
                                                    data-bs-target="{{ '#delete' . $stock['id'] }}" data-bs-toggle="modal"
                                                    title="Supprimer">

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            </div>


                                            {{-- ================= MODALS ================= --}}

                                            @if ($stocks)
                                                @include('products.product.edit_mouvement', [
                                                    'id' => 'edit' . $stock['id'],
                                                    'stock' => $stock,
                                                ])


                                                @include('products.product.delete_mouvement', [
                                                    'id' => 'delete' . $stock['id'],
                                                    'stock' => $stock,
                                                ])
                                            @endif

                                        </td>

                                    </tr>


                                @empty

                                    <tr>

                                        <td colspan="5" class="text-center text-muted py-4">

                                            <i class="bi bi-box-seam fs-2 d-block mb-2"></i>

                                            Aucun mouvement de stock enregistré.

                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>


                {{-- ================= PAGINATION ================= --}}

                <div class="mt-3">

                    {{ $stocks->links() }}

                </div>

            </div>

        </div>

    </div>


    {{-- ================================================= --}}
    {{-- CSS                                                --}}
    {{-- ================================================= --}}

    <style>
        /*
            ============================================================
            PAGE
            ============================================================
            */

        .stock-page-header {
            gap: 1rem;
        }


        .stock-title {
            white-space: nowrap;
        }


        /*
            ============================================================
            CARD
            ============================================================
            */

        .stock-card {
            width: 100%;
            max-width: 100%;
        }


        /*
            ============================================================
            TABLE CONTENEUR
            ============================================================
            */

        .stock-table-wrapper {
            width: 100%;
            max-width: 100%;
        }


        /*
            ============================================================
            SCROLL HORIZONTAL
            ============================================================
            */

        .stock-table-wrapper .table-responsive {
            width: 100%;
            max-width: 100%;

            overflow-x: auto;
            overflow-y: hidden;

            -webkit-overflow-scrolling: touch;
        }


        /*
            ============================================================
            TABLEAU
            ============================================================
            */

        .stock-table {
            min-width: 620px;
        }


        /*
            Empêche les cellules
            de passer sur plusieurs lignes.
            */

        .stock-table th,
        .stock-table td {
            white-space: nowrap;
        }


        /*
            ============================================================
            COLONNES
            ============================================================
            */

        .stock-date {
            min-width: 120px;
        }


        .stock-quantity {
            min-width: 120px;
        }


        .stock-price {
            min-width: 140px;
        }


        .stock-badge {
            min-width: 65px;
            display: inline-block;
            text-align: center;
        }


        /*
            ============================================================
            ACTIONS
            ============================================================
            */

        .stock-actions {
            white-space: nowrap;
        }


        /*
            ============================================================
            MOBILE
            ============================================================
            */

        @media (max-width: 767.98px) {

            /*
                ------------------------------
                En-tête
                ------------------------------
                */

            .stock-page-header {
                gap: 0.5rem;
            }


            .stock-title {
                font-size: 1.35rem;
            }


            .stock-title i {
                margin-right: 0.25rem !important;
            }


            .stock-back-btn {
                padding: 0.35rem 0.55rem;
                font-size: 0.75rem;
            }


            /*
                ------------------------------
                Card
                ------------------------------
                */

            .stock-card-title {
                font-size: 0.9rem;
            }


            .stock-add-btn {
                padding: 0.35rem 0.5rem;
                font-size: 0.75rem;
            }


            /*
                ------------------------------
                Tableau
                ------------------------------
                */

            .stock-table {
                min-width: 570px;
                font-size: 0.78rem;
            }


            .stock-table th,
            .stock-table td {
                padding: 0.5rem 0.4rem;
            }


            /*
                ------------------------------
                Colonnes
                ------------------------------
                */

            .stock-date {
                min-width: 105px;
            }


            .stock-quantity {
                min-width: 105px;
            }


            .stock-price {
                min-width: 120px;
            }


            .stock-badge {
                min-width: 60px;
                font-size: 0.7rem;
            }


            /*
                ------------------------------
                Actions
                ------------------------------
                */

            .stock-actions .btn {
                padding: 0.25rem 0.4rem;
                font-size: 0.7rem;
            }

        }


        /*
            ============================================================
            TRÈS PETITS ÉCRANS
            ============================================================
            */

        @media (max-width: 400px) {

            /*
                ------------------------------
                En-tête
                ------------------------------
                */

            .stock-title {
                font-size: 1.15rem;
            }


            .stock-back-btn {
                padding: 0.3rem 0.45rem;
            }


            .stock-back-btn span {
                display: none;
            }


            /*
                ------------------------------
                Card
                ------------------------------
                */

            .stock-card-title {
                font-size: 0.78rem;
            }


            .stock-add-btn {
                padding: 0.3rem 0.4rem;
            }


            /*
                ------------------------------
                Tableau
                ------------------------------
                */

            .stock-table {
                min-width: 530px;
                font-size: 0.7rem;
            }


            .stock-table th,
            .stock-table td {
                padding: 0.4rem 0.3rem;
            }


            .stock-date {
                min-width: 95px;
            }


            .stock-quantity {
                min-width: 95px;
            }


            .stock-price {
                min-width: 110px;
            }


            .stock-badge {
                min-width: 55px;
                font-size: 0.65rem;
            }


            .stock-actions .btn {
                padding: 0.2rem 0.3rem;
                font-size: 0.65rem;
            }

        }
    </style>
@endsection
