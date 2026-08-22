<div class="card shadow-sm my-3">

    {{-- ================= HEADER ================= --}}
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="bi bi-receipt-cutoff me-2"></i>
            Liste des ventes
        </h5>

        <span class="badge bg-primary">
            {{ $sales->total() }} vente(s)
        </span>

    </div>


    {{-- ================= BODY ================= --}}
    <div class="card-body">

        <div class="sales-list-wrapper">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0 sales-list-table">

                    <thead>

                        <tr>

                            <th>
                                Client
                            </th>

                            <th>
                                Commande
                            </th>

                            <th>
                                Nom
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

                                {{-- ================= CLIENT ================= --}}
                                <td>

                                    <span class="badge bg-secondary client-number">

                                        <i class="bi bi-person-badge-fill me-1"></i>

                                        {{ $sale->client->client_number }}

                                    </span>

                                </td>


                                {{-- ================= COMMANDE ================= --}}
                                <td>

                                    <span class="fw-semibold text-primary sale-reference">

                                        {{ $sale->sale_reference }}

                                    </span>

                                </td>


                                {{-- ================= NOM ================= --}}
                                <td>

                                    <span class="sale-client-name">

                                        <i class="bi bi-person-fill text-secondary me-1"></i>

                                        {{ $sale->client->name }}

                                    </span>

                                </td>


                                {{-- ================= DATE ================= --}}
                                <td>

                                    <span class="sale-date">

                                        <i class="bi bi-calendar-event me-1 text-muted"></i>

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
                                        class="btn btn-info btn-sm text-white sale-action" title="Voir les détails">

                                        <i class="bi bi-eye-fill"></i>

                                    </a>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td colspan="6" class="text-center text-muted py-4">

                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>

                                    Aucune vente trouvée.

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- ================= PAGINATION ================= --}}
        <div class="mt-3">

            {{ $sales->withQueryString()->links() }}

        </div>

    </div>

</div>


<style>
    /*
    ============================================================
    CONTENEUR DU TABLEAU
    ============================================================
    */

    .sales-list-wrapper {
        width: 100%;
        max-width: 100%;
    }


    /*
    ============================================================
    SCROLL HORIZONTAL
    ============================================================
    */

    .sales-list-wrapper .table-responsive {
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

    .sales-list-table {
        min-width: 750px;
    }


    /*
    Empêche les informations de passer
    sur plusieurs lignes.
    */

    .sales-list-table th,
    .sales-list-table td {
        white-space: nowrap;
    }


    /*
    ============================================================
    COLONNES
    ============================================================
    */

    .client-number {
        min-width: 100px;
    }


    .sale-reference {
        min-width: 120px;
    }


    .sale-client-name {
        min-width: 130px;
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
    ============================================================
    MOBILE
    ============================================================
    */

    @media (max-width: 767.98px) {

        .sales-list-table {
            min-width: 680px;
            font-size: 0.78rem;
        }


        .sales-list-table th,
        .sales-list-table td {
            padding: 0.5rem 0.4rem;
        }


        /*
        Client
        */

        .client-number {
            min-width: 90px;
            font-size: 0.7rem;
        }


        /*
        Commande
        */

        .sale-reference {
            min-width: 105px;
        }


        /*
        Nom
        */

        .sale-client-name {
            min-width: 120px;
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
        Action
        */

        .sale-action {
            padding: 0.25rem 0.4rem;
        }

    }


    /*
    ============================================================
    TRÈS PETITS ÉCRANS
    ============================================================
    */

    @media (max-width: 400px) {

        .sales-list-table {
            min-width: 630px;
            font-size: 0.72rem;
        }


        .sales-list-table th,
        .sales-list-table td {
            padding: 0.4rem 0.3rem;
        }


        .client-number {
            min-width: 80px;
            font-size: 0.65rem;
        }


        .sale-reference {
            min-width: 95px;
        }


        .sale-client-name {
            min-width: 110px;
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
