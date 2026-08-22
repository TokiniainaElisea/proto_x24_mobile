<div class="modal fade"
     id="{{ $id }}"
     tabindex="-1"
     aria-labelledby="{{ $id }}Label"
     aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content border-0 shadow">

            {{-- Header --}}
            <div class="modal-header bg-dark text-white">

                <h5 class="modal-title fw-bold" id="{{ $id }}Label">

                    <i class="bi bi-truck me-2"></i>
                    Ajouter un fournisseur

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

                <form action="{{ route('new_provider') }}"
                      method="POST">

                    @csrf

                    {{-- Nom --}}
                    <div class="mb-3">

                        <label for="name_provider" class="form-label fw-semibold">

                            <i class="bi bi-building me-1 text-primary"></i>
                            Nom du fournisseur

                        </label>

                        <input
                            type="text"
                            name="name_provider"
                            id="name_provider"
                            class="form-control @error('name_provider') is-invalid @enderror"
                            placeholder="Ex : ABC Distribution"
                            value="{{ old('name_provider') }}"
                            required>

                        @error('name_provider')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                    {{-- Email --}}
                    <div class="mb-3">

                        <label for="mail" class="form-label fw-semibold">

                            <i class="bi bi-envelope me-1 text-primary"></i>
                            Adresse e-mail

                        </label>

                        <input
                            type="email"
                            name="mail"
                            id="mail"
                            class="form-control @error('mail') is-invalid @enderror"
                            placeholder="Ex : contact@fournisseur.com"
                            value="{{ old('mail') }}"
                            required>

                        @error('mail')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                    {{-- Téléphone --}}
                    <div class="mb-4">

                        <label for="phone" class="form-label fw-semibold">

                            <i class="bi bi-telephone me-1 text-success"></i>
                            Téléphone

                        </label>

                        <input
                            type="tel"
                            name="phone"
                            id="phone"
                            class="form-control @error('phone') is-invalid @enderror"
                            placeholder="Ex : 341234567"
                            value="{{ old('phone') }}"
                            required>

                        @error('phone')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

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
                            class="btn btn-success">

                            <i class="bi bi-plus-circle-fill me-1"></i>
                            Ajouter

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>