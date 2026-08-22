@extends('layout')
@section('title', 'Informations sur un produit')

@section('content')

<div class="container">

{{-- En-tête --}}
<div class="d-flex justify-content-between align-items-center mb-2 my-2"> 

    <div>

        <h2 class="fw-bold mb-1">
            <i class="bi bi-box-seam-fill text-primary me-2"></i>
            Informations du produit
        </h2>

    </div>

</div>

   <div class="d-flex gap-2 mb-2">

        <a href="{{ route('modify_product', $product) }}"
           class="btn btn-warning">

            <i class="bi bi-pencil-square me-1"></i>
            Modifier

        </a>

        <a href="{{ route('show_mouvement', $product) }}"
           class="btn btn-success">

            <i class="bi bi-boxes me-1"></i>
            Gérer le stock

        </a>

    </div>


<div class="row g-2">

    {{-- Informations principales --}}
    <div class="col-lg-5">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-dark text-white">

                <h5 class="mb-0">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    Informations générales
                </h5>

            </div>

            <div class="card-body p-0">

                {{-- Image --}}
                <div class="bg-light text-center p-4">

                    <img
                        src="{{ $product->image_path
                            ? asset($product->image_path)
                            : asset('uploads/product/sans.png') }}"
                        alt="{{ $product->name_product }}"
                        class="img-fluid rounded"
                        style="max-height: 320px; object-fit: contain;">

                </div>

                <div class="p-4">

                    {{-- Nom --}}
                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Nom du produit
                        </small>

                        <h4 class="fw-bold mb-0">
                            {{ $product->name_product ?? 'Non défini' }}
                        </h4>

                    </div>

                    {{-- Référence --}}
                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Référence
                        </small>

                        <span class="badge bg-secondary fs-6">
                            <i class="bi bi-upc-scan me-1"></i>
                            {{ $product->reference ?? 'Non défini' }}
                        </span>

                    </div>

                    {{-- Prix --}}
                    <div>

                        <small class="text-muted d-block">
                            Prix de vente
                        </small>

                        <span class="badge bg-success fs-5">

                            {{ number_format($product->price ?? 0, 0, ',', ' ') }} Ar

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Informations secondaires --}}
    <div class="col-lg-7">

        {{-- Caractéristiques --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-dark text-white">

                <h5 class="mb-0">
                    <i class="bi bi-sliders me-2"></i>
                    Caractéristiques du produit
                </h5>

            </div>

            <div class="card-body">

                <div class="row g-3">

                    <div class="col-md-6">

                        <div class="p-3 bg-light rounded">

                            <small class="text-muted d-block">
                                <i class="bi bi-rulers me-1"></i>
                                Taille
                            </small>

                            <strong>
                                {{ $product->detail->size ?? 'Non défini' }}
                            </strong>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="p-3 bg-light rounded">

                            <small class="text-muted d-block">
                                <i class="bi bi-palette-fill me-1"></i>
                                Couleur
                            </small>

                            <strong>
                                {{ $product->detail->color ?? 'Non défini' }}
                            </strong>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="p-3 bg-light rounded">

                            <small class="text-muted d-block">
                                <i class="bi bi-layers-fill me-1"></i>
                                Matière
                            </small>

                            <strong>
                                {{ $product->detail->matter ?? 'Non défini' }}
                            </strong>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="p-3 bg-light rounded">

                            <small class="text-muted d-block">
                                <i class="bi bi-truck me-1"></i>
                                Fournisseur
                            </small>

                            <strong>
                                {{ $product->provider->name_provider ?? 'Non défini' }}
                            </strong>

                        </div>

                    </div>

                    <div class="col-12">

                        <div class="p-3 bg-light rounded">

                            <small class="text-muted d-block">
                                <i class="bi bi-tags-fill me-1"></i>
                                Catégorie
                            </small>

                            <strong>
                                {{ $category->name_category ?? 'Non défini' }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Stock --}}
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

                <h5 class="mb-0">
                    <i class="bi bi-boxes me-2"></i>
                    Informations sur le stock
                </h5>

                <a href="{{ route('show_mouvement', $product) }}"
                   class="btn btn-sm btn-outline-light">

                    Gérer
                    <i class="bi bi-arrow-right ms-1"></i>

                </a>

            </div>

            <div class="card-body">

                @if($product->mouvement->isNotEmpty())

                    @php
                        $mouvement = $product->mouvement->last();
                    @endphp

                    <div class="row g-3">

                        {{-- Date --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                <i class="bi bi-calendar-event me-1"></i>
                                Dernière date d'entrée en stock
                            </small>

                            <strong>
                                {{ $mouvement->enter_date ?? 'Non défini' }}
                            </strong>

                        </div>

                        {{-- Stock initial --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                <i class="bi bi-box-arrow-in-down me-1"></i>
                                Dernière quantité ajoutée
                            </small>

                            <strong>
                                {{ $mouvement->initial_quantity ?? 'Non défini' }}
                            </strong>

                        </div>

                        {{-- Stock actuel --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                <i class="bi bi-box-seam me-1"></i>
                                Quantité disponible
                            </small>

                            @if($total_stock > 0)

                                <span class="badge bg-success fs-6">

                                    <i class="bi bi-check-circle-fill me-1"></i>

                                    {{ $total_stock }} en stock

                                </span>

                            @else

                                <span class="badge bg-danger fs-6">

                                    <i class="bi bi-x-circle-fill me-1"></i>

                                    Rupture de stock

                                </span>

                            @endif

                        </div>

                        {{-- Prix fournisseur --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                <i class="bi bi-cash-coin me-1"></i>
                                Prix fournisseur
                            </small>

                            <strong>
                                {{ number_format($mouvement->provider_price ?? 0, 0, ',', ' ') }} Ar
                            </strong>

                        </div>

                    </div>

                @else

                    <div class="text-center text-muted py-4">

                        <i class="bi bi-box-seam fs-1 d-block mb-2"></i>

                        Aucun mouvement de stock enregistré.

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- Dernière mise à jour --}}
<div class="text-end text-muted small mt-3 mb-4">

    <i class="bi bi-clock-history me-1"></i>

    Dernière mise à jour :
    {{ $product->updated_at
        ? $product->updated_at->format('d/m/Y H:i')
        : 'Non définie' }}

</div>

</div>

@endsection
