@extends('layout')

@section('content')
    <div class="container p-2">

        {{-- En-tête --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div class="d-flex align-items-center">

                <div class="bg-warning bg-opacity-10 rounded-3
                        d-flex align-items-center justify-content-center me-3"
                    style="width: 50px; height: 50px;">

                    <i class="bi bi-pencil-square text-warning fs-3"></i>

                </div>

                <div>

                    <h2 class="fw-bold mb-0">
                        Modifier le fournisseur
                    </h2>

                </div>

            </div>

            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">

                <i class="bi bi-arrow-left me-1"></i>
            </a>

        </div>


        <form action="{{ route('update_provider', $provider) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="row g-4">


                {{-- ============================= --}}
                {{-- INFORMATIONS DU FOURNISSEUR --}}
                {{-- ============================= --}}

                <div class="col-lg-8">

                    <div class="card border-0 shadow-sm">

                        <div class="card-header bg-dark text-white">

                            <h5 class="mb-0">

                                <i class="bi bi-building-fill me-2"></i>
                                Informations du fournisseur

                            </h5>

                        </div>


                        <div class="card-body">

                            <div class="row g-3">

                                {{-- Nom --}}
                                <div class="col-12">

                                    <label for="name_provider" class="form-label fw-semibold">

                                        <i class="bi bi-shop me-1 text-primary"></i>
                                        Nom du fournisseur
                                        <span class="text-danger">*</span>

                                    </label>

                                    <input type="text" id="name_provider" name="name_provider"
                                        class="form-control @error('name_provider') is-invalid @enderror"
                                        value="{{ old('name_provider', $provider->name_provider) }}" required>

                                    @error('name_provider')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>


                                {{-- Email --}}
                                <div class="col-md-6">

                                    <label for="mail" class="form-label fw-semibold">

                                        <i class="bi bi-envelope-fill me-1 text-primary"></i>
                                        Adresse e-mail

                                    </label>

                                    <input type="email" id="mail" name="mail"
                                        class="form-control @error('mail') is-invalid @enderror"
                                        value="{{ old('mail', $provider->mail) }}" placeholder="contact@entreprise.com">

                                    @error('mail')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>


                                {{-- Téléphone --}}
                                <div class="col-md-6">

                                    <label for="phone" class="form-label fw-semibold">

                                        <i class="bi bi-telephone-fill me-1 text-success"></i>
                                        Téléphone

                                    </label>

                                    <input type="text" id="phone" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone', $provider->phone) }}" placeholder="Ex : 034 00 000 00">

                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>


                                {{-- Adresse --}}
                                <div class="col-12">

                                    <label for="adress" class="form-label fw-semibold">

                                        <i class="bi bi-geo-alt-fill me-1 text-danger"></i>
                                        Adresse

                                    </label>

                                    <input type="text" id="adress" name="adress"
                                        class="form-control @error('adress') is-invalid @enderror"
                                        value="{{ old('adress', $provider->adress) }}" placeholder="Adresse du fournisseur">

                                    @error('adress')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>


                                {{-- Ville --}}
                                <div class="col-md-6">

                                    <label for="town" class="form-label fw-semibold">

                                        <i class="bi bi-geo-fill me-1 text-info"></i>
                                        Ville

                                    </label>

                                    <input type="text" id="town" name="town"
                                        class="form-control @error('town') is-invalid @enderror"
                                        value="{{ old('town', $provider->town) }}" placeholder="Ex : Antananarivo">

                                    @error('town')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>


                                {{-- Pays --}}
                                <div class="col-md-6">

                                    <label for="pays" class="form-label fw-semibold">

                                        <i class="bi bi-globe2 me-1 text-success"></i>
                                        Pays

                                    </label>

                                    <input type="text" id="pays" name="pays"
                                        class="form-control @error('pays') is-invalid @enderror"
                                        value="{{ old('pays', $provider->pays) }}" placeholder="Ex : Madagascar">

                                    @error('pays')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ============================= --}}
                {{-- CONTACT --}}
                {{-- ============================= --}}

                <div class="col-lg-4">

                    <div class="card border-0 shadow-sm h-100">

                        <div class="card-header bg-dark text-white">

                            <h5 class="mb-0">

                                <i class="bi bi-person-lines-fill me-2"></i>
                                Contact

                            </h5>

                        </div>


                        <div class="card-body">

                            <label for="name_contact" class="form-label fw-semibold">

                                <i class="bi bi-person-fill me-1 text-primary"></i>
                                Personne à contacter

                            </label>

                            <input type="text" id="name_contact" name="name_contact"
                                class="form-control @error('name_contact') is-invalid @enderror"
                                value="{{ old('name_contact', $provider->name_contact) }}" placeholder="Nom du contact">

                            @error('name_contact')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror


                            <div class="alert alert-light border mt-4 mb-0">

                                <div class="d-flex">

                                    <i class="bi bi-info-circle-fill text-primary me-2"></i>

                                    <small class="text-muted">

                                        Vous pouvez indiquer ici le nom du commercial,
                                        responsable ou interlocuteur habituel.

                                    </small>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ============================= --}}
                {{-- NOTES --}}
                {{-- ============================= --}}

                <div class="col-12">

                    <div class="card border-0 shadow-sm">

                        <div class="card-header bg-dark text-white">

                            <h5 class="mb-0">

                                <i class="bi bi-sticky-fill me-2"></i>
                                Notes

                            </h5>

                        </div>


                        <div class="card-body">

                            <label for="note" class="form-label fw-semibold">

                                <i class="bi bi-pencil-square me-1 text-warning"></i>
                                Informations complémentaires

                            </label>

                            <textarea id="note" name="note" rows="4" class="form-control @error('note') is-invalid @enderror"
                                placeholder="Ajoutez une remarque concernant ce fournisseur...">{{ old('note', $provider->note) }}</textarea>

                            @error('note')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                </div>


                {{-- ============================= --}}
                {{-- ACTIONS --}}
                {{-- ============================= --}}

                <div class="col-12">

                    <div class="d-flex justify-content-end gap-2 mb-4">

                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">

                            <i class="bi bi-x-lg me-1"></i>
                            Annuler

                        </a>

                        <button type="submit" class="btn btn-success px-4">

                            <i class="bi bi-check-lg me-1"></i>
                            Enregistrer

                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>
@endsection
