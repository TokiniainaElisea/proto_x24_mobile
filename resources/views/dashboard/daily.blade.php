<div class="d-flex justify-content-between align-items-center mb-2 my-2">

    <div>

        <h3 class="fw-bold mb-1">
            <i class="bi bi-speedometer2 text-primary me-2"></i>
            Tableau de bord
        </h3>

        <small class="text-muted">
            Résumé de l'activité d'aujourd'hui.
        </small>

    </div>

</div>

<div class="row g-4">

    <!-- Chiffre d'affaires -->
    <div class="col-xl-3 col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="text-muted">
                            Chiffre d'affaires
                        </div>

                        <div class="fs-3 fw-bold text-primary">

                            {{ number_format($dailyResume ?? 0,0,',',' ') }}

                            <small class="fs-6">Ar</small>

                        </div>

                    </div>

                    <div class="fs-1 text-primary">
                        <i class="bi bi-cash-stack"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Clients -->
    <div class="col-xl-3 col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="text-muted">
                            Clients
                        </div>

                        <div class="fs-3 fw-bold text-success">

                            {{ $clientNumber ?? 0 }}

                        </div>

                    </div>

                    <div class="fs-1 text-success">

                        <i class="bi bi-people-fill"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Produits -->
    <div class="col-xl-3 col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="text-muted">
                            Produits vendus
                        </div>

                        <div class="fs-3 fw-bold text-info">

                            {{ $productCount ?? 0 }}

                        </div>

                    </div>

                    <div class="fs-1 text-info">

                        <i class="bi bi-box-seam"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Panier moyen -->
    <div class="col-xl-3 col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="text-muted">
                            Panier moyen
                        </div>

                        <div class="fs-3 fw-bold text-warning">

                            {{ number_format($meanSale ?? 0,0,',',' ') }}

                            <small class="fs-6">Ar</small>

                        </div>

                    </div>

                    <div class="fs-1 text-warning">

                        <i class="bi bi-basket2-fill"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>