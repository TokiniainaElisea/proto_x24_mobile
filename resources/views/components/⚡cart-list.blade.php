<?php

use App\Models\SaleDetail;
use App\Models\Sales;
use App\Models\Product;
use App\Models\Numbering;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Mouvement;

new class extends Component {
    //product list
    public $selectedProducts = [];

    //more infos
    public $moreInfos = false;

    //selected client
    public $selectedClient;

    //payment method
    public $payment_method;

    //remise
    public $discount = 0;

    #[Computed]
    public function isValidOrder()
    {
        // Client obligatoire
        if (empty($this->selectedClient)) {
            return false;
        }

        // Mode de paiement obligatoire
        if (empty($this->payment_method)) {
            return false;
        }

        // Au moins un produit
        if (empty($this->selectedProducts)) {
            return false;
        }

        // Toutes les quantités doivent être valides
        foreach ($this->selectedProducts as $product) {
            if (!isset($product['quantity']) || !is_numeric($product['quantity']) || (int) $product['quantity'] < 1) {
                return false;
            }
        }

        return true;
    }

    //total price
    #[Computed]
    public function totalPrice()
    {
        $total = collect($this->selectedProducts)->sum(function ($product) {
            $price = (float) ($product['price'] ?? 0);
            $quantity = max(0, (int) ($product['quantity'] ?? 0));

            return $price * $quantity;
        });

        return $total - ($total * (float) $this->discount) / 100;
    }

    //note
    public $note = '';

    #[On('product-selected')]
    public function selectProducts($product)
    {
        foreach ($this->selectedProducts as $key => $value) {
            if ($value['id'] == $product['id']) {
                $this->selectedProducts[$key]['quantity']++;
                return;
            }
        }

        $product['quantity'] = 1;
        $this->selectedProducts[] = $product;
        //dd($this->selectedProducts);
    }

    //delete product
    public function deleteProduct($id)
    {
        $this->selectedProducts = array_filter($this->selectedProducts, fn($p) => $p['id'] !== $id);
    }

    //more infos
    public function showMoreInfos()
    {
        $this->moreInfos = !$this->moreInfos;
    }
    //cancel order
    public function cancelOrder()
    {
        $this->selectedProducts = [];
        $this->note = '';
        $this->discount = 0;
    }

    // validate order
    public function validateOrder()
    {
        
        DB::transaction(function () {
            // Création de la vente
            $order = Sales::create([
                'client_id' => $this->selectedClient['id'],
                'status' => 'En cours',
                'discount' => $this->discount,
                'total_price' => $this->totalPrice,
                'note' => $this->note,
                'payment_method' => $this->payment_method ?? 'Cash',
            ]);
            $salePrefix = Numbering::first() ?? 'CMD';
            if (is_string($salePrefix)) {
                $order->update([
                    'sale_reference' => $salePrefix . $order->id,
                ]);
            } else {
                $order->update([
                    'sale_reference' => $salePrefix->order_prefix . $order->id,
                ]);
            }

            // Parcours des produits du panier
            foreach ($this->selectedProducts as $value) {
                $cost_price = 0;
                $quantityToRemove = (int) $value['quantity'];

                /*
                 * On récupère les entrées de stock du produit
                 * de la plus ancienne à la plus récente.
                 */
                $mouvements = Mouvement::where('product_id', $value['id'])->where('in_stock', '>', 0)->orderBy('enter_date', 'asc')->orderBy('id', 'asc')->lockForUpdate()->get();

                // Vérification du stock disponible
                $totalStock = $mouvements->sum('in_stock');

                if ($totalStock < $quantityToRemove) {
                    throw new \Exception('Stock insuffisant pour le produit : ' . $value['name_product']);
                }

                /*
                 * Décrémentation FIFO
                 */
                foreach ($mouvements as $mouvement) {
                    if ($quantityToRemove <= 0) {
                        break;
                    }

                    $available = $mouvement->in_stock;

                    if ($available >= $quantityToRemove) {
                        // Cette entrée suffit à couvrir la vente
                        $mouvement->decrement('in_stock', $quantityToRemove);

                        $quantityToRemove = 0;
                        $cost_price = $mouvement->provider_price;
                    } else {
                        // On consomme entièrement cette entrée
                        $mouvement->update([
                            'in_stock' => 0,
                        ]);

                        $quantityToRemove -= $available;
                        $cost_price = $mouvement->provider_price;
                    }
                }

                // Création du détail de vente
                SaleDetail::create([
                    'sales_id' => $order->id,
                    'product_id' => $value['id'],
                    'quantity' => $value['quantity'],
                    'unit_price' => $value['price'],
                    'total_line' => $value['quantity'] * $value['price'],
                    'cost_price' => $cost_price * $value['quantity'],
                ]);
            }
        });

        return to_route('ventes')->with('success', 'Et une vente de plus');
    }
};

?>

