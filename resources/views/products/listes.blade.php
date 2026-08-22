<div class="card border-0 shadow-sm my-4">

    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

        <div>

            <h5 class="mb-0 fw-bold">
                <i class="bi bi-box-seam me-2"></i>
                Liste des produits
            </h5>

        </div>

        <span class="badge bg-primary">
            <i class="bi bi-boxes me-1"></i>
            Produits
        </span>

    </div>

    <div class="card-body">

        @include('products.liste.list_row')

    </div>

</div>