<div class="col-lg-6 mb-4">

    <div class="card shadow-sm border-0 h-100">

        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                <i class="bi bi-graph-up-arrow me-2"></i>
                Évolution des ventes
            </h5>

            <span class="badge bg-primary">
                Cette semaine
            </span>

        </div>

        <div class="card-body">

            <canvas id="chartSelling" height="350"></canvas>

        </div>

    </div>

</div>

<script>
window.addEventListener('load', () => {

    const labels = @json($salesLabel);
    const data = @json($salesData);

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

            plugins: {

                legend: {

                    display: false

                },

                tooltip: {

                    backgroundColor: "#212529",

                    titleColor: "#fff",

                    bodyColor: "#fff",

                    padding: 12

                }

            },

            scales: {

                x: {

                    grid: {

                        display: false

                    }

                },

                y: {

                    beginAtZero: true,

                    ticks: {

                        precision: 0

                    }

                }

            }

        }

    });

});
</script>