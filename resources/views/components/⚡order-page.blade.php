<?php

use Livewire\Component;
use Livewire\Attributes\On;

new class extends Component {
    public $selectedClient = null;

    #[On('selected-client')]
    public function validateClient($client)
    {
        $this->selectedClient = $client;
    }

    //delete selected client
    public function cancelClient()
    {
        $this->selectedClient = null;
    }
};
?>

<div>
    {{-- Client sélectionné --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <div class="d-flex justify-content-center gap-2"> <button type="button" class="btn btn-primary"
                    data-bs-toggle="modal" data-bs-target="#client_list"> <i class="bi bi-person-check-fill me-1"></i>
                </button>
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                    data-bs-target="#new_client"> <i class="bi bi-person-plus-fill me-1"></i> </button>
            </div>


            @if ($selectedClient)
                <span class="badge bg-success">
                    <i class="bi bi-check-circle-fill me-1"></i>
                    Client sélectionné
                </span>
            @endif

        </div>


        <div class="card-body">

            @if ($selectedClient)
                <div class="row g-3 align-items-center">

                    {{-- Numéro client --}}
                    <div class="col-md-2">

                        <small class="text-muted d-block">
                            N° client
                        </small>

                        <strong>
                            {{ $selectedClient['client_number'] }}
                        </strong>

                    </div>


                    {{-- Nom --}}
                    <div class="col-md-2">

                        <small class="text-muted d-block">
                            Nom
                        </small>

                        <strong>
                            {{ $selectedClient['name'] }}
                        </strong>

                    </div>


                    {{-- Prénom --}}
                    <div class="col-md-2">

                        <small class="text-muted d-block">
                            Prénom
                        </small>

                        <strong>
                            {{ $selectedClient['firstname'] }}
                        </strong>

                    </div>


                    {{-- Téléphone --}}
                    <div class="col-md-2">

                        <small class="text-muted d-block">
                            Téléphone
                        </small>

                        <span>
                            {{ $selectedClient['phone'] ? '0' . $selectedClient['phone'] : 'Téléphone indisponible' }}
                        </span>

                    </div>


                    {{-- Ville --}}
                    <div class="col-md-2">

                        <small class="text-muted d-block">
                            Ville
                        </small>

                        <span>
                            {{ $selectedClient['town'] ? $selectedClient['town'] : 'Ville indisponible' }}
                        </span>

                    </div>


                    {{-- Annuler --}}
                    <div class="col-md-2 text-end">

                        <button type="button" wire:click="cancelClient" class="btn btn-sm btn-outline-danger">

                            <i class="bi bi-person-x-fill me-1"></i>
                            Retirer

                        </button>

                    </div>

                </div>
            @else
                <div class="text-center py-1">

                    <i class="bi bi-person-exclamation text-warning fs-2 d-block mb-2"></i>

                    <small class="text-muted">
                        Veuillez sélectionner un client pour continuer la vente.
                    </small>

                </div>
            @endif

        </div>

    </div>

    {{-- Modal sélection client --}}

    <div class="modal fade" tabindex="-1" aria-hidden="true" id="client_list">

        <div class="modal-dialog modal-dialog-centered modal-lg">

            <div class="modal-content border-0 shadow">

                <div class="modal-header bg-dark text-white">

                    <h5 class="modal-title fw-bold">

                        <i class="bi bi-people-fill me-2"></i>
                        Sélectionner un client

                    </h5>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Fermer">
                    </button>

                </div>

                <div class="modal-body p-3">

                    <livewire:client-list />

                </div>

            </div>

        </div>

    </div>

    {{-- Nouveau client --}}
    @include('clients.parts.new_client_modal', [
        'id' => 'new_client',
    ])

    {{-- Sélection des produits --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-dark text-white">

            <h5 class="mb-0 fw-bold">

                <i class="bi bi-box-seam-fill me-2"></i>
                Produits et panier

            </h5>

        </div>


        <div class="card-body">

            <div class="row g-4">

                {{-- Produits --}}
                <div class="col-lg-6">

                    <div class="card border h-100">

                        <div class="card-header bg-light">

                            <h6 class="mb-0 fw-bold">

                                <i class="bi bi-search me-2 text-primary"></i>
                                Sélectionner les produits

                            </h6>

                        </div>

                        <div class="card-body">

                            <livewire:product-list />

                        </div>

                    </div>

                </div>


                {{-- Panier --}}
                <div class="col-lg-6">

                    <div class="card border h-100">

                        <div class="card-header bg-light d-flex justify-content-between align-items-center">

                            <h6 class="mb-0 fw-bold">

                                <i class="bi bi-cart3 me-2 text-success"></i>
                                Panier

                            </h6>

                            <span class="badge bg-success">

                                <i class="bi bi-cart-check-fill me-1"></i>
                                Vente en cours

                            </span>

                        </div>

                        <div class="card-body">

                            <livewire:cart-list :selectedClient="$selectedClient" />

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
