<div class="row">

    <div class="col-12">

        <div class="card border-0 shadow-sm">

            {{-- ================================================= --}}
            {{-- HEADER                                             --}}
            {{-- ================================================= --}}

            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

                <div class="d-flex align-items-center">

                    <i class="bi bi-people-fill text-primary fs-5 me-2"></i>

                    <span class="fw-semibold">
                        Liste des clients
                    </span>

                </div>


                <span class="badge bg-primary">

                    {{ $clients->total() }} client(s)

                </span>

            </div>


            {{-- ================================================= --}}
            {{-- TABLEAU                                            --}}
            {{-- ================================================= --}}

            <div class="card-body p-0">

                <div class="client-table-wrapper">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0 client-table">

                            <thead class="table-light">

                                <tr>

                                    <th class="ps-3">
                                        N° client
                                    </th>

                                    <th>
                                        Nom
                                    </th>

                                    <th>
                                        Prénom
                                    </th>

                                    <th>
                                        Téléphone
                                    </th>

                                    <th>
                                        Ville
                                    </th>

                                    <th>
                                        Adresse
                                    </th>

                                    <th class="text-center">
                                        Actions
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse ($clients as $client)
                                    <tr>

                                        {{-- ================================= --}}
                                        {{-- NUMERO CLIENT                     --}}
                                        {{-- ================================= --}}

                                        <td class="ps-3">

                                            <span class="badge bg-light text-dark border client-number">

                                                <i class="bi bi-person-vcard me-1"></i>

                                                {{ $client->client_number }}

                                            </span>

                                        </td>


                                        {{-- ================================= --}}
                                        {{-- NOM                               --}}
                                        {{-- ================================= --}}

                                        <td class="fw-semibold">

                                            <span class="client-name">

                                                {{ $client->name }}

                                            </span>

                                        </td>


                                        {{-- ================================= --}}
                                        {{-- PRENOM                            --}}
                                        {{-- ================================= --}}

                                        <td>

                                            <span class="client-firstname">

                                                {{ $client->firstname }}

                                            </span>

                                        </td>


                                        {{-- ================================= --}}
                                        {{-- TELEPHONE                         --}}
                                        {{-- ================================= --}}

                                        <td>

                                            @if ($client->phone)
                                                <span class="client-phone">

                                                    <i class="bi bi-telephone-fill text-success me-1"></i>

                                                    {{ '0' . $client->phone }}

                                                </span>
                                            @else
                                                <span class="text-muted">

                                                    <i class="bi bi-dash-circle me-1"></i>

                                                    Indisponible

                                                </span>
                                            @endif

                                        </td>


                                        {{-- ================================= --}}
                                        {{-- VILLE                             --}}
                                        {{-- ================================= --}}

                                        <td>

                                            @if ($client->town)
                                                <span class="client-town">

                                                    <i class="bi bi-geo-alt-fill text-danger me-1"></i>

                                                    {{ $client->town }}

                                                </span>
                                            @else
                                                <span class="text-muted">
                                                    Indisponible
                                                </span>
                                            @endif

                                        </td>


                                        {{-- ================================= --}}
                                        {{-- ADRESSE                           --}}
                                        {{-- ================================= --}}

                                        <td>

                                            @if ($client->adress)
                                                <span class="client-address">

                                                    {{ $client->adress }}

                                                </span>
                                            @else
                                                <span class="text-muted">
                                                    Indisponible
                                                </span>
                                            @endif

                                        </td>


                                        {{-- ================================= --}}
                                        {{-- ACTIONS                           --}}
                                        {{-- ================================= --}}

                                        <td class="">

                                            <div class="d-flex gap-2 client-actions">

                                                {{-- Modifier --}}

                                                <button type="button" class="btn btn-sm btn-outline-warning"
                                                    data-bs-target="{{ '#client_' . $client->id }}"
                                                    data-bs-toggle="modal" title="Modifier">

                                                    <i class="bi bi-pencil-square"></i>

                                                </button>


                                                {{-- Supprimer --}}

                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    data-bs-target="{{ '#delete_client' . $client->id }}"
                                                    data-bs-toggle="modal" title="Supprimer">

                                                    <i class="bi bi-trash3-fill"></i>

                                                </button>

                                                {{-- La fiche --}}
                                                <a href="{{ route('show_client', $client->id) }}"
                                                    class="btn btn-sm btn-outline-info">
                                                    <i class="bi bi-eye"></i>
                                                </a>


                                                {{-- Modals --}}

                                                @include('clients.parts.update_client', [
                                                    'id' => 'client_' . $client->id,
                                                
                                                    'client' => $client,
                                                ])


                                                @include('clients.parts.delete_client', [
                                                    'id' => 'delete_client' . $client->id,
                                                
                                                    'client' => $client,
                                                ])

                                            </div>

                                        </td>

                                    </tr>


                                @empty

                                    <tr>

                                        <td colspan="7" class="text-center py-5">

                                            <i class="bi bi-person-x text-muted" style="font-size: 2.5rem;">
                                            </i>


                                            <h6 class="fw-bold mt-3">

                                                Aucun client trouvé

                                            </h6>


                                            <small class="text-muted">

                                                Aucun client n'est actuellement enregistré.

                                            </small>

                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- PAGINATION                                         --}}
        {{-- ================================================= --}}

        <div class="d-flex justify-content-center mt-3">

            {{ $clients->links() }}

        </div>

    </div>

