<div class="row mb-3">

    {{-- ================= TABLEAU ================= --}}
    <div class="product-table-wrapper">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0 product-table">

                <thead>

                    <tr>

                        <th>
                            Photo
                        </th>

                        <th>
                            Nom
                        </th>

                        <th>
                            Prix
                        </th>

                        <th>
                            Stock
                        </th>

                        <th class="text-center">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach ($products as $product)
                        <tr>

                            {{-- ================= PHOTO ================= --}}
                            <td>

                                <button class="btn p-0 border-0 product-image-button" data-bs-toggle="modal"
                                    data-bs-target="{{ '#product_' . $product->id }}">

                                    <img src="{{ $product->image_path ? asset($product->image_path) : asset('uploads/product/sans.png') }}"
                                        class="rounded border shadow-sm product-image" alt="Produit">

                                </button>


                                @include('products.liste.image_product', [
                                    'id' => $product->id,
                                    'image_link' => $product->image_path
                                        ? asset($product->image_path)
                                        : asset('uploads/product/sans.png'),
                                    'product_name' => $product->name_product,
                                ])

                            </td>


                            {{-- ================= NOM ================= --}}
                            <td class="fw-semibold">

                                <span class="product-name">

                                    {{ $product->name_product }}

                                </span>

                            </td>


                            {{-- ================= PRIX ================= --}}
                            <td>

                                <span class="text-success fw-bold product-price">

                                    {{ number_format($product->price, 0, ',', ' ') }} Ar

                                </span>

                            </td>


                            {{-- ================= STOCK ================= --}}
                            <td>

                                @if ($product->mouvement->sum('in_stock') > 0)
                                    <span class="badge bg-success stock-badge">

                                        <i class="bi bi-box-seam me-1"></i>

                                        {{ $product->mouvement->sum('in_stock') }}

                                    </span>
                                @else
                                    <span class="badge bg-danger stock-badge">

                                        <i class="bi bi-exclamation-triangle-fill me-1"></i>

                                        Rupture

                                    </span>
                                @endif

                            </td>


                            {{-- ================= ACTIONS ================= --}}
                            <td class="text-center">

                                <div class="btn-group product-actions">

                                    <a href="{{ route('modify_product', $product) }}" class="btn btn-warning btn-sm"
                                        title="Modifier">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>


                                    <a href="{{ route('show_product', $product) }}"
                                        class="btn btn-info text-white btn-sm" title="Voir">

                                        <i class="bi bi-eye-fill"></i>

                                    </a>

                                </div>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>


    {{-- ================= PAGINATION ================= --}}
    <div class="mt-3">

        {{ $products->withQueryString()->links() }}

    </div>

</div>


<style>
    /*
    ============================================================
    CONTENEUR
    ============================================================
    */

    .product-table-wrapper {
        width: 100%;
        max-width: 100%;
    }


    /*
    ============================================================
    SCROLL HORIZONTAL
    ============================================================
    */

    .product-table-wrapper .table-responsive {
        width: 100%;
        max-width: 100%;

        overflow-x: auto;
        overflow-y: hidden;

        -webkit-overflow-scrolling: touch;
    }


    /*
    ============================================================
    TABLEAU
    ============================================================
    */

    .product-table {
        min-width: 650px;
    }


    /*
    Pas de retour à la ligne.
    */

    .product-table th,
    .product-table td {
        white-space: nowrap;
    }


    /*
    ============================================================
    PHOTO
    ============================================================
    */

    .product-image {
        width: 50px;
        height: 50px;

        object-fit: cover;

        transition: 0.2s;
    }


    .product-image-button:hover .product-image {
        transform: scale(1.05);
    }


    /*
    ============================================================
    NOM
    ============================================================
    */

    .product-name {
        display: inline-block;

        min-width: 180px;

        white-space: nowrap;
    }


    /*
    ============================================================
    PRIX
    ============================================================
    */

    .product-price {
        min-width: 110px;
        display: inline-block;
    }


    /*
    ============================================================
    STOCK
    ============================================================
    */

    .stock-badge {
        min-width: 80px;
        padding: 0.5rem 0.75rem;
    }


    /*
    ============================================================
    ACTIONS
    ============================================================
    */

    .product-actions {
        white-space: nowrap;
    }


    /*
    ============================================================
    MOBILE
    ============================================================
    */

    @media (max-width: 767.98px) {

        /*
        Largeur minimale du tableau.
        Le scroll reste uniquement dans
        .table-responsive.
        */

        .product-table {
            min-width: 580px;
            font-size: 0.78rem;
        }


        /*
        Cellules plus compactes
        */

        .product-table th,
        .product-table td {
            padding: 0.5rem 0.4rem;
        }


        /*
        Photo
        */

        .product-image {
            width: 40px;
            height: 40px;
        }


        /*
        Nom
        */

        .product-name {
            min-width: 150px;
            font-size: 0.78rem;
        }


        /*
        Prix
        */

        .product-price {
            min-width: 100px;
            font-size: 0.75rem;
        }


        /*
        Stock
        */

        .stock-badge {
            min-width: 70px;
            padding: 0.4rem 0.55rem;
            font-size: 0.7rem;
        }


        /*
        Actions
        */

        .product-actions .btn {
            padding: 0.25rem 0.4rem;
            font-size: 0.7rem;
        }

    }


    /*
    ============================================================
    TRÈS PETITS ÉCRANS
    ============================================================
    */

    @media (max-width: 400px) {

        .product-table {
            min-width: 550px;
            font-size: 0.72rem;
        }


        .product-table th,
        .product-table td {
            padding: 0.4rem 0.3rem;
        }


        /*
        Photo encore un peu plus petite
        */

        .product-image {
            width: 35px;
            height: 35px;
        }


        /*
        Nom
        */

        .product-name {
            min-width: 135px;
            font-size: 0.72rem;
        }


        /*
        Prix
        */

        .product-price {
            min-width: 90px;
            font-size: 0.7rem;
        }


        /*
        Stock
        */

        .stock-badge {
            min-width: 65px;
            padding: 0.35rem 0.45rem;
            font-size: 0.65rem;
        }


        /*
        Actions
        */

        .product-actions .btn {
            padding: 0.2rem 0.3rem;
            font-size: 0.65rem;
        }

    }
</style>
