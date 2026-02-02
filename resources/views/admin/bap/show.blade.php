@extends('layouts.palm')

@section('title', 'Preview Data QC')

@php $pageTitle = 'Preview Data QC'; @endphp

@section('content')
    <div class="max-w-4xl">
        <div class="mb-6">
            <a href="{{ route('admin.bap.index') }}" class="text-primary hover:underline text-sm flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                Kembali ke Data QC
            </a>
        </div>

        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-text-main">Preview Data QC #{{ $bap->id }}</h2>
                <a href="{{ route('admin.bap.edit', $bap) }}" 
                   class="h-9 px-4 bg-primary hover:bg-primary/90 text-white rounded-lg font-semibold transition-colors flex items-center gap-2 text-sm">
                    <span class="material-symbols-outlined text-[16px]">edit</span>
                    Edit
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-4">
                    <!-- Row 1: Divisi & Block -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-text-main mb-1">Divisi</label>
                            <div class="w-full h-10 px-3 rounded-lg border border-surface-border bg-[#edf3e7] flex items-center text-sm">
                                {{ $bap->block->name ?? '-' }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-text-main mb-1">Block</label>
                            <div class="w-full h-10 px-3 rounded-lg border border-surface-border bg-[#edf3e7] flex items-center text-sm font-medium">
                                {{ $bap->block->code }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Row 2: Tanggal Selesai & Luas -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-text-main mb-1">Tanggal Selesai</label>
                            <div class="w-full h-10 px-3 rounded-lg border border-surface-border bg-[#edf3e7] flex items-center text-sm">
                                {{ $bap->harvest_date->format('d/m/Y') }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-text-main mb-1">Luas (Ha)</label>
                            <div class="w-full h-10 px-3 rounded-lg border border-surface-border bg-[#edf3e7] flex items-center text-sm">
                                {{ $bap->block->area_hectares ?? '-' }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Row 3: Status & Keterangan -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-text-main mb-1">Status</label>
                            <div class="flex gap-2">
                                @if($bap->isVerified())
                                    <span class="flex items-center gap-2 px-3 py-2 rounded-lg border border-primary bg-[#e1f5d6]">
                                        <span class="w-2 h-2 rounded-full bg-primary"></span>
                                        <span class="text-sm font-medium text-primary">OK</span>
                                    </span>
                                @elseif($bap->isPending())
                                    <span class="flex items-center gap-2 px-3 py-2 rounded-lg border border-yellow-500 bg-yellow-50">
                                        <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                                        <span class="text-sm font-medium text-yellow-700">Hold</span>
                                    </span>
                                @else
                                    <span class="flex items-center gap-2 px-3 py-2 rounded-lg border border-red-500 bg-red-50">
                                        <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                        <span class="text-sm font-medium text-red-700">Reject</span>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-text-main mb-1">Keterangan</label>
                            <div class="w-full min-h-[80px] px-3 py-2 rounded-lg border border-surface-border bg-[#edf3e7] text-sm break-words overflow-hidden" style="word-wrap: break-word; overflow-wrap: break-word;">
                                {{ $bap->notes ?? '-' }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Row 4: No. SPK & Total -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-text-main mb-1">No. SPK</label>
                            <div class="w-full h-10 px-3 rounded-lg border border-surface-border bg-[#edf3e7] flex items-center text-sm">
                                {{ $bap->no_spk ?? '-' }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-text-main mb-1">Total (Kg)</label>
                            <div class="w-full h-10 px-3 rounded-lg border border-surface-border bg-[#e1f5d6] flex items-center text-sm font-bold text-primary">
                                {{ number_format($bap->weight_kg, 2) }} Kg
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column -->
                <div class="space-y-4">
                    <!-- Row 1: Tanggal Terakhir & Tanggal Mulai -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-text-main mb-1">Tanggal Terakhir</label>
                            <div class="w-full h-10 px-3 rounded-lg border border-surface-border bg-[#edf3e7] flex items-center text-sm">
                                {{ $bap->harvest_date->format('d/m/Y') }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-text-main mb-1">Tanggal Mulai</label>
                            <div class="w-full h-10 px-3 rounded-lg border border-surface-border bg-[#edf3e7] flex items-center text-sm">
                                {{ $bap->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Gambar -->
                    <div>
                        <label class="block text-sm font-medium text-text-main mb-1">Gambar</label>
                        @if($bap->image)
                            <div class="border-2 border-surface-border rounded-lg bg-[#edf3e7] p-2 overflow-hidden">
                                <img src="{{ asset('storage/' . $bap->image) }}" alt="Gambar QC" class="w-full h-[180px] object-cover rounded-lg">
                            </div>
                        @else
                            <div class="border-2 border-dashed border-surface-border rounded-lg bg-[#edf3e7] p-4 h-[180px] flex flex-col items-center justify-center">
                                <span class="material-symbols-outlined text-text-secondary text-4xl mb-2">image</span>
                                <p class="text-text-secondary text-sm">Tidak ada gambar</p>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Info Tambahan -->
                    <div class="p-4 bg-surface-light rounded-lg border border-surface-border">
                        <h3 class="text-sm font-semibold text-text-main mb-3">Informasi Tambahan</h3>
                        <dl class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <dt class="text-text-secondary">ID Data</dt>
                                <dd class="font-medium">#{{ $bap->id }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-text-secondary">Dibuat</dt>
                                <dd class="font-medium">{{ $bap->created_at->format('d M Y, H:i') }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-text-secondary">Petugas</dt>
                                <dd class="font-medium">{{ $bap->officer->name ?? '-' }}</dd>
                            </div>
                            @if($bap->verifier)
                            <div class="flex justify-between">
                                <dt class="text-text-secondary">Diverifikasi</dt>
                                <dd class="font-medium">{{ $bap->verifier->name }}</dd>
                            </div>
                            @endif
                        </dl>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="mt-8 pt-6 border-t border-surface-border flex gap-3">
                <a href="{{ route('admin.bap.edit', $bap) }}" 
                   class="h-10 px-6 bg-primary hover:bg-primary/90 text-white rounded-lg font-semibold transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">edit</span>
                    Edit Data
                </a>
                <a href="{{ route('admin.bap.index') }}" 
                   class="h-10 px-6 border border-surface-border rounded-lg font-semibold text-text-main hover:bg-surface-light transition-colors flex items-center justify-center">
                    Kembali
                </a>
                <form action="{{ route('admin.bap.destroy', $bap) }}" method="POST" 
                      onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="h-10 px-6 bg-red-500 hover:bg-red-600 text-white rounded-lg font-semibold transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">delete</span>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
