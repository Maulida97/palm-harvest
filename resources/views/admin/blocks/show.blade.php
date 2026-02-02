@extends('layouts.palm')

@section('title', 'Detail Blok')

@php $pageTitle = 'Detail Blok'; @endphp

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.blocks.index') }}" class="text-primary hover:underline text-sm flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">arrow_back</span>
            Kembali ke Daftar Blok
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Block Info -->
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
            <h2 class="text-lg font-bold text-text-main mb-4">Informasi Blok</h2>
            <dl class="space-y-3">
                <div>
                    <dt class="text-xs text-text-secondary">Divisi</dt>
                    <dd class="text-text-main font-semibold">{{ $block->division->name ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-text-secondary">Kode</dt>
                    <dd class="text-text-main font-semibold">{{ $block->code }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-text-secondary">Nama</dt>
                    <dd class="text-text-main">{{ $block->name }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-text-secondary">Luas</dt>
                    <dd class="text-text-main">{{ $block->area_hectares ?? '-' }} Hektar</dd>
                </div>
                <div>
                    <dt class="text-xs text-text-secondary">Jumlah Pokok</dt>
                    <dd class="text-text-main font-semibold">{{ number_format($block->tree_count ?? 0) }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-text-secondary">Status</dt>
                    <dd>
                        @if($block->status === 'active')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-[#e1f5d6] text-[#0c4e16]">Aktif</span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">Nonaktif</span>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-xs text-text-secondary">Deskripsi</dt>
                    <dd class="text-text-main text-sm">{{ $block->description ?? '-' }}</dd>
                </div>
            </dl>
            
            <div class="mt-6 pt-4 border-t border-surface-border">
                <a href="{{ route('admin.blocks.edit', $block) }}" 
                   class="w-full h-10 bg-primary hover:bg-primary/90 text-white rounded-lg font-semibold transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">edit</span>
                    Edit Blok
                </a>
            </div>
        </div>

        <!-- Recent Harvests -->
        <div class="lg:col-span-2 bg-white p-6 rounded-xl border border-surface-border shadow-sm">
            <h2 class="text-lg font-bold text-text-main mb-4">Panen Terbaru</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm min-w-[400px]">
                    <thead class="bg-surface-light border-b border-surface-border">
                        <tr>
                            <th class="px-4 py-2 font-semibold text-text-secondary text-xs">Tanggal</th>
                            <th class="px-4 py-2 font-semibold text-text-secondary text-xs">Petugas</th>
                            <th class="px-4 py-2 font-semibold text-text-secondary text-xs">Berat</th>
                            <th class="px-4 py-2 font-semibold text-text-secondary text-xs">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-border">
                        @forelse($block->harvests as $harvest)
                            <tr>
                                <td class="px-4 py-2">{{ $harvest->harvest_date->format('d M Y') }}</td>
                                <td class="px-4 py-2">{{ $harvest->officer->name }}</td>
                                <td class="px-4 py-2 font-semibold">{{ number_format($harvest->weight_kg) }} Kg</td>
                                <td class="px-4 py-2">
                                    @if($harvest->isVerified())
                                        <span class="text-green-600 text-xs">✓ Verified</span>
                                    @elseif($harvest->isPending())
                                        <span class="text-yellow-600 text-xs">Pending</span>
                                    @else
                                        <span class="text-red-600 text-xs">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-text-secondary">Belum ada data panen.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
