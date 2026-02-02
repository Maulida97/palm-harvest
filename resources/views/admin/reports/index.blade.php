@extends('layouts.palm')

@section('title', 'Laporan')

@php $pageTitle = 'Laporan Panen'; @endphp

@section('content')
    <!-- Filters -->
    <div class="bg-white p-4 rounded-xl border border-surface-border shadow-sm">
        <form method="GET" class="flex flex-wrap gap-4 items-end">
            <div>
                <label class="block text-xs font-medium text-text-secondary mb-1">Periode</label>
                <select name="period" class="h-10 px-3 rounded-lg border border-surface-border text-sm">
                    <option value="week" {{ $period === 'week' ? 'selected' : '' }}>Minggu Ini</option>
                    <option value="month" {{ $period === 'month' ? 'selected' : '' }}>Bulan Ini</option>
                    <option value="year" {{ $period === 'year' ? 'selected' : '' }}>Tahun Ini</option>
                    <option value="custom" {{ $period === 'custom' ? 'selected' : '' }}>Custom</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-text-secondary mb-1">Blok</label>
                <select name="block_id" class="h-10 px-3 rounded-lg border border-surface-border text-sm">
                    <option value="">Semua Blok</option>
                    @foreach($blocks as $block)
                        <option value="{{ $block->id }}" {{ $blockId == $block->id ? 'selected' : '' }}>{{ $block->code }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="h-10 px-4 bg-primary text-white rounded-lg text-sm font-semibold">Terapkan</button>
            <a href="{{ route('admin.reports.export', request()->query()) }}" class="h-10 px-4 bg-white border border-primary text-primary rounded-lg text-sm font-semibold flex items-center gap-1">
                <span class="material-symbols-outlined text-[18px]">download</span>
                Export CSV
            </a>
        </form>
    </div>

    <!-- Summary Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <x-palm-stat-card title="Total Panen" :value="number_format($totalHarvest)" unit="Kg" icon="scale" />
        <x-palm-stat-card title="Jumlah Entri" :value="$harvestCount" icon="inventory_2" />
        <x-palm-stat-card title="Rata-rata" :value="number_format($avgHarvest)" unit="Kg" icon="analytics" />
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- By Block -->
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
            <h3 class="text-base font-bold text-text-main mb-4">Panen per Blok</h3>
            <div class="space-y-3">
                @php $maxBlock = $harvestByBlock->max('total_kg') ?: 1; @endphp
                @foreach($harvestByBlock as $item)
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span>{{ $item->block->code }}</span>
                            <span class="font-semibold">{{ number_format($item->total_kg) }} Kg</span>
                        </div>
                        <div class="h-2 bg-surface-light rounded-full overflow-hidden">
                            <div class="h-full bg-primary rounded-full" style="width: {{ ($item->total_kg / $maxBlock) * 100 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- By Date -->
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
            <h3 class="text-base font-bold text-text-main mb-4">Tren Harian</h3>
            <div class="h-48 flex items-end gap-1">
                @php $maxDate = $harvestByDate->max('total_kg') ?: 1; @endphp
                @foreach($harvestByDate->take(30) as $item)
                    <div class="flex-1 bg-primary/20 hover:bg-primary rounded-t transition-colors cursor-pointer group relative" 
                         style="height: {{ ($item->total_kg / $maxDate) * 100 }}%">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 bg-black text-white text-[10px] px-2 py-1 rounded whitespace-nowrap z-10">
                            {{ number_format($item->total_kg) }} Kg
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-between text-xs text-text-secondary mt-2">
                <span>{{ $startDate->format('d M') }}</span>
                <span>{{ $endDate->format('d M Y') }}</span>
            </div>
        </div>
    </div>
@endsection
