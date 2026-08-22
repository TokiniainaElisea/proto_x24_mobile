<div class="col-lg-6 mb-4">

    <div class="card shadow-sm border-0 h-100">

        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                <i class="bi bi-shop me-2"></i>
                Ventes par catégorie
            </h5>

            <span class="badge bg-primary">
                Ce moi-ci
            </span>

        </div>

        <div class="card-body">

            <canvas id="chartCategory" height="350"></canvas>

        </div>

    </div>

</div>


<script>
    window.addEventListener('load', () => {
        const labels = @json($categoryLabels);
        const data = @json($categoryData);
        const ctx = document.getElementById('chartCategory');

        // Palette de couleurs professionnelle
        const colors = [
            '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e',
            '#e74a3b', '#858796', '#5a5c69', '#2e59d9'
        ];

        // Création du graphique
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
                                    total > 0 ?
                                    ((context.parsed / total) * 100).toFixed(1) :
                                    0;

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
