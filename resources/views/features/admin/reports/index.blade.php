@extends('features.admin.dashboard')

@section('dashboard_admin')
<div class="space-y-8 pb-12">
    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Donation Trends -->
        <div class="bg-white p-8 rounded-xl shadow-xl shadow-dark/5 border border-border/40">
            <h3 class="text-xs font-black uppercase tracking-widest text-dark/40 mb-6">Donation Trends (Last 7 Days)</h3>
            <canvas id="donationChart" height="250"></canvas>
        </div>

        <!-- Order Distribution -->
        <div class="bg-white p-8 rounded-xl shadow-xl shadow-dark/5 border border-border/40">
            <h3 class="text-xs font-black uppercase tracking-widest text-dark/40 mb-6">Order Status Distribution</h3>
            <canvas id="orderChart" height="250"></canvas>
        </div>
    </div>

    <!-- Survey Feedback -->
    <div class="bg-white rounded-xl shadow-xl shadow-dark/5 border border-border/40 overflow-hidden">
        <div class="p-8 border-b border-border/40">
            <h2 class="text-xl font-black text-dark tracking-tight">Recent Survey Feedback</h2>
            <p class="text-xs font-bold text-dark/40 uppercase tracking-widest mt-1">Direct Insights from Members</p>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-dark/[0.02]">
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">Member</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">Quality Rating</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">Feedback</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-dark/40 border-b border-border/40">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border/40">
                    @forelse($surveys as $survey)
                    <tr class="hover:bg-dark/[0.01] transition-colors">
                        <td class="px-8 py-6">
                            <span class="text-sm font-bold text-dark">{{ $survey->user->name }}</span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center space-x-1">
                                @for($i=1; $i<=5; $i++)
                                    <svg class="w-3 h-3 {{ $i <= $survey->overall ? 'text-primary' : 'text-dark/10' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                @endfor
                            </div>
                        </td>
                        <td class="px-8 py-6 max-w-xs">
                            <p class="text-xs text-dark/60 leading-relaxed truncate hover:text-clip hover:whitespace-normal transition-all duration-500">
                                {{ $survey->feedback }}
                            </p>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-[10px] font-bold text-dark/40 uppercase">{{ $survey->created_at->format('M d, Y') }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-12 text-center text-dark/20 font-black uppercase text-sm tracking-widest">No surveys yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Donation Chart
        const donationCtx = document.getElementById('donationChart').getContext('2d');
        new Chart(donationCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($donationStats->pluck('date')) !!},
                datasets: [{
                    label: 'Total Donations ($)',
                    data: {!! json_encode($donationStats->pluck('total')) !!},
                    borderColor: '#FF7B54',
                    backgroundColor: 'rgba(255, 123, 84, 0.1)',
                    borderWidth: 4,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#FF7B54',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                    x: { grid: { display: false } }
                }
            }
        });

        // Order Chart
        const orderCtx = document.getElementById('orderChart').getContext('2d');
        new Chart(orderCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($orderStats->pluck('status')) !!},
                datasets: [{
                    data: {!! json_encode($orderStats->pluck('count')) !!},
                    backgroundColor: [
                        '#FF7B54', // preparation
                        '#3B82F6', // assigned
                        '#6366F1', // delivery
                        '#10B981', // delivered
                        '#EF4444'  // cancelled
                    ],
                    borderWidth: 0,
                    hoverOffset: 20
                }]
            },
            options: {
                responsive: true,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: { size: 10, weight: 'bold' }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
