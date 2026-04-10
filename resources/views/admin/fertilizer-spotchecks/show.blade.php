@extends('layouts.palm')

@section('title', 'Detail Spotchek Pemupukan')

@php $pageTitle = 'Detail Spotchek Pemupukan'; @endphp

@section('content')
    <div class="max-w-4xl">
        <div class="mb-6">
            <a href="{{ route('admin.fertilizer-spotchecks.index') }}" class="text-primary hover:underline text-sm flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                Kembali ke Daftar Spotchek
            </a>
        </div>

        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-text-main">Detail Spotchek Pemupukan #{{ $fertilizer_spotcheck->id }}</h2>
                <a href="{{ route('admin.fertilizer-spotchecks.edit', $fertilizer_spotcheck) }}" 
                   class="h-9 px-4 bg-primary hover:bg-primary/90 text-white rounded-lg font-semibold transition-colors flex items-center gap-2 text-sm">
                    <span class="material-symbols-outlined text-[16px]">edit</span>
                    Edit
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri -->
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-text-main mb-1">Divisi</label>
                            <div class="w-full h-10 px-3 rounded-lg border border-surface-border bg-[#edf3e7] flex items-center text-sm">
                                {{ $fertilizer_spotcheck->division->name ?? '-' }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-text-main mb-1">Block</label>
                            <div class="w-full h-10 px-3 rounded-lg border border-surface-border bg-[#edf3e7] flex items-center text-sm font-bold">
                                {{ $fertilizer_spotcheck->block->code ?? '-' }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-text-main mb-1">Tanggal Inspeksi</label>
                            <div class="w-full h-10 px-3 rounded-lg border border-surface-border bg-[#edf3e7] flex items-center text-sm">
                                {{ $fertilizer_spotcheck->inspection_date->format('d M Y') }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-text-main mb-1">Pekerja</label>
                            <div class="w-full h-10 px-3 rounded-lg border border-surface-border bg-[#edf3e7] flex items-center text-sm">
                                {{ $fertilizer_spotcheck->worker_name ?: '-' }}
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-text-main mb-1">Status</label>
                        <div>
                            @if($fertilizer_spotcheck->status == 'completed')
                                <span class="inline-flex items-center gap-2 px-3 py-2 rounded-lg border border-primary bg-[#e1f5d6] text-primary">
                                    <span class="w-2 h-2 rounded-full bg-primary"></span>
                                    <span class="text-sm font-medium">Selesai (Completed)</span>
                                </span>
                            @else
                                <span class="inline-flex items-center gap-2 px-3 py-2 rounded-lg border border-yellow-500 bg-yellow-50 text-yellow-700">
                                    <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                                    <span class="text-sm font-medium">Tertunda (Pending)</span>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-text-main mb-1">Keterangan / Temuan QC</label>
                        <div class="w-full min-h-[80px] px-3 py-2 rounded-lg border border-surface-border bg-[#edf3e7] text-sm break-words">
                            {{ $fertilizer_spotcheck->findings ?: '-' }}
                        </div>
                    </div>
                </div>
                
                <!-- Kolom Kanan -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-text-main mb-1">Jenis Pupuk dipakai</label>
                        <div class="w-full h-10 px-3 rounded-lg border border-surface-border bg-[#edf3e7] flex flex-col justify-center text-sm">
                            <span class="font-bold">{{ $fertilizer_spotcheck->fertilizer->name ?? '-' }}</span>
                            <span class="text-xs text-text-secondary">Rp {{ number_format($fertilizer_spotcheck->fertilizer->price_per_kg ?? 0, 0, ',', '.') }} / Kg</span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-text-main mb-1">Temuan (Kg)</label>
                            <div class="w-full h-10 px-3 rounded-lg border border-red-200 bg-red-50 flex items-center text-sm font-bold text-red-600">
                                {{ $fertilizer_spotcheck->unapplied_kg }} Kg
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-text-main mb-1">Total Denda (Rp)</label>
                            <div class="w-full h-10 px-3 rounded-lg border border-red-200 bg-red-50 flex items-center text-sm font-bold text-red-600">
                                Rp {{ number_format($fertilizer_spotcheck->penalty_amount, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-text-main mb-1">Foto Bukti Lapangan</label>
                        @if($fertilizer_spotcheck->evidence_path)
                            <div class="border-2 border-surface-border rounded-lg overflow-hidden bg-[#edf3e7] p-2">
                                <a href="{{ asset('storage/' . $fertilizer_spotcheck->evidence_path) }}" target="_blank" title="Klik untuk memperbesar">
                                    <img src="{{ asset('storage/' . $fertilizer_spotcheck->evidence_path) }}" alt="Bukti Spotchek" class="w-full h-48 object-cover rounded-lg hover:opacity-90 transition-opacity">
                                </a>
                                <p class="text-xs text-center text-text-secondary mt-2">Klik gambar untuk memperbesar</p>
                            </div>
                        @else
                            <div class="border-2 border-dashed border-surface-border rounded-lg bg-[#edf3e7] h-48 flex flex-col items-center justify-center p-4">
                                <span class="material-symbols-outlined text-text-secondary text-[40px] mb-2">image_not_supported</span>
                                <p class="text-sm text-text-secondary">Tidak ada foto bukti</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="p-4 mt-6 bg-surface-light rounded-lg border border-surface-border text-sm text-text-secondary">
                <div class="flex gap-4">
                    <span><strong>NAMA QC:</strong> {{ $fertilizer_spotcheck->qc_name }}</span>
                    <span><strong>DIBUAT PADA:</strong> {{ $fertilizer_spotcheck->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
