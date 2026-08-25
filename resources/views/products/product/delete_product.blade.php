@php
$id;
$product;
@endphp

<div
    class="modal fade"
    id="{{'product_'.$id}}"
    tabindex="-1"
    aria-hidden="true">

<div class="modal-dialog modal-dialog-centered">

    <div class="modal-content border-0 shadow">

        {{-- Header --}}
        <div class="modal-header bg-danger text-white">

            <h5 class="modal-title fw-bold">

                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Confirmer la suppression

            </h5>

            <button
                type="button"
                class="btn-close btn-close-white"
                data-bs-dismiss="modal"
                aria-label="Fermer">
            </button>

        </div>


        {{-- Body --}}
        <div class="modal-body p-4 text-center">

            <div class="text-danger mb-3">

                <i class="bi bi-trash3-fill display-4"></i>

            </div>

            <h5 class="fw-bold mb-2">
                Supprimer ce produit ?
            </h5>

            <p class="text-muted mb-3">
                Vous êtes sur le point de supprimer le produit :
            </p>


            {{-- Produit concerné --}}
            <div class="alert alert-light border d-flex align-items-center text-start">

                <i class="bi bi-box-seam-fill fs-4 text-primary me-3"></i>

                <div>

                    <small class="text-muted d-block">
                        Produit concerné
                    </small>

                    <strong>
                        {{$product->name_product}}
                    </strong>

                </div>

            </div>


            {{-- Avertissement --}}
            <div class="alert alert-danger d-flex align-items-center text-start mb-0">

                <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i>

                <div>

                    <strong>Attention !</strong><br>

                    <small>
                        Cette action est irréversible.
                    </small>

                </div>

            </div>

        </div>


        {{-- Footer --}}
        <div class="modal-footer justify-content-center">

            <button
                type="button"
                class="btn btn-outline-secondary"
                data-bs-dismiss="modal">

                <i class="bi bi-x-circle me-1"></i>
                Annuler

            </button>

            <form
                action=""
                method="post">

                @csrf
                @method('delete')

                <button
                    class="btn btn-danger"
                    type="submit">

                    <i class="bi bi-trash3-fill me-1"></i>
                    Confirmer la suppression

                </button>

            </form>

        </div>

    </div>

</div>

</div>
