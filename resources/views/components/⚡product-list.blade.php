<?php

use Livewire\Component;
use App\Models\Stock\Product;

new class extends Component {
    public string $search = '';

    //ajout d'un produit au panier
    public function addProduct($product)
    {
        $product['quantity'] = 1;
        $this->dispatch('product-selected', product: $product);
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

                        <div class="row align-items-center">

                            {{-- Informations produit --}}
                            <div class="col-8">

                                <div class="d-flex align-items-center mb-2">

                                    <div class="rounded bg-light d-flex align-items-center justify-content-center me-3"
                                        style="width: 45px; height: 45px;">

                                        <img class="img-fluid" src="{{ $product->image_path ? asset($product->image_path) : asset('uploads/product/sans.png') }}" alt="">

                                    </div>

                                    <div>

                                        <h6 class="fw-bold mb-0">

                                            {{ $product->name_product }}

                                        </h6>

                                        <small class="text-muted">

                                            Réf. {{ $product->reference }}

                                        </small>

                                    </div>

                                </div>


                                <div class="d-flex align-items-center gap-3">

                                    {{-- Stock --}}
                                    @if ($product->mouvement)
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


                            {{-- Action --}}
                            <div class="col-4 text-end">

                                @if ($product->mouvement->sum('in_stock') > 0)
                                    <button type="button" class="btn btn-outline-primary"
                                        wire:click="addProduct({{ $product }})">

                                        <i class="bi bi-cart-plus-fill me-1"></i>
                                        Ajouter

                                    </button>
                                @else
                                    <button type="button" class="btn btn-outline-secondary" disabled>

                                        <i class="bi bi-cart-x me-1"></i>
                                        Indisponible

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
