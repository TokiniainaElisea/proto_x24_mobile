<?php

use Livewire\Component;
use App\Models\Client;

new class extends Component {
    public string $search = '';

    //selecting client
    public function selectClient($client)
    {
        $this->dispatch('selected-client', client: $client);
    }

    public function render()
    {
        $query = Client::orderBy('name', 'ASC');

        if ($this->search) {
            $query = $query->whereLike('name', '%' . $this->search . '%');
        }

        return view('components.⚡client-list', [
            'clients' => $query->paginate(10),
        ]);
    }
};
?>

<div>

    {{-- Recherche --}}
    <div class="mb-3">

        <label for="clientSearch" class="form-label fw-semibold">

            <i class="bi bi-search text-primary me-1"></i>
            Rechercher un client

        </label>

        <div class="input-group">

            <span class="input-group-text bg-light">

                <i class="bi bi-search"></i>

            </span>

            <input type="text" id="clientSearch" class="form-control" wire:model.live.debounce.500="search"
                placeholder="Nom, prénom ou numéro client...">

        </div>

    </div>


    {{-- Liste --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-light d-flex justify-content-between align-items-center">

            <span class="fw-bold">

                <i class="bi bi-people-fill text-primary me-1"></i>
                Clients

            </span>

            <span class="badge bg-primary">

                {{ $clients->total() }} client(s)

            </span>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-dark">

                        <tr>

                            <th class="ps-3">
                                N° client
                            </th>

                            <th>
                                Nom
                            </th>

                            <th>
                                Prénom
                            </th>

                            <th>
                                Téléphone
                            </th>

                            <th>
                                Ville
                            </th>

                            <th class="text-center">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($clients as $client)
                            <tr>

                                <td class="ps-3">

                                    <span class="badge bg-light text-dark border">

                                        <i class="bi bi-person-vcard me-1"></i>

                                        {{ $client->client_number }}

                                    </span>

                                </td>


                                <td class="fw-semibold">

                                    {{ $client->name }}

                                </td>


                                <td>

                                    {{ $client->firstname }}

                                </td>


                                <td>

                                    @if ($client->phone)
                                        <span>

                                            <i class="bi bi-telephone-fill text-success me-1"></i>

                                            {{ '0' . $client->phone }}

                                        </span>
                                    @else
                                        <span class="text-muted">

                                            <i class="bi bi-dash-circle me-1"></i>
                                            Indisponible

                                        </span>
                                    @endif

                                </td>


                                <td>

                                    @if ($client->town)
                                        <i class="bi bi-geo-alt-fill text-danger me-1"></i>

                                        {{ $client->town }}
                                    @else
                                        <span class="text-muted">
                                            Indisponible
                                        </span>
                                    @endif

                                </td>


                                <td class="text-center">

                                    <button type="button" wire:click="selectClient({{ $client }})"
                                        class="btn btn-sm btn-outline-success" data-bs-dismiss="modal"
                                        aria-label="Sélectionner {{ $client->name }}">

                                        <i class="bi bi-person-check-fill me-1"></i>
                                        Sélectionner

                                    </button>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center py-5">

                                    <i class="bi bi-person-x text-muted" style="font-size: 2.5rem;">
                                    </i>

                                    <h6 class="fw-bold mt-3">
                                        Aucun client trouvé
                                    </h6>

                                    <small class="text-muted">
                                        Essayez avec un autre nom ou numéro client.
                                    </small>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-3">

        {{ $clients->links() }}

    </div>

</div>
