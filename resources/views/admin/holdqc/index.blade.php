@extends('layouts.palm')

@section('title', 'Hold QC')

@php $pageTitle = 'HOLD QC'; @endphp

@section('content')
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-xl font-bold text-text-main">HOLD QC</h2>
            <p class="text-text-secondary text-sm">Daftar pekerjaan yang ditahan</p>
        </div>
        <div class="flex gap-3">
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
                <label class="block text-xs font-medium text-text-secondary mb-1">Blok</label>
                <select name="block_id" class="h-10 px-3 rounded-lg border border-surface-border text-sm min-w-[150px]">
                    <option value="">Semua Blok</option>
                    @foreach($blocks as $block)
                        <option value="{{ $block->id }}" {{ request('block_id') == $block->id ? 'selected' : '' }}>{{ $block->code }}</option>
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
            <a href="{{ route('admin.holdqc.index') }}" class="h-10 px-4 border border-surface-border rounded-lg text-sm font-medium flex items-center">Reset</a>
        </form>
    </div>

    <!-- Data Table -->
    <div class="bg-white border border-surface-border rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
        <table class="w-full text-left text-sm min-w-[900px]">
            <thead class="bg-[#edf3e7] border-b border-surface-border">
                <tr>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Divisi</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Block</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Luas</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">No. SPK</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Total</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Tanggal Terakhir</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Status</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Aksi</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Keterangan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-border">
                @forelse($harvests as $harvest)
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
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                                Hold
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-1">
                                <!-- Preview Button -->
                                <a href="{{ route('admin.bap.show', $harvest) }}" 
                                   class="p-1.5 text-text-secondary hover:text-primary rounded transition-colors" title="Preview">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                                <!-- Edit Button -->
                                <a href="{{ route('admin.bap.edit', $harvest) }}" 
                                   class="p-1.5 text-text-secondary hover:text-blue-500 rounded transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <!-- Approve Button -->
                                <form action="{{ route('admin.holdqc.approve', $harvest) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="p-1.5 text-green-600 hover:bg-green-50 rounded transition-colors" title="Setujui">
                                        <span class="material-symbols-outlined text-[20px]">check_circle</span>
                                    </button>
                                </form>
                                <!-- Reject Button -->
                                <form action="{{ route('admin.holdqc.reject', $harvest) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded transition-colors" title="Tolak">
                                        <span class="material-symbols-outlined text-[20px]">cancel</span>
                                    </button>
                                </form>
                                <!-- Delete Button -->
                                <form action="{{ route('admin.holdqc.destroy', $harvest) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-text-secondary hover:text-red-500 rounded transition-colors" title="Hapus">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-text-secondary text-xs max-w-[150px] truncate" title="{{ $harvest->notes }}">
                            {{ $harvest->notes ?? '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-4 py-8 text-center text-text-secondary">Tidak ada data yang ditahan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">{{ $harvests->appends(request()->query())->links() }}</div>
@endsection
