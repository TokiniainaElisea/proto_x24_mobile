<div class="card border-0 shadow-sm mb-4">

    {{-- ================================================= --}}
    {{-- HEADER                                             --}}
    {{-- ================================================= --}}

    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

        <div class="d-flex align-items-center">

            <i class="bi bi-funnel-fill text-primary me-2"></i>

            <span class="fw-semibold">
                Rechercher un client
            </span>

        </div>


        {{-- Bouton accordion --}}

        <button type="button" class="btn btn-sm btn-outline-light" data-bs-toggle="collapse"
            data-bs-target="#clientFilters"
            aria-expanded="{{ request()->hasAny(['name', 'firstname', 'client_number', 'phone']) ? 'true' : 'false' }}"
            aria-controls="clientFilters">

            <i class="bi bi-chevron-down"></i>

            <span class="d-none d-sm-inline ms-1">
                Filtres
            </span>

        </button>

    </div>


    {{-- ================================================= --}}
    {{-- CONTENU                                           --}}
    {{-- ================================================= --}}

    <div class="collapse {{ request()->hasAny(['name', 'firstname', 'client_number', 'phone']) ? 'show' : '' }}"
        id="clientFilters">

        <div class="card-body">

            <form action="{{ route('client') }}" method="get">

                <div class="row g-3 align-items-end">


                    {{-- ================================= --}}
                    {{-- NOM                                 --}}
                    {{-- ================================= --}}

                    <div class="col-lg-3 col-md-6">

                        <label for="name" class="form-label fw-semibold">

                            <i class="bi bi-person me-1 text-primary"></i>

                            Nom

                        </label>


                        <input type="text" id="name" name="name" class="form-control"
                            placeholder="Nom du client" value="{{ request('name') }}">

                    </div>


                    {{-- ================================= --}}
                    {{-- PRENOM                              --}}
                    {{-- ================================= --}}

                    <div class="col-lg-3 col-md-6">

                        <label for="firstname" class="form-label fw-semibold">

                            <i class="bi bi-person-badge me-1 text-primary"></i>

                            Prénom

                        </label>


                        <input type="text" id="firstname" name="firstname" class="form-control"
                            placeholder="Prénom du client" value="{{ request('firstname') }}">

                    </div>


                    {{-- ================================= --}}
                    {{-- NUMERO CLIENT                       --}}
                    {{-- ================================= --}}

                    <div class="col-lg-2 col-md-6">

                        <label for="client_number" class="form-label fw-semibold">

                            <i class="bi bi-person-vcard me-1 text-primary"></i>

                            N° client

                        </label>


                        <input type="text" id="client_number" name="client_number" class="form-control"
                            placeholder="N° client" value="{{ request('client_number') }}">

                    </div>


                    {{-- ================================= --}}
                    {{-- TELEPHONE                           --}}
                    {{-- ================================= --}}

                    <div class="col-lg-2 col-md-6">

                        <label for="phone" class="form-label fw-semibold">

                            <i class="bi bi-telephone me-1 text-primary"></i>

                            Téléphone

                        </label>


                        <input type="number" id="phone" name="phone" class="form-control" placeholder="Téléphone"
                            value="{{ request('phone') }}">

                    </div>


                    {{-- ================================= --}}
                    {{-- BOUTONS                             --}}
                    {{-- ================================= --}}

                    <div class="col-lg-2 col-md-12">

                        <div class="d-flex gap-2">

                            {{-- Rechercher --}}

                            <button type="submit" class="btn btn-primary flex-grow-1" title="Rechercher">

                                <i class="bi bi-search"></i>

                                <span class="d-none d-sm-inline ms-1">
                                    Rechercher
                                </span>

                            </button>


                            {{-- Réinitialiser --}}

                            <a href="{{ route('client') }}" class="btn btn-outline-secondary" title="Réinitialiser">

                                <i class="bi bi-arrow-counterclockwise"></i>

                            </a>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
