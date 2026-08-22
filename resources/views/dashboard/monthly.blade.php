@php
    $datas;
@endphp

<h5 class="h5"> Évolution des ventes </h5>
<div class="row">
    @include('dashboard.charts.category')
    @include('dashboard.charts.selling')
</div>

