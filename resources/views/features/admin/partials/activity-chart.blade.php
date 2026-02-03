<div class="flex justify-between items-center mb-8">
    <div>
        <h6 class="text-xl font-black text-dark tracking-tight">Financial Trends</h6>
        <p class="text-[10px] font-bold text-dark/30 uppercase tracking-widest mt-1">Donation volume over time</p>
    </div>
    <div class="hidden md:block">
        <select class="px-5 py-2.5 bg-dark/5 border-none rounded-2xl text-[10px] font-black uppercase tracking-widest text-dark focus:ring-primary">
            <option>Last 7 Days</option>
            <option>This Month</option>
        </select>
    </div>
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
