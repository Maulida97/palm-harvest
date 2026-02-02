@extends('layouts.palm')

@section('title', 'Detail Petugas')

@php $pageTitle = 'Detail Petugas'; @endphp

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.officers.index') }}" class="text-primary hover:underline text-sm flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">arrow_back</span>
            Kembali ke Daftar Petugas
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
            <div class="flex flex-col items-center text-center mb-6">
                <div class="w-20 h-20 rounded-full bg-primary/20 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-primary text-4xl">person</span>
                </div>
                <h2 class="text-lg font-bold text-text-main">{{ $officer->name }}</h2>
                <p class="text-text-secondary text-sm">{{ $officer->email }}</p>
            </div>
            <dl class="space-y-3">
                <div><dt class="text-xs text-text-secondary">Telepon</dt><dd class="text-text-main">{{ $officer->phone ?? '-' }}</dd></div>
                <div><dt class="text-xs text-text-secondary">Bergabung</dt><dd class="text-text-main">{{ $officer->created_at->format('d M Y') }}</dd></div>
            </dl>
            <div class="mt-6 pt-4 border-t border-surface-border">
                <a href="{{ route('admin.officers.edit', $officer) }}" class="w-full h-10 bg-primary hover:bg-primary/90 text-white rounded-lg font-semibold transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">edit</span>
                    Edit Petugas
                </a>
            </div>
        </div>

        <div class="lg:col-span-2 bg-white p-6 rounded-xl border border-surface-border shadow-sm">
            <h2 class="text-lg font-bold text-text-main mb-4">Riwayat Panen Terbaru</h2>
            <div class="overflow-x-auto">
            <table class="w-full text-left text-sm min-w-[500px]">
                <thead class="bg-surface-light border-b border-surface-border">
                    <tr>
                        <th class="px-4 py-2 font-semibold text-text-secondary text-xs">Tanggal</th>
                        <th class="px-4 py-2 font-semibold text-text-secondary text-xs">Blok</th>
                        <th class="px-4 py-2 font-semibold text-text-secondary text-xs">Berat</th>
                        <th class="px-4 py-2 font-semibold text-text-secondary text-xs">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($officer->harvests as $harvest)
                        <tr>
                            <td class="px-4 py-2">{{ $harvest->harvest_date->format('d M Y') }}</td>
                            <td class="px-4 py-2">{{ $harvest->block->code }}</td>
                            <td class="px-4 py-2 font-semibold">{{ number_format($harvest->weight_kg) }} Kg</td>
                            <td class="px-4 py-2">
                                @if($harvest->isVerified())<span class="text-green-600 text-xs">✓ Verified</span>
                                @elseif($harvest->isPending())<span class="text-yellow-600 text-xs">Pending</span>
                                @else<span class="text-red-600 text-xs">Ditolak</span>@endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-4 py-8 text-center text-text-secondary">Belum ada data panen.</td></tr>
                    @endforelse
                </tbody>
            </table>
            </div>
        </div>
    </div>
@endsection
