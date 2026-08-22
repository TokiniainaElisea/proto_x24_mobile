<div class="row g-4 mb-4">

    <!-- Chiffre d'affaires -->
    <div class="col-xl col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="text-muted">
                            Chiffre d'affaires
                        </div>

                        <div class="fs-3 fw-bold text-primary">

                            {{$turnover}}

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


    <!-- Bénéfice -->
    <div class="col-xl col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="text-muted">
                            Bénéfice
                        </div>

                        <div class="fs-3 fw-bold text-success">

                            {{$benefice}}

                            <small class="fs-6">Ar</small>

                        </div>

                    </div>

                    <div class="fs-1 text-success">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Clients -->
    <div class=" col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="text-muted">
                            Clients
                        </div>

                        <div class="fs-3 fw-bold text-info">

                            {{$clients}}

                        </div>

                    </div>

                    <div class="fs-1 text-info">

                        <i class="bi bi-people-fill"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Produits vendus -->
    <div class=" col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="text-muted">
                            Produits vendus
                        </div>

                        <div class="fs-3 fw-bold text-warning">

                            {{$products}}

                        </div>

                    </div>

                    <div class="fs-1 text-warning">

                        <i class="bi bi-box-seam-fill"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Panier moyen -->
    <div class="col-xl col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="text-muted">
                            Panier moyen
                        </div>

                        <div class="fs-3 fw-bold text-danger">

                            {{$meanSale}}

                            <small class="fs-6">Ar</small>

                        </div>

                    </div>

                    <div class="fs-1 text-danger">

                        <i class="bi bi-basket2-fill"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
