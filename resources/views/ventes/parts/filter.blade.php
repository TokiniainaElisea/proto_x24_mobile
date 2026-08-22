<div class="card shadow-sm my-3">

    {{-- ================================================= --}}
    {{-- HEADER                                             --}}
    {{-- ================================================= --}}

    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

        <h5 class="mb-0">

            <i class="bi bi-funnel-fill me-2"></i>
            Filtrer les ventes

        </h5>


        {{-- Bouton accordion --}}

        <button class="btn btn-sm btn-outline-light" type="button" data-bs-toggle="collapse" data-bs-target="#salesFilters"
            aria-expanded="false" aria-controls="salesFilters">

            <i class="bi bi-chevron-down"></i>

            <span class="d-none d-sm-inline ms-1">
                Filtres
            </span>

        </button>

    </div>


    {{-- ================================================= --}}
    {{-- CONTENU ACCORDION                                 --}}
    {{-- ================================================= --}}

    <div class="collapse" id="salesFilters">

        <div class="card-body">

            <form method="GET">

                <div class="row g-3">


                    {{-- ================================ --}}
                    {{-- DATE DEBUT                       --}}
                    {{-- ================================ --}}

                    <div class="col-lg-2 col-md-6">

                        <label class="form-label">

                            <i class="bi bi-calendar-event me-1 text-primary"></i>
                            Début

                        </label>

                        <input type="date" name="begin" class="form-control" value="{{ request('begin') }}">

                    </div>


                    {{-- ================================ --}}
                    {{-- DATE FIN                         --}}
                    {{-- ================================ --}}

                    <div class="col-lg-2 col-md-6">

                        <label class="form-label">

                            <i class="bi bi-calendar-check me-1 text-success"></i>
                            Fin

                        </label>

                        <input type="date" name="ending" class="form-control" value="{{ request('ending') }}">

                    </div>


                    {{-- ================================ --}}
                    {{-- COMMANDE                          --}}
                    {{-- ================================ --}}

                    <div class="col-lg-2 col-md-6">

                        <label class="form-label">

                            <i class="bi bi-receipt me-1 text-warning"></i>
                            Commande

                        </label>

                        <input type="text" name="order_number" class="form-control" placeholder="Référence..."
                            value="{{ request('order_number') }}">

                    </div>


                    {{-- ================================ --}}
                    {{-- MONTANT                           --}}
                    {{-- ================================ --}}

                    <div class="col-lg-2 col-md-6">

                        <label class="form-label">

                            <i class="bi bi-cash-stack me-1 text-success"></i>
                            Montant

                        </label>

                        <input type="number" name="montant" class="form-control" placeholder="Montant"
                            value="{{ request('montant') }}">

                    </div>


                    {{-- ================================ --}}
                    {{-- CLIENT                            --}}
                    {{-- ================================ --}}

                    <div class="col-lg-4 col-md-12">

                        <label class="form-label">

                            <i class="bi bi-person-fill me-1 text-info"></i>
                            Client

                        </label>

                        <input type="text" name="name_client" class="form-control" placeholder="Nom du client..."
                            value="{{ request('name_client') }}">

                    </div>

                </div>


                <hr>


                {{-- ================================ --}}
                {{-- BOUTONS                           --}}
                {{-- ================================ --}}

                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('ventes') }}" class="btn btn-outline-secondary">

                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                        Réinitialiser

                    </a>


                    <button type="submit" class="btn btn-primary">

                        <i class="bi bi-search me-1"></i>
                        Rechercher

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
