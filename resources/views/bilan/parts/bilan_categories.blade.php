<div class="col-lg-6 mb-4">

    <div class="card shadow-sm border-0 h-100">

        {{-- Header --}}
        <div class="card-header bg-dark text-white
                    d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                <i class="bi bi-pie-chart-fill me-2"></i>
                Ventes par catégorie
            </h5>

            <span class="badge bg-primary">
                {{ request('begin') ? \Carbon\Carbon::parse(request('begin'))->format('d/m/Y') : 'Début' }}
                -
                {{ request('ending') ? \Carbon\Carbon::parse(request('ending'))->format('d/m/Y') : 'Aujourd’hui' }}
            </span>

        </div>

        {{-- Chart --}}
        <div class="card-body">

            <div style="height: 350px;">
                <canvas id="chartCategory"></canvas>
            </div>

        </div>

    </div>

</div>


<script>
window.addEventListener('load', () => {

    const labels = @json($categoryLabels);
    const data = @json($categoryData);

    const ctx = document.getElementById('chartCategory');

    new Chart(ctx, {

        type: 'doughnut',

        data: {
            labels: labels,

            datasets: [{
                label: 'Ventes',
                data: data,

                borderWidth: 2,
                //borderColor: '#ffffff',

                hoverOffset: 8
            }]
        },

        options: {

            responsive: true,
            maintainAspectRatio: false,

            cutout: '65%',

            plugins: {

                legend: {
                    position: 'bottom',

                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },

                tooltip: {

                    backgroundColor: 'rgba(33, 37, 41, 0.95)',

                    titleColor: '#fff',
                    bodyColor: '#fff',

                    padding: 12,

                    cornerRadius: 8,

                    displayColors: true,

                    callbacks: {

                        label: function(context) {

                            const value = context.parsed;

                            return ` ${value} vente${value > 1 ? 's' : ''}`;
                        },

                        afterLabel: function(context) {

                            const dataset = context.dataset.data;

                            const total = dataset.reduce(
                                (sum, value) => sum + Number(value),
                                0
                            );

                            const percentage =
                                total > 0
                                    ? ((context.parsed / total) * 100).toFixed(1)
                                    : 0;

                            return ` ${percentage}% du total`;
                        }
                    }
                }
            },

            animation: {
                duration: 800,
                easing: 'easeInOutQuart'
            }
        }
    });

});
</script>