@extends('layouts.palm')

@section('title', 'Admin Dashboard')

@php $pageTitle = 'Dashboard'; @endphp

@section('content')
    <!-- Stats Cards - Theme Color Design -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Divisi -->
        <div class="bg-[#edf3e7] border border-surface-border rounded-xl p-6 text-center hover:shadow-md transition-shadow">
            <p class="text-text-secondary text-sm font-medium mb-2">Total Divisi</p>
            <p class="text-5xl font-bold text-text-main">{{ $totalDivisions }}</p>
        </div>
        
        <!-- Total Blok -->
        <div class="bg-[#edf3e7] border border-surface-border rounded-xl p-6 text-center hover:shadow-md transition-shadow">
            <p class="text-text-secondary text-sm font-medium mb-2">Total Blok</p>
            <p class="text-5xl font-bold text-text-main">{{ $totalBlocks }}</p>
        </div>
        
        <!-- Verified -->
        <div class="bg-[#e1f5d6] border border-primary/20 rounded-xl p-6 text-center hover:shadow-md transition-shadow">
            <p class="text-primary text-sm font-medium mb-2">Terverifikasi</p>
            <p class="text-5xl font-bold text-primary">{{ $verifiedCount }}</p>
        </div>
        
        <!-- Pending -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 text-center hover:shadow-md transition-shadow">
            <p class="text-yellow-700 text-sm font-medium mb-2">Pending</p>
            <p class="text-5xl font-bold text-yellow-600">{{ $pendingCount }}</p>
        </div>
    </div>

    <!-- Latest Data Table -->
    <div class="mt-8">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-text-main">Data Panen Terbaru</h3>
            <a href="{{ route('admin.harvests.index') }}" class="text-sm text-primary hover:underline font-medium flex items-center gap-1">
                <span class="material-symbols-outlined text-[18px]">filter_list</span>
                Filter & Lihat Semua
            </a>
        </div>
        
        <div class="bg-white border border-surface-border rounded-xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
            <table class="w-full text-left text-sm min-w-[800px]">
                <thead class="bg-[#edf3e7] border-b border-surface-border">
                    <tr>
                        <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Divisi</th>
                        <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Block</th>
                        <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Luas</th>
                        <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">No. SPK</th>
                        <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Total</th>
                        <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Tanggal Terakhir</th>
                        <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($recentHarvests as $harvest)
                        <tr class="hover:bg-[#fafcf8] transition-colors">
                            <td class="px-4 py-3 text-text-main">{{ $harvest->block->name ?? '-' }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#edf3e7] text-text-main">
                                    {{ $harvest->block->code }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-text-main">{{ $harvest->block->area_hectares ?? '-' }} Ha</td>
                            <td class="px-4 py-3 text-text-secondary">{{ $harvest->no_spk ?? '-' }}</td>
                            <td class="px-4 py-3 text-text-main font-semibold">{{ number_format($harvest->weight_kg) }} Kg</td>
                            <td class="px-4 py-3 text-text-main">{{ $harvest->harvest_date->format('d/m/Y') }}</td>
                            <td class="px-4 py-3">
                                @if($harvest->isVerified())
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-[#e1f5d6] text-[#0c4e16]">
                                        <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                                        OK
                                    </span>
                                @elseif($harvest->isPending())
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                                        Hold
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                        Reject
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-text-secondary">Belum ada data panen.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </div>
        </div>
    </div>
@endsection
