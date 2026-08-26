@php
    $provider;
    $id;
    $name_provider;
    $mail;
    $phone;
@endphp

<div class="modal fade"
     id="{{'provider_'.$id}}"
     aria-hidden="true"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-scrollable">

        <div class="modal-content border-0 shadow">

            {{-- Header --}}
            <div class="modal-header bg-dark text-white">

                <h5 class="modal-title fw-bold">

                    <i class="bi bi-pencil-square me-2"></i>
                    Modifier le fournisseur

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Fermer">
                </button>

            </div>

            {{-- Body --}}
            <div class="modal-body p-4">

                <form action="{{route('update_provider',$provider)}}"
                      method="post">

                    @csrf
                    @method('put')

                    {{-- Nom --}}
                    <div class="mb-3">

                        <label for="name_provider_{{$id}}"
                               class="form-label fw-semibold">

                            <i class="bi bi-building me-1 text-primary"></i>
                            Nom du fournisseur

                        </label>

                        <input
                            type="text"
                            name="name_provider"
                            id="name_provider_{{$id}}"
                            class="form-control"
                            value="{{$name_provider}}"
                            placeholder="Nom du fournisseur"
                            required>

                    </div>

                    {{-- Email --}}
                    <div class="mb-3">

                        <label for="mail_{{$id}}"
                               class="form-label fw-semibold">

                            <i class="bi bi-envelope me-1 text-primary"></i>
                            Adresse e-mail

                        </label>

                        <input
                            type="email"
                            name="mail"
                            id="mail_{{$id}}"
                            class="form-control"
                            value="{{$mail}}"
                            placeholder="Adresse e-mail"
                            required>

                    </div>

                    {{-- Téléphone --}}
                    <div class="mb-4">

                        <label for="phone_{{$id}}"
                               class="form-label fw-semibold">

                            <i class="bi bi-telephone me-1 text-success"></i>
                            Téléphone

                        </label>

                        <input
                            type="tel"
                            name="phone"
                            id="phone_{{$id}}"
                            class="form-control"
                            value="{{$phone}}"
                            placeholder="Numéro de téléphone"
                            required>

                    </div>

                    {{-- Actions --}}
                    <div class="d-flex justify-content-end gap-2">

                        <button
                            type="button"
                            class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">

                            <i class="bi bi-x-circle me-1"></i>
                            Annuler

                        </button>

                        <button
                            type="submit"
                            class="btn btn-warning">

                            <i class="bi bi-check-circle-fill me-1"></i>
                            Enregistrer

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
