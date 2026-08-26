@php
$id;
@endphp

<div class="modal fade shadow-lg" tabindex="-1" aria-hidden="true" id="{{$id}}">

<div class="modal-dialog modal-dialog-scrollable">

    <div class="modal-content border-0 shadow">

        <div class="modal-header bg-dark text-white">

            <div class="d-flex align-items-center">

                <div
                    class="bg-primary rounded-3 d-flex align-items-center justify-content-center me-3"
                    style="width: 42px; height: 42px;">

                    <i class="bi bi-person-plus-fill fs-5"></i>

                </div>

                <div>

                    <h5 class="modal-title fw-bold mb-0">
                        Nouveau client
                    </h5>

                    <small class="text-secondary">
                        Ajouter un client à votre base
                    </small>

                </div>

            </div>

            <button
                type="button"
                class="btn-close btn-close-white"
                data-bs-dismiss="modal"
                aria-label="Close">
            </button>

        </div>

        <div class="modal-body p-4">

            <form action="{{route('new_client')}}" method="post">

                @csrf

                <div class="mb-3">

                    <label
                        for="civilité"
                        class="form-label fw-semibold">

                        <i class="bi bi-person-vcard text-primary me-1"></i>
                        Civilité

                    </label>

                    <select
                        name="title"
                        class="form-select">

                        <option value="Mr.">
                            Mr.
                        </option>

                        <option value="Mme.">
                            Mme.
                        </option>

                        <option value="Mle.">
                            Mle.
                        </option>

                    </select>

                </div>

                <div class="row">

                    <div class="col-6">

                        <div class="mb-3">

                            <label
                                for="name"
                                class="form-label fw-semibold">

                                Nom

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="name"
                                placeholder="Nom">

                        </div>

                    </div>


                    <div class="col-6">

                        <div class="mb-3">

                            <label
                                for="firstname"
                                class="form-label fw-semibold">

                                Prénom

                            </label>

                            <input
                                type="text"
                                name="firstname"
                                class="form-control"
                                placeholder="Prénom">

                        </div>

                    </div>

                </div>


                {{-- Téléphone --}}
                <div class="mb-3">

                    <label
                        for="phone"
                        class="form-label fw-semibold">

                        <i class="bi bi-telephone text-success me-1"></i>
                        Téléphone

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-phone"></i>
                        </span>

                        <input
                            type="number"
                            class="form-control"
                            name="phone"
                            placeholder="Numéro de téléphone">

                    </div>

                </div>
                <div class="mb-3">

                    <label
                        for="adress"
                        class="form-label fw-semibold">

                        <i class="bi bi-geo-alt text-danger me-1"></i>
                        Adresse / Lot

                    </label>

                    <input
                        type="text"
                        name="adress"
                        class="form-control"
                        placeholder="Ex : Lot II A 123">

                </div>

                <div class="mb-4">

                    <label
                        for="town"
                        class="form-label fw-semibold">

                        <i class="bi bi-buildings text-primary me-1"></i>
                        Ville

                    </label>

                    <input
                        type="text"
                        name="town"
                        class="form-control"
                        placeholder="Ville">

                </div>

                <div class="d-flex justify-content-end gap-2">

                    <button
                        type="reset"
                        class="btn btn-outline-secondary">

                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                        Effacer

                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-person-check-fill me-1"></i>
                        Enregistrer

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</div>
