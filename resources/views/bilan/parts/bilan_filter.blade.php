<div class="card shadow-sm my-3">

    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">
            <i class="bi bi-funnel-fill me-2"></i>
            Filtrer la période à consulter
        </h5>
    </div>

    <div class="card-body">

        <form method="GET" action="{{ route('bilan') }}">

            <div class="row g-3 align-items-end">

                {{-- Date de début --}}
                <div class="col-md-4">

                    <label for="begin" class="form-label fw-semibold">
                        <i class="bi bi-calendar-event me-1 text-primary"></i>
                        Début
                    </label>

                    <input
                        type="date"
                        id="begin"
                        name="begin"
                        class="form-control"
                        value="{{ request('begin') }}"
                    >

                </div>

                {{-- Date de fin --}}
                <div class="col-md-4">

                    <label for="ending" class="form-label fw-semibold">
                        <i class="bi bi-calendar-check me-1 text-success"></i>
                        Fin
                    </label>

                    <input
                        type="date"
                        id="ending"
                        name="ending"
                        class="form-control"
                        value="{{ request('ending') }}"
                    >

                </div>

                {{-- Boutons --}}
                <div class="col-md-4">

                    <div class="d-flex justify-content-end">

                        <a
                            href="{{ route('bilan') }}"
                            class="btn btn-outline-secondary me-2"
                        >
                            <i class="bi bi-arrow-counterclockwise me-1"></i>
                            Réinitialiser
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-bar-chart-line me-1"></i>
                            Consulter
                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>