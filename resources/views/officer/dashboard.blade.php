@extends('layouts.palm')

@section('title', 'Dashboard Petugas')

@php $pageTitle = 'Dashboard Petugas'; @endphp

@section('content')
    <!-- Quick Action -->
    <div class="bg-gradient-to-r from-primary to-primary/80 rounded-xl p-6 text-white">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-xl font-bold mb-1">Selamat Datang, {{ auth()->user()->name }}!</h2>
                <p class="text-white/80 text-sm">Catat hasil panen hari ini dengan cepat dan mudah.</p>
            </div>
            <a href="{{ route('officer.harvests.create') }}" 
               class="flex items-center gap-2 bg-white text-primary px-6 py-3 rounded-lg font-semibold hover:bg-white/90 transition-colors shadow-lg">
                <span class="material-symbols-outlined">add_circle</span>
                Input Panen Baru
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <x-palm-stat-card 
            title="Panen Hari Ini" 
            :value="number_format($todayHarvest, 0)" 
            unit="Kg"
            icon="scale" />
        
        <x-palm-stat-card 
            title="Panen Bulan Ini" 
            :value="number_format($monthHarvest, 0)" 
            unit="Kg"
            icon="calendar_month" />
        
        <x-palm-stat-card 
            title="Total Entri" 
            :value="$totalEntries" 
            icon="inventory_2" />
        
        <x-palm-stat-card 
            title="Menunggu Verifikasi" 
            :value="$pendingCount" 
            icon="pending" />
    </div>

    <!-- Quick Entry & Recent History -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Quick Entry -->
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
            <h3 class="text-text-main text-base font-bold mb-4">Input Cepat</h3>
            <form action="{{ route('officer.harvests.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="block_id" class="block text-sm font-medium text-text-main mb-1">Pilih Blok</label>
                    <select name="block_id" id="block_id" required
                            class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                        <option value="">-- Pilih Blok --</option>
                        @foreach($activeBlocks as $block)
                            <option value="{{ $block->id }}">{{ $block->code }} - {{ $block->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="weight_kg" class="block text-sm font-medium text-text-main mb-1">Berat (Kg)</label>
                    <input type="number" name="weight_kg" id="weight_kg" step="0.01" min="0.01" required
                           placeholder="Contoh: 1250.50"
                           class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                </div>
                <div>
                    <label for="harvest_date" class="block text-sm font-medium text-text-main mb-1">Tanggal Panen</label>
                    <input type="date" name="harvest_date" id="harvest_date" required
                           value="{{ date('Y-m-d') }}"
                           max="{{ date('Y-m-d') }}"
                           class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                </div>
                <button type="submit" 
                        class="w-full h-10 bg-primary hover:bg-primary/90 text-white rounded-lg font-semibold transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    Simpan
                </button>
            </form>
        </div>

        <!-- Recent Harvests -->
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-text-main text-base font-bold">Riwayat Terbaru</h3>
                <a href="{{ route('officer.harvests.index') }}" class="text-xs text-primary font-bold hover:underline">Lihat Semua</a>
            </div>
            <div class="space-y-3">
                @forelse($recentHarvests as $harvest)
                    <div class="flex items-center justify-between p-3 bg-surface-light rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined text-primary">inventory_2</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-text-main">{{ $harvest->block->code }}</p>
                                <p class="text-xs text-text-secondary">{{ $harvest->harvest_date->format('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-text-main">{{ number_format($harvest->weight_kg) }} Kg</p>
                            @if($harvest->isVerified())
                                <span class="text-xs text-green-600">✓ Verified</span>
                            @elseif($harvest->isPending())
                                <span class="text-xs text-yellow-600">Pending</span>
                            @else
                                <span class="text-xs text-red-600">Ditolak</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-center text-text-secondary text-sm py-4">Belum ada data panen.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
