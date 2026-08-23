<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Company;

new class extends Component {
    public $company;

    public $name;
    public $legal_name;
    public $address;
    public $phone;
    public $nif;
    public $stat;
    public $rcs;
    //public $isDirty = $this->getIsDirtyProperty();

    public function mount()
    {
        $this->company = Company::first();

        if ($this->company) {
            $this->name = $this->company->name;
            $this->legal_name = $this->company->legal_name;
            $this->address = $this->company->address;
            $this->phone = $this->company->phone;
            $this->nif = $this->company->nif;
            $this->stat = $this->company->stat;
            $this->rcs = $this->company->rcs;
        }
    }

    #[Computed]
    public function isDirty()
    {
        if (!$this->company) {
            return filled($this->name) || filled($this->legal_name) || filled($this->address) || filled($this->phone) || filled($this->nif) || filled($this->stat) || filled($this->rcs);
        }

        return $this->name !== $this->company->name || $this->legal_name !== $this->company->legal_name || $this->address !== $this->company->address || $this->phone !== $this->company->phone || $this->nif !== $this->company->nif || $this->stat !== $this->company->stat || $this->rcs !== $this->company->rcs;
    }

    //enregistrer
    public function save()
    {
        $this->company = Company::first();

        //Si on a déjà un truc enregistré
        if ($this->company) {
            $this->company->update([
                'name' => $this->name,
                'legal_name' => $this->legal_name,
                'address' => $this->address,
                'phone' => $this->phone,
                'nif' => $this->nif,
                'stat' => $this->stat,
                'rcs' => $this->rcs,
            ]);

            $this->name = '';
            $this->legal_name = '';
            $this->address = '';
            $this->phone = '';
            $this->nif = '';
            $this->stat = '';
            $this->rcs = '';
        } else {
            //ce truc ne va servir qu'une fois quoi 
            Company::create([
                'name' => $this->name,
                'legal_name' => $this->legal_name,
                'address' => $this->address,
                'phone' => $this->phone,
                'nif' => $this->nif,
                'stat' => $this->stat,
                'rcs' => $this->rcs,
            ]);
        }
    }
};
?>

<div>

    {{-- Informations principales --}}
    <div class="card shadow-sm border-0 my-2">

        <div class="card-header bg-dark text-white">

            <h5 class="mb-0">
                <i class="bi bi-info-circle-fill me-2"></i>
                Informations générales
            </h5>

        </div>

        <div class="card-body">

            <div class="row g-4">

                {{-- Nom commercial --}}
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        <i class="bi bi-shop me-1 text-primary"></i>
                        Nom commercial
                    </label>

                    <input type="text" class="form-control" wire:model.live="name" placeholder="Ex : Proto Store">

                    <small class="text-muted">
                        Nom utilisé pour identifier votre société.
                    </small>

                </div>


                {{-- Raison sociale --}}
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        <i class="bi bi-building me-1 text-primary"></i>
                        Raison sociale
                    </label>

                    <input type="text" class="form-control" wire:model.live="legal_name"
                        placeholder="Ex : Proto Store SARL">

                </div>


                {{-- Adresse --}}
                <div class="col-12">

                    <label class="form-label fw-semibold">
                        <i class="bi bi-geo-alt-fill me-1 text-danger"></i>
                        Adresse
                    </label>

                    <input type="text" class="form-control" wire:model.live="address"
                        placeholder="Adresse de la société">

                </div>


                {{-- Téléphone --}}
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        <i class="bi bi-telephone-fill me-1 text-success"></i>
                        Téléphone
                    </label>

                    <input type="text" class="form-control" wire:model.live="phone" placeholder="Ex : 034 00 000 00">

                </div>


                {{-- NIF --}}
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        <i class="bi bi-card-text me-1 text-warning"></i>
                        NIF
                    </label>

                    <input type="text" class="form-control" wire:model.live="nif"
                        placeholder="Numéro d'identification fiscale">

                </div>


                {{-- STAT --}}
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        <i class="bi bi-file-earmark-text-fill me-1 text-info"></i>
                        STAT
                    </label>

                    <input type="text" class="form-control" wire:model.live="stat" placeholder="Numéro statistique">

                </div>


                {{-- RCS --}}
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        <i class="bi bi-journal-text me-1 text-secondary"></i>
                        RCS
                    </label>

                    <input type="text" class="form-control" wire:model.live="rcs"
                        placeholder="Registre du commerce et des sociétés">

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

            <div class="d-flex align-items-center">

                <div class="rounded-3 bg-opacity-10
                            d-flex align-items-center justify-content-center me-3"
                    style="width: 55px; height: 55px;">

                    <i class="bi bi-building-fill text-primary fs-3"></i>

                </div>

                <div>

                    <h5 class="fw-bold mb-1">
                        {{ $name ?: 'Nom de votre société' }}
                    </h5>

                    <small class="text-muted">
                        {{ $legal_name ?: 'Raison sociale non renseignée' }}
                    </small>

                </div>

            </div>

            <hr>

            <div class="row g-3">

                <div class="col-md-6">

                    <div class="text-muted small">
                        <i class="bi bi-geo-alt me-1"></i>
                        Adresse
                    </div>

                    <strong>
                        {{ $address ?: 'Non renseignée' }}
                    </strong>

                </div>

                <div class="col-md-6">

                    <div class="text-muted small">
                        <i class="bi bi-telephone me-1"></i>
                        Téléphone
                    </div>

                    <strong>
                        {{ $phone ?: 'Non renseigné' }}
                    </strong>

                </div>

                <div class="col-md-4">

                    <div class="text-muted small">
                        NIF
                    </div>

                    <strong>
                        {{ $nif ?: 'Non renseigné' }}
                    </strong>

                </div>

                <div class="col-md-4">

                    <div class="text-muted small">
                        STAT
                    </div>

                    <strong>
                        {{ $stat ?: 'Non renseigné' }}
                    </strong>

                </div>

                <div class="col-md-4">

                    <div class="text-muted small">
                        RCS
                    </div>

                    <strong>
                        {{ $rcs ?: 'Non renseigné' }}
                    </strong>

                </div>

            </div>

        </div>

    </div>


    {{-- Bouton sauvegarde --}}
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
