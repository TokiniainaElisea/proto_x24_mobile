<div class="col-lg-6 mb-4">

    <div class="card shadow-sm border-0 h-100">

        <!-- Header -->
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                <i class="bi bi-box-seam-fill me-2"></i>
                État du stock
            </h5>

            <span class="badge bg-primary">
                Inventaire actuel
            </span>

        </div>


        <div class="card-body">

            <!-- Résumé -->
            <div class="row g-3 mb-4">

                <!-- Stock total -->
                <div class="col-4">

                    <div class="bg-light rounded-3 p-3 text-center">

                        <i class="bi bi-boxes fs-3 text-primary"></i>

                        <div class="text-muted small mt-1">
                            Stock total
                        </div>

                        <div class="fs-4 fw-bold">
                            {{ $stock['stockTotal'] }}
                        </div>

                        <small class="text-muted">
                            unités
                        </small>

                    </div>

                </div>


                <!-- Stock faible -->
                <div class="col-4">

                    <div class=" bg-opacity-10 rounded-3 p-3 text-center">

                        <i class="bi bi-exclamation-triangle-fill fs-3 text-warning"></i>

                        <div class="text-muted small mt-1">
                            Stock faible
                        </div>

                        <div class="fs-4 fw-bold text-warning">
                            {{ $stock['lowStock'] }}
                        </div>

                        <small class="text-muted">
                            produits
                        </small>

                    </div>

                </div>


                <!-- Rupture -->
                <div class="col-4">

                    <div class=" bg-opacity-10 rounded-3 p-3 text-center">

                        <i class="bi bi-x-circle-fill fs-3 text-danger"></i>

                        <div class="text-muted small mt-1">
                            Rupture
                        </div>

                        <div class="fs-4 fw-bold text-danger">
                            {{ $stock['outOfStock'] }}
                        </div>

                        <small class="text-muted">
                            produits
                        </small>

                    </div>

                </div>

            </div>


            <!-- Produits à surveiller -->
            <div class="d-flex justify-content-between align-items-center mb-3">

                <h6 class="fw-bold mb-0">
                    <i class="bi bi-exclamation-circle me-1 text-warning"></i>
                    Produits à surveiller
                </h6>

                <small class="text-muted">
                    Seuil : 10 unités
                </small>

            </div>

            @forelse($stock['toWatch'] as $product)
                @php
                    $quantity = $product->mouvement[0]->in_stock ?? 0;

                    $isOut = $quantity == 0;
                @endphp

                <div class="d-flex align-items-center border-bottom pb-2 mb-2">

                    <div class="rounded-3
            {{ $isOut ? 'bg-danger' : 'bg-warning' }}
            bg-opacity-10
            d-flex align-items-center justify-content-center me-3"
                        style="width:40px;height:40px;">

                        <i class="bi bi-box-seam
                {{ $isOut ? 'text-danger' : 'text-warning' }}">
                        </i>

                    </div>

                    <div class="flex-grow-1">

                        <strong>
                            {{ $product->name_product }}
                        </strong>

                        <br>

                        <small class="text-muted">
                            Réf : {{ $product->reference }}
                        </small>

                    </div>

                    <span class="badge
            {{ $isOut ? 'bg-danger' : 'bg-warning text-dark' }}">

                        @if ($isOut)
                            Rupture
                        @else
                            {{ $quantity }} en stock
                        @endif

                    </span>

                </div>

            @empty

                <div class="text-center py-4">

                    <i class="bi bi-check-circle-fill text-success fs-2"></i>

                    <p class="mb-0 mt-2">
                        Tous les stocks sont suffisants.
                    </p>

                    <small class="text-muted">
                        Aucun produit ne nécessite de surveillance.
                    </small>

                </div>
            @endforelse

        </div>

    </div>

</div>
