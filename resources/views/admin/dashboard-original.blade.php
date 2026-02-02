@extends('layouts.palm')

@section('title', 'Admin Dashboard')

@php $pageTitle = 'Harvest Overview'; @endphp

@section('content')
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <x-palm-stat-card 
            title="Total Panen Hari Ini" 
            :value="number_format($todayHarvest / 1000, 1)" 
            unit="Ton"
            icon="scale"
            :change="$todayHarvestChange"
            changeLabel="vs kemarin" />
        
        <x-palm-stat-card 
            title="Panen Bulan Ini" 
            :value="number_format($monthHarvest / 1000, 0)" 
            unit="Ton"
            icon="calendar_month"
            :change="$monthHarvestChange"
            changeLabel="vs bulan lalu" />
        
        <x-palm-stat-card 
            title="Blok Aktif" 
            :value="$activeBlocks . '/' . $totalBlocks" 
            icon="grid_view" />
        
        <x-palm-stat-card 
            title="Rata-rata / Hari" 
            :value="number_format($avgDailyHarvest, 0)" 
            unit="Kg"
            icon="analytics" />
    </div>
    
    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Line Chart Placeholder -->
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm flex flex-col h-full">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-text-main text-base font-bold">Tren Panen Harian</h3>
                    <p class="text-text-secondary text-xs">Berat dalam Kg (30 Hari Terakhir)</p>
                </div>
            </div>
            <div class="flex-1 w-full min-h-[200px] relative">
                <svg class="w-full h-full" viewBox="0 0 400 150" preserveAspectRatio="none">
                    <defs>
                        <linearGradient id="gradient-fill" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0%" stop-color="#66bd0f" stop-opacity="0.2"/>
                            <stop offset="100%" stop-color="#66bd0f" stop-opacity="0"/>
                        </linearGradient>
                    </defs>
                    <line x1="0" y1="120" x2="400" y2="120" stroke="#f0f0f0" stroke-width="1"/>
                    <line x1="0" y1="80" x2="400" y2="80" stroke="#f0f0f0" stroke-width="1"/>
                    <line x1="0" y1="40" x2="400" y2="40" stroke="#f0f0f0" stroke-width="1"/>
                    <path d="M0 100 C 40 100, 60 40, 100 60 S 160 90, 200 70 S 260 30, 320 50 S 360 20, 400 30 V 150 H 0 Z" fill="url(#gradient-fill)"/>
                    <path d="M0 100 C 40 100, 60 40, 100 60 S 160 90, 200 70 S 260 30, 320 50 S 360 20, 400 30" fill="none" stroke="#66bd0f" stroke-width="3" stroke-linecap="round"/>
                </svg>
            </div>
        </div>
        
        <!-- Bar Chart -->
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm flex flex-col h-full">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-text-main text-base font-bold">Panen per Blok</h3>
                    <p class="text-text-secondary text-xs">Total Bulan Ini (Kg)</p>
                </div>
                <a href="{{ route('admin.blocks.index') }}" class="text-xs text-primary font-bold hover:underline">Lihat Detail</a>
            </div>
            <div class="flex-1 flex items-end justify-between gap-2 h-[200px] px-2">
                @php
                    $maxHarvest = $harvestByBlock->max('total_kg') ?: 1;
                @endphp
                @foreach($harvestByBlock->take(8) as $block)
                    @php
                        $height = ($block['total_kg'] / $maxHarvest) * 100;
                    @endphp
                    <div class="group flex flex-col items-center flex-1 gap-2 h-full justify-end cursor-pointer">
                        <div class="w-full max-w-[40px] bg-[#edf3e7] rounded-t-sm relative group-hover:bg-primary transition-colors" 
                             style="height: {{ max($height, 5) }}%">
                            <div class="absolute -top-6 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 bg-black text-white text-[10px] px-2 py-1 rounded transition-opacity whitespace-nowrap">
                                {{ number_format($block['total_kg']) }} Kg
                            </div>
                        </div>
                        <span class="text-xs font-bold text-text-secondary group-hover:text-text-main">{{ $block['code'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <!-- Recent Harvest Entries -->
    <div class="flex flex-col gap-4">
        <div class="flex items-center justify-between">
            <h3 class="text-text-main text-lg font-bold leading-tight tracking-[-0.015em]">Entri Panen Terbaru</h3>
            <div class="flex gap-2">
                <a href="{{ route('admin.harvests.index') }}" class="flex items-center justify-center gap-2 h-8 px-3 rounded-lg border border-surface-border bg-white text-xs font-medium text-text-main hover:bg-surface-light">
                    <span class="material-symbols-outlined text-[16px]">visibility</span>
                    Lihat Semua
                </a>
            </div>
        </div>
        
        <div class="overflow-hidden rounded-xl border border-surface-border bg-white shadow-sm">
            <table class="w-full text-left text-sm">
                <thead class="bg-surface-light border-b border-surface-border">
                    <tr>
                        <th class="px-6 py-3 font-semibold text-text-secondary uppercase text-xs tracking-wider">Tanggal & Waktu</th>
                        <th class="px-6 py-3 font-semibold text-text-secondary uppercase text-xs tracking-wider">Blok</th>
                        <th class="px-6 py-3 font-semibold text-text-secondary uppercase text-xs tracking-wider">Berat (Kg)</th>
                        <th class="px-6 py-3 font-semibold text-text-secondary uppercase text-xs tracking-wider">Petugas</th>
                        <th class="px-6 py-3 font-semibold text-text-secondary uppercase text-xs tracking-wider">Status</th>
                        <th class="px-6 py-3 font-semibold text-text-secondary uppercase text-xs tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($recentHarvests as $harvest)
                        <tr class="hover:bg-[#fafcf8] transition-colors">
                            <td class="px-6 py-4 text-text-main whitespace-nowrap">
                                {{ $harvest->harvest_date->format('d M, Y') }}
                                <span class="text-text-secondary text-xs ml-1">{{ $harvest->created_at->format('h:i A') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#edf3e7] text-text-main">
                                    {{ $harvest->block->code }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-text-main font-semibold">{{ number_format($harvest->weight_kg) }} Kg</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-primary/20 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-primary text-[14px]">person</span>
                                    </div>
                                    <span class="text-text-main">{{ $harvest->officer->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($harvest->isVerified())
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-[#e1f5d6] text-[#0c4e16]">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#66bd0f]"></span>
                                        Terverifikasi
                                    </span>
                                @elseif($harvest->isPending())
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                                        Pending
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.harvests.show', $harvest) }}" class="text-text-secondary hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-text-secondary">
                                Belum ada data panen.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