</div>


<style>
    /*
    ============================================================
    CONTENEUR
    ============================================================
    */

    .client-table-wrapper {

        width: 100%;
        max-width: 100%;

    }


    /*
    ============================================================
    SCROLL HORIZONTAL
    ============================================================
    */

    .client-table-wrapper .table-responsive {

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

    .client-table {

        width: 100%;

    }


    /*
    Empêche les données de passer
    sur plusieurs lignes.
    */

    .client-table th,
    .client-table td {

        white-space: nowrap;

    }


    /*
    ============================================================
    COLONNES
    ============================================================
    */

    .client-number {

        min-width: 110px;

    }


    .client-name {

        display: inline-block;

        min-width: 130px;

    }


    .client-firstname {

        display: inline-block;

        min-width: 130px;

    }


    .client-phone {

        display: inline-block;

        min-width: 130px;

    }


    .client-town {

        display: inline-block;

        min-width: 120px;

    }


    .client-address {

        display: inline-block;

        min-width: 220px;

    }


    /*
    ============================================================
    ACTIONS
    ============================================================
    */

    .client-actions {

        white-space: nowrap;

    }


    /*
    ============================================================
    MOBILE
    ============================================================
    */

    @media (max-width: 767.98px) {

        .client-table {

            min-width: 850px;

            font-size: 0.78rem;

        }


        .client-table th,
        .client-table td {

            padding: 0.5rem 0.4rem;

        }


        /*
        Numéro
        */

        .client-number {

            min-width: 95px;

            font-size: 0.7rem;

        }


        /*
        Nom
        */

        .client-name {

            min-width: 115px;

        }


        /*
        Prénom
        */

        .client-firstname {

            min-width: 115px;

        }


        /*
        Téléphone
        */

        .client-phone {

            min-width: 120px;

        }


        /*
        Ville
        */

        .client-town {

            min-width: 110px;

        }


        /*
        Adresse
        */

        .client-address {

            min-width: 200px;

        }


        /*
        Actions
        */

        .client-actions .btn {

            padding: 0.25rem 0.4rem;

            font-size: 0.7rem;

        }

    }


    /*
    ============================================================
    TRES PETITS ECRANS
    ============================================================
    */

    @media (max-width: 400px) {

        .client-table {

            min-width: 780px;

            font-size: 0.7rem;

        }


        .client-table th,
        .client-table td {

            padding: 0.4rem 0.3rem;

        }


        /*
        Numéro
        */

        .client-number {

            min-width: 90px;

            font-size: 0.65rem;

        }


        /*
        Nom
        */

        .client-name {

            min-width: 105px;

        }


        /*
        Prénom
        */

        .client-firstname {

            min-width: 105px;

        }


        /*
        Téléphone
        */

        .client-phone {

            min-width: 110px;

        }


        /*
        Ville
        */

        .client-town {

            min-width: 100px;

        }


        /*
        Adresse
        */

        .client-address {

            min-width: 180px;

        }


        /*
        Actions
        */

        .client-actions .btn {

            padding: 0.2rem 0.3rem;

            font-size: 0.65rem;

        }

    }
</style>
