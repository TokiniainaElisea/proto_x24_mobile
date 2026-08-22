@php
    $id;
    $category;
    $name_category;
@endphp

<div class="modal fade" id="{{'category_'.$id}}" aria-hidden="true" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content border-0 shadow-lg">

            {{-- Header --}}
            <div class="modal-header bg-dark text-white border-0">

                <div class="d-flex align-items-center">

                    <div class="bg-warning bg-opacity-25 rounded-3
                                d-flex align-items-center justify-content-center me-3"
                        style="width: 42px; height: 42px;">

                        <i class="bi bi-pencil-square text-warning fs-5"></i>

                    </div>

                    <div>
                        <h5 class="modal-title fw-bold mb-0">
                            Modifier la catégorie
                        </h5>
                    </div>

                </div>

                <button class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>


            {{-- Body --}}
            <div class="modal-body p-4">

                <form action="{{route('update_category', $category)}}" method="post">

                    @csrf
                    @method('put')

                    <div class="mb-3">

                        <label for="name_category"
                            class="form-label fw-semibold">

                            <i class="bi bi-tag-fill text-primary me-1"></i>
                            Nom de la catégorie

                        </label>

                        <input
                            type="text"
                            value="{{$name_category}}"
                            name="name_category"
                            id="name_category"
                            class="form-control form-control-lg"
                            placeholder="Nom de la catégorie"
                            required
                            autofocus>

                        <small class="text-muted">
                            Le nom sera utilisé pour identifier les produits
                            associés à cette catégorie.
                        </small>

                    </div>


                    {{-- Aperçu --}}
                    <div class="bg-light rounded-3 p-3 mb-3">

                        <div class="text-muted small mb-1">
                            Catégorie actuelle
                        </div>

                        <div class="d-flex align-items-center">

                            <div class="bg-primary bg-opacity-10 rounded-2
                                        d-flex align-items-center justify-content-center me-2"
                                style="width: 36px; height: 36px;">

                                <i class="bi bi-tag-fill text-primary"></i>

                            </div>

                            <strong>
                                {{$name_category}}
                            </strong>

                        </div>

                    </div>


                    {{-- Footer actions --}}
                    <div class="d-flex justify-content-end gap-2">

                        <button type="button"
                            class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">

                            <i class="bi bi-x-lg me-1"></i>
                            Annuler

                        </button>

                        <button type="submit"
                            class="btn btn-success">

                            <i class="bi bi-check-lg me-1"></i>
                            Enregistrer

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>