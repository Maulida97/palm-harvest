@extends('layouts.palm')

@section('title', 'Internal Memo ' . ucfirst($type))

@php $pageTitle = 'Data Internal Memo ' . ucfirst($type); @endphp

@section('content')
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-xl font-bold text-text-main">Data Internal Memo</h2>
            <p class="text-text-secondary text-sm">Daftar internal memo {{ ucfirst($type) }}</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.memo.create', $type) }}" 
               class="flex items-center gap-2 h-10 px-4 bg-primary hover:bg-primary/90 text-white rounded-lg text-sm font-semibold transition-colors">
                <span class="material-symbols-outlined text-[18px]">add</span>
                + Input Memo
            </a>
            <button type="button" onclick="document.getElementById('filterPanel').classList.toggle('hidden')"
                    class="flex items-center gap-2 h-10 px-4 border border-surface-border bg-white hover:bg-surface-light rounded-lg text-sm font-medium text-text-main transition-colors">
                <span class="material-symbols-outlined text-[18px]">filter_list</span>
                Filter Data
            </button>
        </div>
    </div>

    <!-- Filter Panel (Hidden by default) -->
    <div id="filterPanel" class="hidden bg-white p-4 rounded-xl border border-surface-border shadow-sm">
        <form method="GET" class="flex flex-wrap gap-4 items-end">
            <div>
                <label class="block text-xs font-medium text-text-secondary mb-1">Status</label>
                <select name="status" class="h-10 px-3 rounded-lg border border-surface-border text-sm min-w-[120px]">
                    <option value="">Semua</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Tidak Aktif</option>
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
            <a href="{{ route('admin.memo.index', $type) }}" class="h-10 px-4 border border-surface-border rounded-lg text-sm font-medium flex items-center">Reset</a>
        </form>
    </div>

    <!-- Data Table -->
    <div class="bg-white border border-surface-border rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
        <table class="w-full text-left text-sm min-w-[700px]">
            <thead class="bg-[#edf3e7] border-b border-surface-border">
                <tr>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">No Item</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Berlaku</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Tidak Berlaku</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Tanggal Revisi</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-border">
                @forelse($memos as $memo)
                    <tr class="hover:bg-[#fafcf8] transition-colors">
                        <td class="px-4 py-3 text-text-main font-medium">{{ $memo->no_item }}</td>
                        <td class="px-4 py-3 text-text-main">{{ $memo->berlaku->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-text-main">{{ $memo->tidak_berlaku ? $memo->tidak_berlaku->format('d/m/Y') : '-' }}</td>
                        <td class="px-4 py-3 text-text-main">{{ $memo->tanggal_revisi ? $memo->tanggal_revisi->format('d/m/Y') : '-' }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <!-- Preview Button -->
                                <a href="{{ route('admin.memo.show', [$type, $memo]) }}" 
                                   class="p-1.5 text-text-secondary hover:text-primary transition-colors" title="Preview">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                                <!-- Delete Button -->
                                <form action="{{ route('admin.memo.destroy', [$type, $memo]) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus memo ini?')" class="inline">
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
                        <td colspan="5" class="px-4 py-8 text-center text-text-secondary">Belum ada data internal memo {{ ucfirst($type) }}.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">{{ $memos->appends(request()->query())->links() }}</div>
@endsection
