<div class="card shadow-sm border-0">

    {{-- ================= HEADER ================= --}}
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="bi bi-clock-history me-2"></i>
            Dernières ventes
        </h5>

        <span class="badge bg-primary">
            {{ $sales->total() }} vente(s)
        </span>

    </div>


    {{-- ================= BODY ================= --}}
    <div class="card-body">

        {{-- ================= TABLE ================= --}}
        <div class="sales-table-wrapper">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0 sales-table">

                    <thead class="table-light">

                        <tr>

                            <th>
                                Commande
                            </th>

                            <th>
                                Client
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


                                {{-- ================= CLIENT ================= --}}
                                <td>

                                    <span class="sale-client">

                                        <i class="bi bi-person-circle text-secondary me-1"></i>

                                        {{ $sale->client->name }}
                                        {{ $sale->client->firstname }}

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
                                        class="btn btn-info btn-sm text-white sale-action" title="Voir la vente">

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

            </div>

        </div>


        {{-- ================= PAGINATION ================= --}}
        <div class="mt-3">

            {{ $sales->links() }}

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
