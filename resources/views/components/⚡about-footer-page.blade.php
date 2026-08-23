<?php

use Livewire\Component;
use Native\Mobile\Facades\Browser;

new class extends Component {
    public function openPortfolio()
    {
        Browser::inApp('https://elisea.vercel.app');
    }
};
?>

<div class="flex-grow-1">

    <small class="text-muted">
        Développé par
    </small>

    <div class="fw-bold">
        <button type="button" wire:click="openPortfolio" class="btn btn-link p-0 fw-bold text-decoration-none">
            Tokiniaina
            <i class="bi bi-box-arrow-up-right ms-1"></i>
        </button>
    </div>

</div>
