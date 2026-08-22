@php
    $id;
    $category;
@endphp

<div class="modal fade" id="{{'category_detelte_'.$id}}" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content border-0 shadow-lg text-center">

            {{-- Header --}}
            <div class="modal-header bg-danger text-white border-0">

                <div class="d-flex align-items-center">

                    <div class=" bg-opacity-25 rounded-3
                                d-flex align-items-center justify-content-center me-3"
                        style="width: 42px; height: 42px;">

                        <i class="bi bi-exclamation-triangle-fill fs-5"></i>

                    </div>

                    <div>

                        <h5 class="modal-title fw-bold mb-0">
                            Supprimer la catégorie
                        </h5>

                        <small class="text-white-50">
                            Cette action nécessite une confirmation
                        </small>

                    </div>

                </div>

                <button class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>


            {{-- Body --}}
            <div class="modal-body p-4">

                <div class="text-center mb-4">

                    <div class="bg-opacity-10 rounded-circle
                                d-inline-flex align-items-center justify-content-center mb-3"
                        style="width: 70px; height: 70px;">

                        <i class="bi bi-trash3-fill text-danger fs-2"></i>

                    </div>

                    <h5 class="fw-bold">
                        Voulez-vous vraiment supprimer cette catégorie ?
                    </h5>

                    <div class="mt-2">

                        <span class="badge bg-light text-dark border fs-6 px-3 py-2">

                            <i class="bi bi-tag-fill text-primary me-1"></i>

                            {{$category->name_category}}

                        </span>

                    </div>

                </div>


                {{-- Warning --}}
                <div class="alert alert-danger border-0 d-flex align-items-start">

                    <i class="bi bi-exclamation-triangle-fill me-2 mt-1"></i>

                    <div>

                        <strong>Attention !</strong>

                        <div class="small mt-1">
                            Tous les produits associés à cette catégorie
                            seront également supprimés.
                        </div>

                    </div>

                </div>


                <div class="text-muted small text-center mb-3">

                    <i class="bi bi-info-circle me-1"></i>

                    Cette action est irréversible.

                </div>


                {{-- Actions --}}
                <form action="{{route('delete_category', $category)}}" method="post">

                    @csrf
                    @method('delete')

                    <div class="d-flex justify-content-center gap-2">

                        <button type="button"
                            class="btn btn-outline-secondary px-4"
                            data-bs-dismiss="modal">

                            <i class="bi bi-x-lg me-1"></i>
                            Annuler

                        </button>

                        <button type="submit"
                            class="btn btn-danger px-4">

                            <i class="bi bi-trash3 me-1"></i>
                            Confirmer la suppression

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>