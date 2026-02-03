@extends('features.admin.dashboard')

@section('dashboard_admin')
<div class="space-y-8 pb-12">
    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Donation Trends -->
        <div class="bg-white p-8 rounded-2xl shadow-xl shadow-dark/5">
            <h3 class="text-xs font-black uppercase tracking-widest text-dark/40 mb-6 font-primary">Donation Trends (Last 7 Days)</h3>
            <div class="relative h-[250px]">
                <canvas id="donationChart"></canvas>
            </div>
        </div>

        <!-- Order Distribution -->
        <div class="bg-white p-8 rounded-2xl shadow-xl shadow-dark/5">
            <h3 class="text-xs font-black uppercase tracking-widest text-dark/40 mb-6 font-primary">Order Status Distribution</h3>
            <div class="relative h-[250px]">
                <canvas id="orderChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Survey Feedback --}}
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
            <div>
                <h2 class="text-2xl font-black text-dark tracking-tight">Operations Insights</h2>
                <p class="text-xs font-bold text-dark/40 uppercase tracking-[0.2em] mt-1">Direct feedback from members and community</p>
            </div>
        </div>

        {{-- Header Row (Desktop) --}}
        <div class="hidden lg:grid grid-cols-12 px-8 py-3 bg-gray-50/50 rounded-xl mb-4">
            <div class="col-span-3 text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">Member</div>
            <div class="col-span-2 text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">Quality Rating</div>
            <div class="col-span-5 text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">Feedback Transcript</div>
            <div class="col-span-2 text-right text-[10px] font-black uppercase tracking-[0.2em] text-dark/30">Submitted At</div>
        </div>

        <div class="space-y-4">
            @forelse($surveys as $survey)
            <div class="bg-white rounded-2xl p-6 lg:p-0 lg:px-8 lg:py-6 flex flex-col lg:grid lg:grid-cols-12 items-center gap-6 lg:gap-0 hover:shadow-2xl hover:shadow-primary/5 transition-all duration-500 group">
                {{-- Member --}}
                <div class="lg:col-span-3 w-full">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0">
                            <span class="text-primary font-black text-sm uppercase">{{ substr($survey->user->name, 0, 1) }}</span>
                        </div>
                        <span class="text-sm font-black text-dark tracking-tight">{{ $survey->user->name }}</span>
                    </div>
                </div>

                {{-- Rating --}}
                <div class="lg:col-span-2 w-full">
                    <div class="flex items-center space-x-1">
                        @for($i=1; $i<=5; $i++)
                            <svg class="w-3.5 h-3.5 {{ $i <= $survey->overall ? 'text-primary' : 'text-dark/10' }} transition-colors duration-300" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <span class="text-[9px] font-black text-dark/20 uppercase mt-1 block font-primary tracking-widest">{{ $survey->overall }}/5 Excellence</span>
                </div>

                {{-- Feedback --}}
                <div class="lg:col-span-5 w-full">
                    <p class="text-[13px] font-medium text-dark/60 leading-relaxed italic line-clamp-2 lg:line-clamp-none group-hover:text-dark transition-colors">
                        "{{ $survey->feedback }}"
                    </p>
                </div>

                {{-- Date --}}
                <div class="lg:col-span-2 w-full text-right">
                    <div class="flex flex-col lg:items-end">
                        <span class="text-[11px] font-black text-dark/80 tracking-tight">{{ $survey->created_at->format('M d, Y') }}</span>
                        <span class="text-[9px] font-bold text-dark/20 uppercase tracking-widest">{{ $survey->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-2xl p-16 text-center shadow-sm">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                    </svg>
                </div>
                <p class="text-sm font-black text-dark/20 uppercase tracking-[0.3em]">No direct feedback received</p>
            </div>
            @endforelse
        </div>

        <div class="mt-12 px-4">
            {{ $surveys->links('partials.custom-pagination') }}
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Donation Chart
        const donationEl = document.getElementById('donationChart');
        if (donationEl) {
            const donationCtx = donationEl.getContext('2d');
            const gradient = donationCtx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(255, 123, 84, 0.4)');
            gradient.addColorStop(1, 'rgba(255, 123, 84, 0)');

            new Chart(donationCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($donationStats->pluck('date')) !!},
                    datasets: [{
                        label: 'Total Donations ($)',
                        data: {!! json_encode($donationStats->pluck('total')) !!},
                        borderColor: '#FF7B54',
                        backgroundColor: gradient,
                        borderWidth: 5,
                        tension: 0.5,
                        fill: true,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#FF7B54',
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 10,
                        pointHoverBorderWidth: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#222222',
                            padding: 12,
                            cornerRadius: 12,
                            titleFont: { weight: 'bold' }
                        }
                    },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            grid: { color: 'rgba(0,0,0,0.03)', drawBorder: false },
                            ticks: { font: { size: 10, weight: 'bold' } }
                        },
                        x: { 
                            grid: { display: false },
                            ticks: { font: { size: 10, weight: 'bold' } }
                        }
                    }
                }
            });
        }

        // Order Chart
        const orderEl = document.getElementById('orderChart');
        if (orderEl) {
            const orderCtx = orderEl.getContext('2d');
            const orderLabels = {!! json_encode($orderStats->pluck('status')) !!};
            const colorMap = {
                'preparation': '#FF7B54',
                'assigned': '#3B82F6',
                'delivery': '#6366F1',
                'delivered': '#10B981',
                'cancelled': '#EF4444'
            };
            const bgColors = orderLabels.map(label => colorMap[label] || '#222222');

            new Chart(orderCtx, {
                type: 'doughnut',
                data: {
                    labels: orderLabels,
                    datasets: [{
                        data: {!! json_encode($orderStats->pluck('count')) !!},
                        backgroundColor: bgColors,
                        borderWidth: 8,
                        borderColor: '#ffffff',
                        hoverOffset: 15,
                        borderRadius: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 30,
                                font: { size: 9, weight: 'black', family: 'Inter' },
                                color: '#222222'
                            }
                        },
                        tooltip: {
                            backgroundColor: '#222222',
                            padding: 12,
                            cornerRadius: 12
                        }
                    }
                }
            });
        }
    });
</script>
@endsection
