<div class="row">

    <div class="col-12">

        <div class="card shadow-sm border-0">

            {{-- ================================================= --}}
            {{-- HEADER                                             --}}
            {{-- ================================================= --}}

            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

                <h5 class="mb-0">

                    <i class="bi bi-truck me-2"></i>
                    Liste

                </h5>


                <span class="badge bg-primary">

                    {{ $providers->count() }} fournisseur(s)

                </span>

            </div>


            {{-- ================================================= --}}
            {{-- TABLEAU                                            --}}
            {{-- ================================================= --}}

            <div class="card-body p-2 p-md-3">

                <div class="provider-table-wrapper">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle provider-table mb-0">

                            <thead class="table-light">

                                <tr>

                                    <th>
                                        Nom
                                    </th>

                                    <th>
                                        E-mail
                                    </th>

                                    <th>
                                        Téléphone
                                    </th>

                                    <th class="text-center">
                                        Actions
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse ($providers as $provider)
                                    <tr>

                                        {{-- ================================= --}}
                                        {{-- FOURNISSEUR                        --}}
                                        {{-- ================================= --}}

                                        <td>

                                            <div class="d-flex align-items-center">

                                                <div
                                                    class="
                                                    provider-icon
                                                    text-primary
                                                    rounded-circle
                                                    d-flex
                                                    align-items-center
                                                    justify-content-center
                                                    me-3
                                                ">

                                                    <i class="bi bi-building fs-5"></i>

                                                </div>


                                                <div>

                                                    <div class="fw-semibold provider-name">

                                                        {{ $provider->name_provider }}

                                                    </div>

                                                    <small class="text-muted provider-id">

                                                        Fournisseur #{{ $provider->id }}

                                                    </small>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- ================================= --}}
                                        {{-- EMAIL                              --}}
                                        {{-- ================================= --}}

                                        <td>

                                            @if ($provider->mail)
                                                <a href="mailto:{{ $provider->mail }}"
                                                    class="text-decoration-none provider-email">

                                                    <i class="bi bi-envelope-fill text-primary me-1"></i>

                                                    {{ $provider->mail }}

                                                </a>
                                            @else
                                                <span class="text-muted">
                                                    Non renseigné
                                                </span>
                                            @endif

                                        </td>


                                        {{-- ================================= --}}
                                        {{-- TELEPHONE                          --}}
                                        {{-- ================================= --}}

                                        <td>

                                            @if ($provider->phone)
                                                <span class="provider-phone">

                                                    <i class="bi bi-telephone-fill text-success me-1"></i>

                                                    {{ '0' . $provider->phone }}

                                                </span>
                                            @else
                                                <span class="text-muted">
                                                    Non renseigné
                                                </span>
                                            @endif

                                        </td>


                                        {{-- ================================= --}}
                                        {{-- ACTIONS                            --}}
                                        {{-- ================================= --}}

                                        <td class="text-center">

                                            <div class="btn-group provider-actions">

                                                <button type="button" class="btn btn-warning btn-sm" title="Modifier"
                                                    data-bs-target="{{ '#provider_' . $provider->id }}"
                                                    data-bs-toggle="modal">

                                                    <i class="bi bi-pencil-square"></i>

                                                </button>


                                                <button type="button" class="btn btn-danger btn-sm" title="Supprimer"
                                                    data-bs-target="{{ '#delete_provider' . $provider->id }}"
                                                    data-bs-toggle="modal">

                                                    <i class="bi bi-trash3-fill"></i>

                                                </button>

                                            </div>


                                            {{-- MODAL EDIT --}}

                                            @include('fournisseurs.parts.edit', [
                                                'provider' => $provider,
                                            
                                                'id' => $provider->id,
                                            
                                                'name_provider' => $provider->name_provider,
                                            
                                                'mail' => $provider->mail,
                                            
                                                'phone' => $provider->phone,
                                            ])


                                            {{-- MODAL DELETE --}}

                                            @include('fournisseurs.parts.delete', [
                                                'id' => $provider->id,
                                            
                                                'provider' => $provider,
                                            ])

                                        </td>

                                    </tr>


                                @empty

                                    <tr>

                                        <td colspan="4" class="text-center text-muted py-5">

                                            <i class="bi bi-truck fs-1 d-block mb-2"></i>

                                            Aucun fournisseur enregistré.

                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- ============================================================ --}}
{{-- CSS                                                           --}}
{{-- ============================================================ --}}

