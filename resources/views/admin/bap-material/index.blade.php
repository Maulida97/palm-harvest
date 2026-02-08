@extends('layouts.palm')

@section('title', 'BAP Material')

@php $pageTitle = 'BAP Material'; @endphp

@section('content')
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-text-main">BAP Material</h2>
            <p class="text-text-secondary text-sm">Daftar pemeriksaan material</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.bap-material.create') }}" 
               class="flex items-center gap-2 h-10 px-4 bg-primary hover:bg-primary/90 text-white rounded-lg text-sm font-semibold transition-colors">
                <span class="material-symbols-outlined text-[18px]">add</span>
                + Input BAP Material
            </a>
            <button type="button" onclick="document.getElementById('filterPanel').classList.toggle('hidden')"
                    class="flex items-center gap-2 h-10 px-4 border border-surface-border bg-white hover:bg-surface-light rounded-lg text-sm font-medium text-text-main transition-colors">
                <span class="material-symbols-outlined text-[18px]">filter_list</span>
                Filter
            </button>
        </div>
    </div>

    <!-- Filter Panel -->
    <div id="filterPanel" class="hidden bg-white p-4 rounded-xl border border-surface-border shadow-sm mb-4">
        <form method="GET" class="flex flex-wrap gap-4 items-end">
            <div>
                <label class="block text-xs font-medium text-text-secondary mb-1">Jenis Material</label>
                <input type="text" name="jenis_material" value="{{ request('jenis_material') }}" 
                       placeholder="Cari material..."
                       class="h-10 px-3 rounded-lg border border-surface-border text-sm min-w-[180px]">
            </div>
            <div>
                <label class="block text-xs font-medium text-text-secondary mb-1">Dari</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="h-10 px-3 rounded-lg border border-surface-border text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-text-secondary mb-1">Sampai</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" class="h-10 px-3 rounded-lg border border-surface-border text-sm">
            </div>
            <button type="submit" class="h-10 px-4 bg-primary text-white rounded-lg text-sm font-semibold">Terapkan</button>
            <a href="{{ route('admin.bap-material.index') }}" class="h-10 px-4 border border-surface-border rounded-lg text-sm font-medium flex items-center">Reset</a>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-700 px-4 py-3 rounded-lg mb-4">{{ session('success') }}</div>
    @endif

    <!-- Data Table -->
    <div class="bg-white border border-surface-border rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
        <table class="w-full text-left text-sm min-w-[800px]">
            <thead class="bg-[#edf3e7] border-b border-surface-border">
                <tr>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Tanggal</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">QC Name</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Jenis Material</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Dimensi (P×L×T)</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Foto</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-border">
                @forelse($materials as $material)
                    <tr class="hover:bg-[#fafcf8] transition-colors">
                        <td class="px-4 py-3 text-text-main">{{ $material->inspection_date->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-text-main font-medium">{{ $material->qc_name }}</td>
                        <td class="px-4 py-3 text-text-main">{{ $material->jenis_material }}</td>
                        <td class="px-4 py-3 text-text-secondary">
                            {{ $material->panjang ?? '-' }} × {{ $material->lebar ?? '-' }} × {{ $material->tinggi ?? '-' }} cm
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700" title="Dokumentasi">
                                    <span class="material-symbols-outlined text-[12px]">photo_camera</span>
                                    {{ $material->dokumentasiPhotos->count() }}
                                </span>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-700" title="Surat Jalan">
                                    <span class="material-symbols-outlined text-[12px]">description</span>
                                    {{ $material->suratJalanPhotos->count() }}
                                </span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('admin.bap-material.show', $material) }}" 
                                   class="p-1.5 text-text-secondary hover:text-primary transition-colors" title="Preview">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                                <a href="{{ route('admin.bap-material.edit', $material) }}" 
                                   class="p-1.5 text-text-secondary hover:text-blue-500 transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('admin.bap-material.destroy', $material) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-text-secondary hover:text-red-500 transition-colors" title="Hapus">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-text-secondary">Belum ada data BAP Material.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">{{ $materials->links() }}</div>
@endsection
