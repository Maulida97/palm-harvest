@extends('layouts.palm')

@section('title', 'Kebersihan Ancak Panen & TPH')

@php $pageTitle = 'Kebersihan Ancak Panen & TPH'; @endphp

@section('content')
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-text-main">Kebersihan Ancak Panen & TPH</h2>
            <p class="text-text-secondary text-sm">Daftar hasil inspeksi kebersihan ancak</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.ancak.create') }}" 
               class="flex items-center gap-2 h-10 px-4 bg-primary hover:bg-primary/90 text-white rounded-lg text-sm font-semibold transition-colors">
                <span class="material-symbols-outlined text-[18px]">add</span>
                + Input Inspeksi
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
                <label class="block text-xs font-medium text-text-secondary mb-1">Divisi</label>
                <select name="division_id" class="h-10 px-3 rounded-lg border border-surface-border text-sm min-w-[140px]">
                    <option value="">Semua Divisi</option>
                    @foreach($divisions as $division)
                        <option value="{{ $division->id }}" {{ request('division_id') == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                    @endforeach
                </select>
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
            <a href="{{ route('admin.ancak.index') }}" class="h-10 px-4 border border-surface-border rounded-lg text-sm font-medium flex items-center">Reset</a>
        </form>
    </div>

    <!-- Data Table -->
    <div class="bg-white border border-surface-border rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
        <table class="w-full text-left text-sm min-w-[800px]">
            <thead class="bg-[#edf3e7] border-b border-surface-border">
                <tr>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Tanggal</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">QC Name</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Divisi</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Blok</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Mandor</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-border">
                @forelse($inspections as $inspection)
                    <tr class="hover:bg-[#fafcf8] transition-colors">
                        <td class="px-4 py-3 text-text-main">{{ $inspection->inspection_date->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-text-main font-medium">{{ $inspection->qc_name }}</td>
                        <td class="px-4 py-3 text-text-main">{{ $inspection->division->name ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#edf3e7] text-text-main">
                                {{ $inspection->block->code ?? '-' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-text-secondary">{{ $inspection->foreman_name ?? '-' }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('admin.ancak.show', $inspection) }}" 
                                   class="p-1.5 text-text-secondary hover:text-primary transition-colors" title="Preview">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                                <a href="{{ route('admin.ancak.edit', $inspection) }}" 
                                   class="p-1.5 text-text-secondary hover:text-blue-500 transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('admin.ancak.destroy', $inspection) }}" method="POST" 
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
                        <td colspan="6" class="px-4 py-8 text-center text-text-secondary">Belum ada data inspeksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">{{ $inspections->links() }}</div>
@endsection
