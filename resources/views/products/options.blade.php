<div class="d-flex justify-content-between align-items-center mb-2 my-2">

    <div>

        <h2 class="fw-bold mb-1">
            <i class="bi bi-box-seam-fill text-primary me-2"></i>
            Gestion des produits
        </h2>

    </div>

</div>

<div class="d-flex gap-2 mb-2">

    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#modal_category">

        <i class="bi bi-tags-fill me-1"></i>
        Catégories

    </button>

    <a href="{{ route('new_product') }}" class="btn btn-success">

        <i class="bi bi-plus-circle-fill me-1"></i>
        Nouveau

    </a>

</div>
@include('products.category.new_category', ['id' => 'modal_category'])
