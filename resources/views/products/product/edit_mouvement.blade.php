@php
    $id;
    $stock;
@endphp
<div class="modal fade shadow-lg" id="{{ $id }}" aria-hidden="true" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow">

            {{-- Header --}}
            <div class="modal-header bg-dark text-white">

                <div class="d-flex align-items-center">

                    <div class="bg-success rounded-3 d-flex align-items-center justify-content-center me-3"
                        style="width: 42px; height: 42px;">

                        <i class="bi bi-box-arrow-in-down fs-5"></i>

                    </div>

                    <div>

                        <h5 class="modal-title fw-bold mb-0">
                            Modifier le stock
                        </h5>

                        <small class="text-secondary">
                            Ajustez les informations relatives au stock
                        </small>

                    </div>

                </div>

                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
                </button>

            </div>


            {{-- Corps --}}
            <div class="modal-body p-4">

                <form action="{{ route('update_mouvement', $stock) }}" method="post">
                    @method('put')
                    @csrf

                    <input type="number" class="d-none" name="product_id" value="{{ $stock->product_id }}">
                    {{-- Quantité --}}
                    <div class="mb-3">

                        <label for="initial_quantity" class="form-label fw-semibold">

                            <i class="bi bi-boxes text-success me-1"></i>
                            Quantité initiale

                        </label>

                        <input type="number" name="initial_quantity" id="initial_quantity" class="form-control"
                            min="1" placeholder="Ex : 50" value="{{ $stock->initial_quantity }}">

                        <small class="text-muted">
                            Nombre d'articles ajoutés au stock.
                        </small>

                    </div>

                    <div class="mb-3">

                        <label for="initial_quantity" class="form-label fw-semibold">

                            <i class="bi bi-boxes text-success me-1"></i>
                            Quantité en stock

                        </label>

                        <input type="number" name="in_stock" id="in_stock" class="form-control"
                            min="1" placeholder="Ex : 50" value="{{ $stock->in_stock }}">

                        <small class="text-muted">
                            Nombre d'articles en stock.
                        </small>

                    </div>


                    {{-- Prix fournisseur --}}
                    <div class="mb-3">

                        <label for="provider_price" class="form-label fw-semibold">

                            <i class="bi bi-cash-coin text-warning me-1"></i>
                            Prix fournisseur

                        </label>

                        <div class="input-group">

                            <input type="number" name="provider_price" id="provider_price" class="form-control"
                                min="0" placeholder="Prix d'achat" value="{{ $stock->provider_price }}">

                            <span class="input-group-text">
                                Ar
                            </span>

                        </div>

                    </div>


                    {{-- Date d'entrée --}}
                    <div class="mb-4">

                        <label for="enter_date" class="form-label fw-semibold">

                            <i class="bi bi-calendar-event text-primary me-1"></i>
                            Date d'entrée

                        </label>

                        <input type="date" name="enter_date" id="enter_date" class="form-control"
                            value="{{ $stock->enter_date }}">

                    </div>


                    {{-- Actions --}}
                    <div class="d-flex justify-content-end gap-2">

                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">

                            <i class="bi bi-x-lg me-1"></i>
                            Annuler

                        </button>

                        <button type="submit" class="btn btn-warning" id="btn_submit">

                            <i class="bi bi-box-arrow-in-down me-1"></i>
                            Enregistrer

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
