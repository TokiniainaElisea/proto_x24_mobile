@php
$id;
$client;
@endphp

<div class="modal fade shadow-lg" tabindex="-1" aria-hidden="true" id="{{$id}}">

<div class="modal-dialog modal-dialog-scrollable">

    <div class="modal-content border-0 shadow">

        <div class="modal-header bg-dark text-white">

            <div class="d-flex align-items-center">

                <div
                    class="bg-warning text-dark rounded-3 d-flex align-items-center justify-content-center me-3"
                    style="width: 42px; height: 42px;">

                    <i class="bi bi-person-gear fs-5"></i>

                </div>

                <div>

                    <h5 class="modal-title fw-bold mb-0">
                        Modifier le client
                    </h5>

                    <small class="text-secondary">
                        {{$client->title}} {{$client->name}} {{$client->firstname}}
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

            <form action="{{route('update_client', $client)}}" method="post">

                @csrf
                @method('put')

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

                        <option value="{{$client->title}}">
                            {{$client->title}}
                        </option>

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
                                value="{{$client->name}}">

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
                                value="{{$client->firstname}}">

                        </div>

                    </div>

                </div>

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
                            value="{{$client->phone}}">

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
                        value="{{$client->adress}}">

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
                        value="{{$client->town}}">

                </div>

                <div class="d-flex justify-content-end gap-2">

                    <button
                        type="reset"
                        class="btn btn-outline-secondary">

                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                        Réinitialiser

                    </button>

                    <button
                        type="submit"
                        class="btn btn-warning">

                        <i class="bi bi-floppy-fill me-1"></i>
                        Enregistrer

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</div>
