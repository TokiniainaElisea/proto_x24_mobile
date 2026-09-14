<div class="card shadow-sm my-3">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

        <h5 class="mb-0">

            <i class="bi bi-funnel-fill me-2"></i>
            Recherchez un Fournisseur

        </h5>

        <button class="btn btn-sm btn-outline-light" type="button" data-bs-toggle="collapse" data-bs-target="#providerFilters"
            aria-expanded="true" aria-controls="providerFilters">

            <i class="bi bi-chevron-down"></i>

        </button>

    </div>

    <div class="accordion-collapse collapse" id="providerFilters">

        <div class="card-body">

            <form method="GET">

                <div class="row g-3">


                    <div class="col-lg-2 col-md-6">

                        <label class="form-label">

                            <i class="bi bi-receipt me-1 text-warning"></i>
                            Nom

                        </label>

                        <input type="text" name="name_provider" class="form-control" placeholder="Nom/Raison social..."
                            value="{{ request('name_provider') }}">

                    </div>


                    <div class="col-lg-2 col-md-6">

                        <label class="form-label">

                            <i class="bi bi-phone me-1 text-success"></i>
                            Téléphone

                        </label>

                        <input type="number" name="phone" class="form-control" placeholder="Téléphone"
                            value="{{ request('phone') }}">

                    </div>


                    <div class="col-lg-4 col-md-12">

                        <label class="form-label">

                            <i class="bi bi-person-fill me-1 text-info"></i>
                            E-mail

                        </label>

                        <input type="e-mail" name="mail" class="form-control" placeholder="Adresse e-mail..."
                            value="{{ request('mail') }}">

                    </div>

                </div>


                <hr>


                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('provider') }}" class="btn btn-outline-secondary">

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
