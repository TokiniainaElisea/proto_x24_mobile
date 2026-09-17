<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Numbering;

new class extends Component
{
    public $numbering;

    public $order_prefix;
    public $client_prefix;
    public $product_prefix;

    public function mount()
    {
        $this->numbering = Numbering::first();

        if ($this->numbering) {

            $this->order_prefix = $this->numbering->order_prefix;
            $this->client_prefix = $this->numbering->client_prefix;
            $this->product_prefix = $this->numbering->product_prefix;

        }
    }

    #[Computed]
    public function isDirty()
    {
        if (!$this->numbering) {
            return filled($this->order_prefix)
                || filled($this->client_prefix)
                || filled($this->product_prefix);
        }

        return $this->order_prefix !== $this->numbering->order_prefix
            || $this->client_prefix !== $this->numbering->client_prefix
            || $this->product_prefix !== $this->numbering->product_prefix;
    }

    public function save()
    {
        $data = [
            'order_prefix' => $this->order_prefix,
            'client_prefix' => $this->client_prefix,
            'product_prefix' => $this->product_prefix,
        ];

        if ($this->numbering) {

            $this->numbering->update($data);

        } else {

            $this->numbering = Numbering::create($data);

        }
    }
};

?>

<div>

    {{-- Configuration --}}
    <div class="card shadow-sm border-0 my-2">

        <div class="card-header bg-dark text-white">

            <h5 class="mb-0">
                <i class="bi bi-pencil-square me-2"></i>
                Préfixes
            </h5>

        </div>

        <div class="card-body">

            <div class="row g-4">

                {{-- Commande --}}
                <div class="col-md-4">

                    <div class="border rounded-3 p-3 h-100">

                        <div class="d-flex align-items-center mb-3">

                            <div class=" bg-opacity-10 rounded-3
                                        d-flex align-items-center justify-content-center me-2"
                                style="width: 42px; height: 42px;">

                                <i class="bi bi-cart-check-fill text-primary"></i>

                            </div>

                            <div>

                                <strong>Commande</strong>

                                <br>

                                <small class="text-muted">
                                    Numéro de commande
                                </small>

                            </div>

                        </div>

                        <label class="form-label fw-semibold">
                            Préfixe
                        </label>

                        <input type="text" class="form-control" wire:model.live="order_prefix" maxlength="10"
                            placeholder="CMD">

                    </div>

                </div>


                {{-- Client --}}
                <div class="col-md-4">

                    <div class="border rounded-3 p-3 h-100">

                        <div class="d-flex align-items-center mb-3">

                            <div class=" bg-opacity-10 rounded-3
                                        d-flex align-items-center justify-content-center me-2"
                                style="width: 42px; height: 42px;">

                                <i class="bi bi-person-vcard-fill text-success"></i>

                            </div>

                            <div>

                                <strong>Client</strong>

                                <br>

                                <small class="text-muted">
                                    Numéro client
                                </small>

                            </div>

                        </div>

                        <label class="form-label fw-semibold">
                            Préfixe
                        </label>

                        <input type="text" class="form-control" wire:model.live="client_prefix" maxlength="10"
                            placeholder="CLI">

                    </div>

                </div>


                {{-- Produit --}}
                <div class="col-md-4">

                    <div class="border rounded-3 p-3 h-100">

                        <div class="d-flex align-items-center mb-3">

                            <div class=" bg-opacity-10 rounded-3
                                        d-flex align-items-center justify-content-center me-2"
                                style="width: 42px; height: 42px;">

                                <i class="bi bi-box-seam-fill text-warning"></i>

                            </div>

                            <div>

                                <strong>Référence produit</strong>

                                <br>

                                <small class="text-muted">
                                    Référence du produit
                                </small>

                            </div>

                        </div>

                        <label class="form-label fw-semibold">
                            Préfixe
                        </label>

                        <input type="text" class="form-control" wire:model.live="product_prefix" maxlength="10"
                            placeholder="PRD">

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Aperçu --}}
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-dark text-white">

            <h5 class="mb-0">
                <i class="bi bi-eye-fill me-2"></i>
                Aperçu
            </h5>

        </div>

        <div class="card-body">

            <p class="text-muted mb-4">
                Voici à quoi ressembleront les prochains numéros générés.
            </p>

            <div class="row g-3">

                {{-- Commande --}}
                <div class="col-md-4">

                    <div class=" bg-opacity-10 rounded-3 p-4 text-center">

                        <i class="bi bi-cart-check-fill text-primary fs-2"></i>

                        <div class="text-muted small mt-2">
                            Commande
                        </div>

                        <div class="fs-4 fw-bold text-primary">
                            {{ $order_prefix ?: 'CMD' }}0125
                        </div>

                    </div>

                </div>


                {{-- Client --}}
                <div class="col-md-4">

                    <div class=" bg-opacity-10 rounded-3 p-4 text-center">

                        <i class="bi bi-person-vcard-fill text-success fs-2"></i>

                        <div class="text-muted small mt-2">
                            Client
                        </div>

                        <div class="fs-4 fw-bold text-success">
                            {{ $client_prefix ?: 'CLI' }}042
                        </div>

                    </div>

                </div>


                {{-- Produit --}}
                <div class="col-md-4">

                    <div class=" bg-opacity-10 rounded-3 p-4 text-center">

                        <i class="bi bi-box-seam-fill text-warning fs-2"></i>

                        <div class="text-muted small mt-2">
                            Référence produit
                        </div>

                        <div class="fs-4 fw-bold text-warning">
                            {{ $product_prefix ?: 'PRD' }}0318
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Sauvegarde --}}
    <div class="d-flex justify-content-end mb-4">

        <button type="button" wire:click="save" class="btn btn-success px-4" wire:loading.attr="disabled"
            @disabled(!$this->isDirty)>

            <span wire:loading.remove>
                <i class="bi bi-floppy-fill me-1"></i>
                Enregistrer les modifications
            </span>

            <span wire:loading>
                <span class="spinner-border spinner-border-sm me-1"></span>
                Enregistrement...
            </span>

        </button>

    </div>

</div>
