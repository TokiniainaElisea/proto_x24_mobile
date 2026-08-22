<div class="col-lg-6 mb-4">

    <div class="card shadow-sm border-0 h-100">

        {{-- Header --}}
        <div class="card-header bg-dark text-white
                    d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                <i class="bi bi-graph-up-arrow me-2"></i>
                Évolution des ventes
            </h5>

            <span class="badge bg-primary">
                <i class="bi bi-calendar3 me-1"></i>
                Comparaison mensuelle
            </span>

        </div>

        {{-- Chart --}}
        <div class="card-body">

            <div style="height: 350px;">
                <canvas id="chartSelling"></canvas>
            </div>

        </div>

    </div>

</div>


<script>
window.addEventListener('load', () => {

    const labels = @json($salesEvolutionLabels);
    const data = @json($salesEvolutionData);

    new Chart(document.getElementById('chartSelling'), {

        type: 'line',

        data: {

            labels: labels,

            datasets: [{

                label: 'Ventes',

                data: data,

                fill: true,

                tension: 0.4,

                borderWidth: 3,

                pointRadius: 5,

                pointHoverRadius: 7,

                pointBorderWidth: 2,

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            interaction: {
                intersect: false,
                mode: 'index'
            },

            plugins: {

                legend: {
                    display: false
                },

                tooltip: {

                    backgroundColor: '#212529',

                    titleColor: '#fff',

                    bodyColor: '#fff',

                    padding: 12,

                    cornerRadius: 8,

                    displayColors: false,

                    callbacks: {

                        label: function(context) {

                            return ` ${context.parsed.y} vente${
                                context.parsed.y > 1 ? 's' : ''
                            }`;

                        }

                    }

                }

            },

            scales: {

                x: {

                    grid: {
                        display: false
                    },

                    ticks: {
                        padding: 8
                    }

                },

                y: {

                    beginAtZero: true,

                    ticks: {

                        precision: 0,

                        padding: 8

                    },

                    grid: {

                        color: 'rgba(0, 0, 0, 0.06)',

                        drawBorder: false

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