@if (!$begin || !$ending)
    <div class="card border-0 shadow-sm my-4">

        <div class="card-body text-center py-5">

            <div class="rounded-circle
                        d-inline-flex align-items-center justify-content-center mb-3"
                style="width: 70px; height: 70px;">

                <i class="bi bi-bar-chart-line-fill text-primary fs-2"></i>

            </div>

            <h4 class="fw-bold">
                Consultez votre activité
            </h4>

            <p class="text-muted mb-0">
                Sélectionnez une date de début et une date de fin
                pour générer votre bilan.
            </p>

        </div>

    </div>
@else
    @include('bilan.parts.bilan_resume')
    <div class="row mb-3">
        @include('bilan.parts.bilan_categories')
        @include('bilan.parts.bilan_per_month')
    </div>

    <div class="row mb-3">
        @include('bilan.parts.bilan_top_product')
        @include('bilan.parts.bilan_stock')
    </div>
@endif
