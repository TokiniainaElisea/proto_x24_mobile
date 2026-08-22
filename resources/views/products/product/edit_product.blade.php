@extends('layout')
@section('title', 'Modifier un produit')

@section('content')

<div class="container">

{{-- En-tête --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold mb-1">

            <i class="bi bi-pencil-square text-warning me-2"></i>
            Modifier le produit

        </h2>

        <small class="text-muted">

            Modifiez les informations et les caractéristiques de ce produit.

        </small>

    </div>

    <a
        href="{{ route('produits') }}"
        class="btn btn-outline-secondary">

        <i class="bi bi-arrow-left me-1"></i>
        Retour

    </a>

</div>


<form
    action="{{ route('update_product', $product) }}"
    method="post"
    enctype="multipart/form-data">

    @csrf
    @method('put')


    {{-- Informations générales --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-dark text-white">

            <h5 class="mb-0">

                <i class="bi bi-info-circle-fill me-2"></i>
                Informations générales

            </h5>

        </div>

        <div class="card-body p-4">

            <div class="row g-4">

                {{-- Image --}}
                <div class="col-lg-4">

                    <label class="form-label fw-semibold">

                        <i class="bi bi-image me-1 text-primary"></i>
                        Image actuelle

                    </label>

                    <div class="bg-light rounded p-3 text-center mb-3">

                        <img
                            src="{{ $product->image_path
                                ? asset($product->image_path)
                                : asset('uploads/product/sans.png') }}"
                            alt="{{ $product->name_product }}"
                            class="img-fluid rounded"
                            style="height: 220px; width: 100%; object-fit: contain;">

                    </div>

                    <label
                        for="image_path"
                        class="form-label fw-semibold">

                        <i class="bi bi-upload me-1"></i>
                        Remplacer l'image

                    </label>

                    <input
                        type="file"
                        name="image_path"
                        id="image_path"
                        class="form-control @error('image_path') is-invalid @enderror">

                    @error('image_path')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <small class="text-muted d-block mt-2">

                        Laissez vide pour conserver l'image actuelle.

                    </small>

                </div>


                {{-- Informations --}}
                <div class="col-lg-8">

                    <div class="row g-3">

                        {{-- Nom --}}
                        <div class="col-12">

                            <label
                                for="name_product"
                                class="form-label fw-semibold">

                                <i class="bi bi-box-seam me-1 text-primary"></i>
                                Nom du produit

                            </label>

                            <input
                                type="text"
                                name="name_product"
                                id="name_product"
                                class="form-control @error('name_product') is-invalid @enderror"
                                value="{{ old('name_product', $product->name_product) }}">

                            @error('name_product')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Référence --}}
                        <div class="col-md-6">

                            <label
                                for="reference"
                                class="form-label fw-semibold">

                                <i class="bi bi-upc-scan me-1 text-primary"></i>
                                Référence

                            </label>

                            <input
                                type="text"
                                name="reference"
                                id="reference"
                                class="form-control @error('reference') is-invalid @enderror"
                                value="{{ old('reference', $product->reference) }}">

                            @error('reference')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Prix --}}
                        <div class="col-md-6">

                            <label
                                for="price"
                                class="form-label fw-semibold">

                                <i class="bi bi-cash-stack me-1 text-success"></i>
                                Prix de vente

                            </label>

                            <div class="input-group">

                                <input
                                    type="number"
                                    name="price"
                                    id="price"
                                    class="form-control @error('price') is-invalid @enderror"
                                    value="{{ old('price', $product->price) }}">

                                <span class="input-group-text">
                                    Ar
                                </span>

                            </div>

                            @error('price')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Catégorie --}}
                        <div class="col-12">

                            <label
                                for="id_category"
                                class="form-label fw-semibold">

                                <i class="bi bi-tags-fill me-1 text-info"></i>
                                Catégorie

                            </label>

                            <select
                                name="id_category"
                                id="id_category"
                                class="form-select @error('id_category') is-invalid @enderror">

                                @foreach ($categories as $cat)

                                    <option
                                        value="{{ $cat->id }}"
                                        {{ old('id_category', $category->id) == $cat->id ? 'selected' : '' }}>

                                        {{ $cat->name_category }}

                                    </option>

                                @endforeach

                            </select>

                            @error('id_category')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Caractéristiques --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-dark text-white">

            <h5 class="mb-0">

                <i class="bi bi-sliders me-2"></i>
                Caractéristiques du produit

            </h5>

        </div>

        <div class="card-body p-4">

            <div class="row g-3">

                {{-- Taille --}}
                <div class="col-md-6">

                    <label
                        for="size"
                        class="form-label fw-semibold">

                        <i class="bi bi-rulers me-1 text-primary"></i>
                        Taille

                    </label>

                    <input
                        type="text"
                        name="size"
                        id="size"
                        class="form-control @error('size') is-invalid @enderror"
                        value="{{ old('size', $product->detail->size ?? '') }}">

                    @error('size')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Couleur --}}
                <div class="col-md-6">

                    <label
                        for="color"
                        class="form-label fw-semibold">

                        <i class="bi bi-palette-fill me-1 text-warning"></i>
                        Couleur

                    </label>

                    <input
                        type="text"
                        name="color"
                        id="color"
                        class="form-control @error('color') is-invalid @enderror"
                        value="{{ old('color', $product->detail->color ?? '') }}">

                    @error('color')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Matière --}}
                <div class="col-md-6">

                    <label
                        for="matter"
                        class="form-label fw-semibold">

                        <i class="bi bi-layers-fill me-1 text-secondary"></i>
                        Matière

                    </label>

                    <input
                        type="text"
                        name="matter"
                        id="matter"
                        class="form-control @error('matter') is-invalid @enderror"
                        value="{{ old('matter', $product->detail->matter ?? '') }}">

                    @error('matter')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Fournisseur --}}
                <div class="col-md-6">

                    <label
                        for="id_provider"
                        class="form-label fw-semibold">

                        <i class="bi bi-truck me-1 text-info"></i>
                        Fournisseur

                    </label>

                    <select
                        name="id_provider"
                        id="id_provider"
                        class="form-select @error('id_provider') is-invalid @enderror">

                        @foreach ($providers as $provider)

                            <option
                                value="{{ $provider->id }}"
                                {{ old('id_provider', $product->provider->id ?? '') == $provider->id ? 'selected' : '' }}>

                                {{ $provider->name_provider }}

                            </option>

                        @endforeach

                    </select>

                    @error('id_provider')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

        </div>

    </div>


    {{-- Informations stock --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-dark text-white">

            <h5 class="mb-0">

                <i class="bi bi-boxes me-2"></i>
                Stock

            </h5>

        </div>

        <div class="card-body">

            <div class="alert alert-info mb-0 d-flex align-items-center">

                <i class="bi bi-info-circle-fill fs-5 me-2"></i>

                <div>

                    La quantité en stock et le prix fournisseur sont gérés
                    depuis la section <strong>Gestion du stock</strong>.

                    <a
                        href="{{ route('show_mouvement', $product) }}"
                        class="alert-link">

                        Gérer le stock

                    </a>

                </div>

            </div>

        </div>

    </div>


    {{-- Actions --}}
    <div class="d-flex justify-content-end gap-2 mb-5">

        <a
            href="{{ route('produits') }}"
            class="btn btn-outline-secondary">

            <i class="bi bi-x-circle me-1"></i>
            Annuler

        </a>

        <button
            type="submit"
            class="btn btn-success">

            <i class="bi bi-floppy-fill me-1"></i>
            Enregistrer les modifications

        </button>

    </div>

</form>

</div>

@endsection