<div>
    @forelse ($selectedProducts as $key => $product)
        <div class="card border-0 shadow-sm mb-3">

            <div class="card-body">

                <div class="row align-items-center g-3">

                    {{-- Produit --}}
                    <div class="col">

                        <div class="d-flex align-items-center">

                            <div class="rounded bg-light d-flex align-items-center justify-content-center me-3"
                                style="width: 45px; height: 45px;">

                                <i class="bi bi-box-seam-fill text-primary fs-5"></i>

                            </div>

                            <div>

                                <h6 class="fw-bold mb-1">

                                    {{ $product['name_product'] }}

                                </h6>

                                <small class="text-muted d-block">

                                    <i class="bi bi-boxes me-1"></i>

                                    En stock :
                                    {{ $product['mouvement'][0]['in_stock'] }}

                                </small>

                                <span class="text-success fw-semibold">

                                    {{ number_format($product['price'] * $product['quantity'], 0, ',', ' ') }}
                                    Ar

                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Quantité --}}
                    <div class="col-md-4">

                        <label class="form-label small text-muted mb-1">
                            Quantité
                        </label>

                        <div class="input-group">

                            <input type="number" min="1"
                                class="form-control text-center @error('selectedProducts.' . $key . '.quantity') is-invalid @enderror"
                                wire:model.live="selectedProducts[{{ $key }}]['quantity']">

                            <button type="button" class="btn btn-outline-danger"
                                wire:click="deleteProduct({{ $product['id'] }})" title="Supprimer du panier">

                                <i class="bi bi-trash3-fill"></i>

                            </button>

                        </div>

                        @error('selectedProducts.' . $key . '.quantity')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                </div>

            </div>

        </div>

    @empty

        {{-- Panier vide --}}
        <div class="text-center py-5">

            <div class="mb-3">

                <i class="bi bi-cart-x text-muted" style="font-size: 3rem;">
                </i>

            </div>

            <h6 class="fw-bold">
                Panier vide
            </h6>

            <small class="text-muted">
                Ajoutez des produits pour commencer la vente.
            </small>

        </div>
    @endforelse


    @if ($selectedProducts)

        {{-- Informations supplémentaires --}}
        <div class="border-top pt-3 mt-3">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h6 class="fw-bold mb-0">

                    <i class="bi bi-receipt me-2 text-primary"></i>
                    Informations de la vente

                </h6>

                <button type="button" class="btn btn-sm btn-outline-secondary" wire:click="showMoreInfos">

                    <i class="bi bi-three-dots"></i>

                    {{ $moreInfos ? 'Masquer' : 'Plus' }}

                </button>

            </div>


            @if ($moreInfos)
                <div class="card bg-light border-0 mb-3">

                    <div class="card-body">

                        {{-- Remise --}}
                        <div class="mb-3">

                            <label for="discount" class="form-label fw-semibold">

                                <i class="bi bi-percent text-warning me-1"></i>
                                Remise

                            </label>

                            <div class="input-group">

                                <input type="number" id="discount" min="0" class="form-control"
                                    wire:model.live.blur="discount" placeholder="0">

                                <span class="input-group-text">
                                    %
                                </span>

                            </div>

                        </div>


                        {{-- Mode de paiement --}}
                        <div class="mb-3">

                            <label for="payment_method" class="form-label fw-semibold">

                                <i class="bi bi-credit-card-fill text-success me-1"></i>
                                Mode de paiement

                            </label>

                            <select id="payment_method" class="form-select" wire:model.live.blur="payment_method">

                                <option value="">
                                    Séléctionnez un mode de paiement
                                </option>

                                <option value="Mvola">
                                    Mvola
                                </option>

                                <option value="Orange Money">
                                    Orange Money
                                </option>

                                <option value="Airtel Money">
                                    Airtel Money
                                </option>

                                <option value="Cash">
                                    Cash
                                </option>

                            </select>

                        </div>


                        {{-- Note --}}
                        <div>

                            <label for="note" class="form-label fw-semibold">

                                <i class="bi bi-sticky-fill text-info me-1"></i>
                                Note

                            </label>

                            <textarea id="note" rows="3" class="form-control" wire:model.live.blur="note"
                                placeholder="Ajouter une note concernant cette vente..."></textarea>

                        </div>

                    </div>

                </div>
            @endif


            {{-- Total --}}
            <div class="card border-0 bg-light mb-3">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <span class="fw-semibold text-muted">
                            Total :
                        </span>

                        <span class="fs-4 fw-bold text-success">

                            {{ number_format($this->totalPrice, 0, ',', ' ') }}
                            Ariary

                        </span>

                    </div>

                </div>

            </div>


            {{-- Actions --}}
            <div class="d-flex justify-content-end gap-2">

                <button type="button" wire:click="cancelOrder" class="btn btn-outline-warning">

                    <i class="bi bi-x-circle me-1"></i>
                    Annuler

                </button>

                <button type="submit" wire:click="validateOrder" class="btn btn-primary" @disabled(!$this->isValidOrder)>

                    <i class="bi bi-check-circle-fill me-1"></i>
                    Valider la vente

                </button>

            </div>

            @if (!$this->isValidOrder)
                <div class="text-end mt-2">

                    <small class="text-muted">

                        <i class="bi bi-info-circle me-1"></i>
                        Vérifiez le client, les quantités et le mode de paiement.

                    </small>

                </div>
            @endif

        </div>

    @endif

</div>
