<nav class="navbar navbar-dark bg-dark border-bottom border-secondary shadow-sm fixed-top">
    <div class="container-fluid d-flex">
        <span class="navbar-brand text-decoration-none">

            <div class="fw-bold text-white fs-5">
                Proto <span class="text-primary">x-24 mobile</span>
            </div>
        </span>
        <button class="btn btn-dark d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar"
            aria-controls="mobileSidebar">

            <i class="bi bi-list fs-4"></i>

        </button>
    </div>
</nav>

<div class="offcanvas offcanvas-start bg-dark" tabindex="-1" id="mobileSidebar"
    aria-labelledby="offcanvasWithBothOptionsLabel">
    <div class="offcanvas-header text-white">
        <div>

            <div class="fw-bold fs-5 text-white">
                Proto <span class="text-primary">x-24 mobile</span>
            </div>

            <small class="text-secondary">
                Menu principal
            </small>

        </div>
        <button type="button" class="btn text-white" data-bs-dismiss="offcanvas" aria-label="Close"> <i
                class="bi bi-x fs-3"> </i> </button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav nav-pills flex-column gap-1">


            {{-- ================= PRINCIPAL ================= --}}
            <li class="nav-item">

                <small class="text-uppercase text-secondary fw-bold px-3">
                    Principal
                </small>

            </li>


            <li class="nav-item">

                <a href="{{ route('dashboard') }}"
                    class="nav-link text-white rounded-3
                    {{ request()->routeIs('dashboard') ? 'active bg-primary' : '' }}">

                    <i class="bi bi-speedometer2 me-2"></i>
                    Dashboard

                </a>

            </li>


            {{-- ================= GESTION ================= --}}
            <li class="nav-item mt-3">

                <small class="text-uppercase text-secondary fw-bold px-3">
                    Gestion
                </small>

            </li>


            <li class="nav-item">

                <a href="{{ route('ventes') }}"
                    class="nav-link text-white rounded-3
                    {{ request()->routeIs('ventes*') ? 'active bg-primary' : '' }}">

                    <i class="bi bi-cart3 me-2"></i>
                    Ventes

                </a>

            </li>


            <li class="nav-item">

                <a href="{{ route('produits') }}"
                    class="nav-link text-white rounded-3
                    {{ request()->routeIs('produits*') ? 'active bg-primary' : '' }}">

                    <i class="bi bi-box-seam me-2"></i>
                    Produits

                </a>

            </li>


            {{-- ================= FINANCE ================= --}}
            <li class="nav-item mt-3">

                <small class="text-uppercase text-secondary fw-bold px-3">
                    Finance
                </small>

            </li>


            <li class="nav-item">

                <a href="{{ route('bilan') }}"
                    class="nav-link text-white rounded-3
                    {{ request()->routeIs('bilan') ? 'active bg-primary' : '' }}">

                    <i class="bi bi-bar-chart-line me-2"></i>
                    Bilan

                </a>

            </li>


            {{-- ================= RELATIONS ================= --}}
            <li class="nav-item mt-3">

                <small class="text-uppercase text-secondary fw-bold px-3">
                    Relation
                </small>

            </li>


            <li class="nav-item">

                <a href="{{ route('client') }}"
                    class="nav-link text-white rounded-3
                    {{ request()->routeIs('client*') ? 'active bg-primary' : '' }}">

                    <i class="bi bi-people-fill me-2"></i>
                    Clients

                </a>

            </li>

            <li class="nav-item">

                <a href="{{ route('provider') }}"
                    class="nav-link text-white rounded-3
                    {{ request()->routeIs('provider*') ? 'active bg-primary' : '' }}">

                    <i class="bi bi-truck me-2"></i>
                    Fournisseurs

                </a>

            </li>

            <li class="nav-item mt-3">

                <small class="text-uppercase text-secondary fw-bold px-3">
                    Autre
                </small>

            </li>

            {{-- ================= PARAMÈTRES ================= --}}
            <li class="nav-item mt-1">

                <a class="nav-link text-white rounded-3" data-bs-toggle="collapse" href="#settingsMenu" role="button"
                    aria-expanded="false" aria-controls="settingsMenu">

                    <i class="bi bi-gear me-2"></i>
                    Paramètres

                    <i class="bi bi-chevron-down float-end mt-1 small"></i>

                </a>


                <div class="collapse" id="settingsMenu">

                    <ul class="nav flex-column mt-1 ms-2">

                        <li class="nav-item">

                            <a href="{{ route('company') }}" class="nav-link text-white">

                                <i class="bi bi-building me-2"></i>
                                Société

                            </a>

                        </li>


                        <li class="nav-item">

                            <a href="{{ route('numbering') }}" class="nav-link text-white">

                                <i class="bi bi-hash me-2"></i>
                                Préfixes

                            </a>

                        </li>


                        <li class="nav-item">

                            <a href="{{ route('about') }}" class="nav-link text-white">

                                <i class="bi bi-info-circle me-2"></i>
                                À propos

                            </a>

                        </li>

                    </ul>

                </div>

            </li>

        </ul>
    </div>
</div>
<div style="height: 105px;">

</div>
