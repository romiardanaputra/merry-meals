{{--
    Data Table Component
    Reusable table with consistent styling
    Based on DASHBOARD_ARCHITECTURE.md specifications

    Props:
    - $headers: Array of column headers
    - $emptyMessage: Message when no data
--}}
@props([
    'headers' => [],
    'emptyMessage' => 'No data available',
])

<div class="bg-white rounded-xl border border-black/5 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-[10px] font-black text-[#222222]/30 uppercase tracking-[0.2em] border-b border-black/5">
                    @foreach($headers as $header)
                        <th class="px-6 py-5">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-black/5">
                {{ $slot }}
            </tbody>
        </table>
    </div>

    {{-- Empty State --}}
    @if(!$slot->isNotEmpty())
        <div class="px-6 py-12 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
            </div>
            <p class="text-sm font-medium text-gray-400">{{ $emptyMessage }}</p>
        </div>
    @endif
</div>
