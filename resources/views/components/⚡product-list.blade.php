<?php

use Livewire\Component;
use App\Models\Product;

new class extends Component {
    public string $search = '';

    //ajout d'un produit au panier
    public function addProduct($product, $in_stock)
    {
        //$product['quantity'] = 1;
        //$product['in_stock'] = $in_stock;
        $this->dispatch('product-selected', product: $product, stock: $in_stock);
    }

    public function render()
    {
        $query = Product::with(['detail', 'provider', 'mouvement']);
        //$query->where('in_stock', '>', 0);
        if ($this->search) {
            $query = $query->whereLike('name_product', '%' . $this->search . '%');
        }
        return view('components.⚡product-list', [
            'products' => $query->paginate(10),
        ]);
    }
};
?>

<div>
    <input type="text" class="form-control mb-2 w-100" placeholder="Tapez le nom d'un produit"
        wire:model.live.debounce.500="search">
    <div class="row g-3">
        @forelse ($products as $product)
            <div class="col-12">

                <div class="card border shadow-sm h-100">

                    <div class="card-body py-3">

                        <div class="row align-items-center g-3">

                            {{-- INFORMATIONS PRODUIT --}}

                            <div class="col-12 col-md-9">

                                <div class="d-flex align-items-center">

                                    {{-- Image --}}

                                    <div class="rounded bg-light d-flex align-items-center justify-content-center flex-shrink-0 me-3"
                                        style="width: 45px; height: 45px;">

                                        <img class="img-fluid rounded"
                                            src="{{ $product->image_path ? asset($product->image_path) : asset('uploads/product/sans.png') }}"
                                            alt="{{ $product->name_product }}">

                                    </div>


                                    {{-- Nom + référence --}}

                                    <div class="min-width-0">

                                        <h6 class="fw-bold mb-0 text-truncate">

                                            {{ $product->name_product }}

                                        </h6>

                                        <small class="text-muted">

                                            Réf. {{ $product->reference }}

                                        </small>

                                    </div>

                                </div>


                                {{-- Stock + Prix --}}

                                <div class="d-flex flex-wrap align-items-center gap-2 mt-3">

                                    {{-- Stock --}}

                                    @if ($product->mouvement && $product->mouvement->sum('in_stock') > 0)
                                        <span class="badge bg-success-subtle text-success">

                                            <i class="bi bi-boxes me-1"></i>

                                            {{ $product->mouvement->sum('in_stock') }}
                                            en stock

                                        </span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger">

                                            <i class="bi bi-x-circle-fill me-1"></i>

                                            Rupture

                                        </span>
                                    @endif


                                    {{-- Prix --}}

                                    <span class="fw-bold text-success">

                                        {{ number_format($product->price, 0, ',', ' ') }} Ar

                                    </span>

                                </div>

                            </div>


                            {{-- ACTION --}}

                            <div class="col-12 col-md-3">

                                @if ($product->mouvement && $product->mouvement->sum('in_stock') > 0)
                                    <button type="button" class="btn btn-outline-primary w-100"
                                        wire:click="addProduct({{ $product }}, {{ $product->mouvement->sum('in_stock') }})">

                                        <i class="bi bi-cart-plus-fill me-1"></i>

                                        <span class="d-none d-sm-inline">
                                            Ajouter
                                        </span>

                                    </button>
                                @else
                                    <button type="button" class="btn btn-outline-secondary w-100" disabled>

                                        <i class="bi bi-cart-x me-1"></i>

                                        <span class="d-none d-sm-inline">
                                            Indisponible
                                        </span>

                                    </button>
                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="text-center py-5">

                    <i class="bi bi-box-seam text-muted" style="font-size: 2.5rem;">
                    </i>

                    <h6 class="fw-bold mt-3">
                        Aucun produit disponible
                    </h6>

                    <small class="text-muted">
                        Aucun produit ne correspond à votre recherche.
                    </small>

                </div>

            </div>
        @endforelse

    </div>

</div>
