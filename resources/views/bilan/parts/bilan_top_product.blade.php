<div class="col-lg-6 mb-4">

    <div class="card shadow-sm border-0 h-100">

        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                <i class="bi bi-trophy-fill me-2 text-warning"></i>
                Top produits
            </h5>

            <span class="badge bg-primary">
                Les 10 produits les plus vendus
            </span>

        </div>

        <div class="card-body p-0">

            @if(isset($topProducts) && $topProducts->count())

                @foreach($topProducts as $index => $item)

                    @php
                        $rank = $index + 1;

                        $icon = match($rank) {
                            1 => 'bi-trophy-fill',
                            2, 3 => 'bi-award-fill',
                            default => null,
                        };

                        $badge = match($rank) {
                            1 => 'bg-warning text-dark',
                            2 => 'bg-secondary',
                            3 => 'bg-danger',
                            default => 'bg-light text-dark',
                        };
                    @endphp

                    <div class="p-3 border-bottom">

                        <div class="d-flex align-items-center">

                            {{-- Médaille --}}
                            <div class="rounded-circle
                                bg-{{ $rank == 1 ? 'warning' : ($rank == 2 ? 'secondary' : ($rank == 3 ? 'danger' : 'light')) }}
                                bg-opacity-10
                                d-flex align-items-center justify-content-center me-3"
                                style="width:45px;height:45px;">

                                @if($icon)
                                    <i class="bi {{ $icon }}
                                        text-{{ $rank == 1 ? 'warning' : ($rank == 2 ? 'secondary' : 'danger') }}
                                        fs-4">
                                    </i>
                                @else
                                    <strong class="text-muted">
                                        #{{ $rank }}
                                    </strong>
                                @endif

                            </div>

                            {{-- Produit --}}
                            <div class="flex-grow-1">

                                <div class="d-flex justify-content-between">

                                    <strong>
                                        {{ $item->product->name_product }}
                                    </strong>

                                    <span class="badge {{ $badge }}">
                                        #{{ $rank }}
                                    </span>

                                </div>

                                <small class="text-muted">
                                    {{ $item->total_quantity }} unité{{ $item->total_quantity > 1 ? 's' : '' }}
                                    vendue{{ $item->total_quantity > 1 ? 's' : '' }}
                                </small>

                            </div>

                            {{-- CA --}}
                            <div class="text-end ms-3">

                                <strong class="text-success">
                                    {{ number_format($item->total_sales, 0, ',', ' ') }} Ar
                                </strong>

                                <br>

                                <small class="text-muted">
                                    CA généré
                                </small>

                            </div>

                        </div>

                    </div>

                @endforeach

            @else

                <div class="text-center p-5">

                    <i class="bi bi-box-seam text-muted fs-1"></i>

                    <h6 class="mt-3">
                        Aucun produit vendu
                    </h6>

                    <small class="text-muted">
                        Aucune vente ne correspond à la période sélectionnée.
                    </small>

                </div>

            @endif

        </div>

    </div>

</div>