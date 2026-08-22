@php
    $id;
    $categories ?? '';
@endphp

<div class="modal fade" id={{ $id }} tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-scrollable">
        <div class="modal-content border-0 shadow-lg">

            {{-- Header --}}
            <div class="modal-header bg-dark text-white border-0">
                <div class="d-flex align-items-center">
                    <div class=" bg-opacity-25 rounded-3
                                d-flex align-items-center justify-content-center me-3"
                        style="width: 42px; height: 42px;">

                        <i class="bi bi-tags-fill text-primary fs-5"></i>

                    </div>

                    <div>
                        <h4 class="modal-title fw-bold mb-0">
                            Gestion des catégories
                        </h4>
                    </div>
                </div>

                <button class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>


            <div class="modal-body bg-light">

                {{-- Ajouter une catégorie --}}
                <div class="card border-0 shadow-sm mb-2">

                    <div class="card-header bg-white border-0 py-3">

                        <div class="d-flex align-items-center">

                            <div class=" rounded-3
                                        d-flex align-items-center justify-content-center me-2"
                                style="width: 38px; height: 38px;">

                                <i class="bi bi-plus-lg text-success"></i>

                            </div>

                            <div>
                                <h6 class="fw-bold mb-0">
                                    Nouvelle catégorie
                                </h6>
                            </div>

                        </div>

                    </div>

                    <div class="card-body">

                        <form action="{{ route('new_category') }}" method="post">

                            @csrf

                            <div class="row mb-1">

                                <div>

                                    <label for="name_category" class="form-label fw-semibold">
                                        Nom de la catégorie
                                    </label>

                                    <input type="text" class="form-control" name="name_category"
                                        placeholder="Ex : Vêtements, chaussures..." required>

                                </div>

                            </div>

                            <div class="mb-1">

                                <button class="btn btn-success px-4" type="submit">

                                    <i class="bi bi-plus-circle me-1"></i>
                                    Ajouter

                                </button>

                            </div>
                        </form>

                    </div>
                </div>


                {{-- Liste des catégories --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-white border-0 py-3">

                        <div class="d-flex justify-content-between align-items-center">

                            <div class="d-flex align-items-center">

                                <div class=" rounded-3
                                            d-flex align-items-center justify-content-center me-2"
                                    style="width: 38px; height: 38px;">

                                    <i class="bi bi-list-ul text-primary"></i>

                                </div>

                            </div>

                            <span class="badge bg-primary rounded-pill">
                                {{ count($categories) }} catégorie(s)
                            </span>

                        </div>

                    </div>


                    <div class="card-body p-0">

                        <div class="table-responsive">

                            <table class="table table-hover align-middle mb-0">

                                <thead class="table-light">

                                    <tr>
                                        <th class="ps-4">
                                            Catégorie
                                        </th>

                                        <th class="text-end pe-4">
                                            Actions
                                        </th>
                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse ($categories as $category)
                                        <tr>

                                            <td class="ps-4">

                                                <div class="d-flex align-items-center">

                                                    <div class="
                                                                rounded-2
                                                                d-flex align-items-center justify-content-center me-3"
                                                        style="width: 36px; height: 36px;">

                                                        <i class="bi bi-tag-fill text-primary"></i>

                                                    </div>

                                                    <div>

                                                        <div class="fw-semibold">
                                                            {{ $category->name_category }}
                                                        </div>

                                                        <small class="text-muted">
                                                            Catégorie #{{ $category->id }}
                                                        </small>

                                                    </div>

                                                </div>

                                            </td>


                                            <td class="text-end pe-4">

                                                <div class="d-flex justify-content-end gap-2">

                                                    {{-- Modifier --}}
                                                    <button class="btn btn-sm btn-outline-warning"
                                                        data-bs-target="{{ '#category_' . $category->id }}"
                                                        data-bs-toggle="modal" title="Modifier">

                                                        <i class="bi bi-pencil-square"></i>

                                                    </button>


                                                    {{-- Supprimer --}}
                                                    <button class="btn btn-sm btn-outline-danger"
                                                        data-bs-target="{{ '#category_detelte_' . $category->id }}"
                                                        data-bs-toggle="modal" title="Supprimer">

                                                        <i class="bi bi-trash"></i>

                                                    </button>


                                                    @include('products.category.edit_category', [
                                                        'id' => $category->id,
                                                        'category' => $category,
                                                        'name_category' => $category->name_category,
                                                    ])

                                                    @include('products.category.delete_category', [
                                                        'id' => $category->id,
                                                        'category' => $category,
                                                    ])

                                                </div>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="2" class="text-center py-5">

                                                <div class="text-muted">

                                                    <i class="bi bi-tags fs-1 d-block mb-2"></i>

                                                    <h6 class="fw-semibold">
                                                        Aucune catégorie
                                                    </h6>

                                                    <small>
                                                        Commencez par ajouter une nouvelle catégorie.
                                                    </small>

                                                </div>

                                            </td>

                                        </tr>
                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Footer --}}
            <div class="modal-footer bg-white border-0">

                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">

                    <i class="bi bi-x-lg me-1"></i>
                    Fermer

                </button>

            </div>

        </div>
    </div>
</div>