<style>
    /*
    ============================================================
    CONTENEUR DU TABLEAU
    ============================================================
    */

    .provider-table-wrapper {

        width: 100%;
        max-width: 100%;

    }


    /*
    ============================================================
    SCROLL HORIZONTAL
    ============================================================
    */

    .provider-table-wrapper .table-responsive {

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
    ============================================================
    TABLEAU
    ============================================================
    */

    .provider-table {

        /*
        Sur desktop, le tableau prend toute la largeur.
        */

        width: 100%;

    }


    /*
    Sur mobile, le tableau peut devenir
    plus large que l'écran.
    */

    .provider-table th,
    .provider-table td {

        white-space: nowrap;

    }


    /*
    ============================================================
    COLONNE NOM
    ============================================================
    */

    .provider-name {

        min-width: 180px;

    }


    /*
    ============================================================
    EMAIL
    ============================================================
    */

    .provider-email {

        display: inline-flex;

        align-items: center;

        min-width: 220px;

        white-space: nowrap;

    }


    /*
    ============================================================
    TELEPHONE
    ============================================================
    */

    .provider-phone {

        display: inline-flex;

        align-items: center;

        min-width: 130px;

        white-space: nowrap;

    }


    /*
    ============================================================
    ICONE
    ============================================================
    */

    .provider-icon {

        width: 42px;
        height: 42px;

        flex-shrink: 0;

    }


    /*
    ============================================================
    ACTIONS
    ============================================================
    */

    .provider-actions {

        white-space: nowrap;

    }


    /*
    ============================================================
    MOBILE
    ============================================================
    */

    @media (max-width: 767.98px) {

        .provider-table {

            /*
            Le tableau devient légèrement
            plus petit visuellement.
            */

            min-width: 650px;

            font-size: 0.78rem;

        }


        .provider-table th,
        .provider-table td {

            padding: 0.5rem 0.4rem;

        }


        /*
        Icône
        */

        .provider-icon {

            width: 34px;
            height: 34px;

            margin-right: 0.5rem !important;

        }


        .provider-icon i {

            font-size: 0.9rem !important;

        }


        /*
        Nom
        */

        .provider-name {

            min-width: 150px;

            font-size: 0.78rem;

        }


        /*
        ID
        */

        .provider-id {

            font-size: 0.62rem;

        }


        /*
        Email
        */

        .provider-email {

            min-width: 190px;

            font-size: 0.72rem;

        }


        /*
        Téléphone
        */

        .provider-phone {

            min-width: 120px;

            font-size: 0.72rem;

        }


        /*
        Actions
        */

        .provider-actions .btn {

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

        .provider-table {

            min-width: 600px;

            font-size: 0.7rem;

        }


        .provider-table th,
        .provider-table td {

            padding: 0.4rem 0.3rem;

        }


        /*
        Icône
        */

        .provider-icon {

            width: 30px;
            height: 30px;

        }


        .provider-icon i {

            font-size: 0.75rem !important;

        }


        /*
        Nom
        */

        .provider-name {

            min-width: 135px;

            font-size: 0.7rem;

        }


        /*
        Email
        */

        .provider-email {

            min-width: 175px;

            font-size: 0.65rem;

        }


        /*
        Téléphone
        */

        .provider-phone {

            min-width: 110px;

            font-size: 0.65rem;

        }


        /*
        Actions
        */

        .provider-actions .btn {

            padding: 0.2rem 0.3rem;

            font-size: 0.65rem;

        }

    }
</style>
