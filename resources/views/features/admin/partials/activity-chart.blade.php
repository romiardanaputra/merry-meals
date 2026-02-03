<div class="bg-white rounded-xl p-12 shadow-sm border border-black/5 animate-on-scroll">
    <div class="flex justify-between items-center mb-12">
        <div>
            <h6 class="text-h6 text-dark tracking-tight">Active Analytics</h6>
            <p class="text-[12px] font-bold text-dark/30 italic">Real-time donation flow</p>
        </div>
        <select class="px-4 py-2 bg-dark/5 border-none rounded-xl text-xs font-black uppercase tracking-widest text-dark focus:ring-primary">
            <option>Monthly</option>
            <option>Weekly</option>
        </select>
    </div>

    <!-- Real Bar Chart -->
    <div class="h-64 relative">
        <canvas id="activityBarChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const activityCanvas = document.getElementById('activityBarChart');
        if (activityCanvas) {
            const ctx = activityCanvas.getContext('2d');
            
            // Dynamic data from PHP
            const chartData = {!! json_encode($donationStats->pluck('total')) !!};
            const chartLabels = {!! json_encode($donationStats->pluck('date')) !!};

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Donation Volume',
                        data: chartData,
                        backgroundColor: '#FF7B54',
                        hoverBackgroundColor: '#222222',
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#222222',
                            titleFont: { size: 10, weight: 'bold' },
                            bodyFont: { size: 12, weight: 'black' },
                            padding: 12,
                            cornerRadius: 12,
                            displayColors: false,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(0,0,0,0.05)', drawBorder: false },
                            ticks: { font: { size: 10, weight: 'bold' }, color: 'rgba(0,0,0,0.2)' }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { font: { size: 10, weight: 'bold' }, color: 'rgba(0,0,0,0.2)' }
                        }
                    }
                }
            });
        }
    });
</script>
