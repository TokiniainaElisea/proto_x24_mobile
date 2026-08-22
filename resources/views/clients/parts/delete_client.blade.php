@php
$id;
$client;
@endphp

<div class="modal fade" id="{{$id}}" tabindex="-1" aria-hidden="true">

<div class="modal-dialog modal-dialog-centered">

    <div class="modal-content border-0 shadow-lg">

        {{-- Header --}}
        <div class="modal-header bg-danger text-white">

            <div class="d-flex align-items-center">

                <div
                    class="bg-white text-danger rounded-circle d-flex align-items-center justify-content-center me-3"
                    style="width: 42px; height: 42px;">

                    <i class="bi bi-person-x-fill fs-5"></i>

                </div>

                <div>

                    <h5 class="modal-title fw-bold mb-0">
                        Supprimer le client
                    </h5>

                    <small class="text-white-50">
                        Cette action nécessite une confirmation
                    </small>

                </div>

            </div>

            <button
                type="button"
                class="btn-close btn-close-white"
                data-bs-dismiss="modal"
                aria-label="Close">
            </button>

        </div>


        {{-- Corps --}}
        <div class="modal-body p-4 text-center">

            <div class="mb-3">

                <i class="bi bi-exclamation-triangle-fill text-danger"
                   style="font-size: 3rem;">
                </i>

            </div>

            <h5 class="fw-bold mb-2">
                Voulez-vous vraiment supprimer
            </h5>

            <div class="fs-5 mb-3">
                <strong>
                    {{$client->name}}
                </strong>
            </div>

            <div class="alert alert-danger d-flex align-items-center text-start">

                <i class="bi bi-shield-exclamation fs-5 me-2"></i>

                <small>
                    Cette action est <strong>irréversible</strong>.
                    Les informations associées à ce client pourront être supprimées.
                </small>

            </div>


            {{-- Actions --}}
            <div class="d-flex justify-content-center gap-2 mt-4">

                <button
                    type="button"
                    class="btn btn-outline-secondary"
                    data-bs-dismiss="modal">

                    <i class="bi bi-x-lg me-1"></i>
                    Annuler

                </button>

                <form
                    action="{{route('delete_client', $client)}}"
                    method="post">

                    @csrf
                    @method('delete')

                    <button
                        type="submit"
                        class="btn btn-danger">

                        <i class="bi bi-trash3-fill me-1"></i>
                        Confirmer la suppression

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</div>
