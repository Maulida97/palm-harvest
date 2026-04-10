@extends('layouts.palm')

@section('title', 'Spotchek Pemupukan')

@php $pageTitle = 'Spotchek Pemupukan'; @endphp

@section('content')
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-xl font-bold text-text-main">Spotchek Pemupukan</h2>
            <p class="text-text-secondary text-sm">Daftar inspeksi dan temuan pemupukan</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.fertilizer-spotchecks.create') }}" 
               class="flex items-center gap-2 h-10 px-4 bg-primary hover:bg-primary/90 text-white rounded-lg text-sm font-semibold transition-colors">
                <span class="material-symbols-outlined text-[18px]">add</span>
                Input Spotchek
            </a>
            <button type="button" onclick="document.getElementById('filterPanel').classList.toggle('hidden')"
                    class="flex items-center gap-2 h-10 px-4 border border-surface-border bg-white hover:bg-surface-light rounded-lg text-sm font-medium text-text-main transition-colors">
                <span class="material-symbols-outlined text-[18px]">filter_list</span>
                Filter Data
            </button>
        </div>
    </div>

    <!-- Filter Panel -->
    <div id="filterPanel" class="hidden bg-white p-4 rounded-xl border border-surface-border shadow-sm">
        <form method="GET" class="flex flex-wrap gap-4 items-end">
            <div>
                <label class="block text-xs font-medium text-text-secondary mb-1">Divisi</label>
                <select name="division_id" id="filter_division_id" class="h-10 px-3 rounded-lg border border-surface-border text-sm min-w-[140px]">
                    <option value="">Semua Divisi</option>
                    @foreach($divisions as $division)
                        <option value="{{ $division->id }}" 
                                data-blocks='@json($division->blocks)'
                                {{ request('division_id') == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-text-secondary mb-1">Blok</label>
                <select name="block_id" id="filter_block_id" class="h-10 px-3 rounded-lg border border-surface-border text-sm min-w-[140px]">
                    <option value="">Semua Blok</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-text-secondary mb-1">Dari Tanggal</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="h-10 px-3 rounded-lg border border-surface-border text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-text-secondary mb-1">Sampai Tanggal</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" class="h-10 px-3 rounded-lg border border-surface-border text-sm">
            </div>
            <button type="submit" class="h-10 px-4 bg-primary text-white rounded-lg text-sm font-semibold">Terapkan</button>
            <a href="{{ route('admin.fertilizer-spotchecks.index') }}" class="h-10 px-4 border border-surface-border rounded-lg text-sm font-medium flex items-center">Reset</a>
        </form>
    </div>

    <!-- Data Table -->
    <div class="bg-white border border-surface-border rounded-xl overflow-hidden shadow-sm mt-4">
        <div class="overflow-x-auto">
        <table class="w-full text-left text-sm min-w-[1000px]">
            <thead class="bg-[#edf3e7] border-b border-surface-border">
                <tr>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Tanggal</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Lokasi</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Pekerja</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Pupuk</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Temuan (Kg)</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Denda (Rp)</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Status</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-border">
                @forelse($spotchecks as $item)
                    <tr class="hover:bg-[#fafcf8] transition-colors">
                        <td class="px-4 py-3 text-text-main">{{ $item->inspection_date->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">
                            <span class="font-medium text-text-main">{{ $item->division->name ?? '-' }}</span>
                            <span class="inline-flex items-center ml-2 px-2 py-0.5 rounded-full text-[10px] font-medium bg-[#edf3e7] text-text-main">
                                Blok {{ $item->block->code ?? '-' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-text-main">{{ $item->worker_name ?: '-' }}</td>
                        <td class="px-4 py-3 text-text-main">{{ $item->fertilizer->name ?? '-' }}</td>
                        <td class="px-4 py-3">
                            @if($item->unapplied_kg > 0)
                                <span class="text-red-600 font-semibold">{{ $item->unapplied_kg }} Kg</span>
                            @else
                                <span class="text-green-600">0 Kg</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-text-main font-semibold">
                            Rp {{ number_format($item->penalty_amount, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3">
                            @if($item->status == 'completed')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-[#e1f5d6] text-[#0c4e16]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                                    Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                                    Pending
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('admin.fertilizer-spotchecks.show', $item) }}" 
                                   class="p-1.5 text-text-secondary hover:text-primary transition-colors" title="Detail">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                                <a href="{{ route('admin.fertilizer-spotchecks.edit', $item) }}" 
                                   class="p-1.5 text-text-secondary hover:text-blue-500 transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('admin.fertilizer-spotchecks.destroy', $item) }}" method="POST" 
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
                        <td colspan="8" class="px-4 py-8 text-center text-text-secondary">Belum ada data Spotchek Pemupukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">{{ $spotchecks->appends(request()->query())->links() }}</div>

    <!-- Filter Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const divisionSelect = document.getElementById('filter_division_id');
        const blockSelect = document.getElementById('filter_block_id');
        const currentBlockId = '{{ request('block_id') }}';
        
        function updateFilterBlocks() {
            const selectedOption = divisionSelect.options[divisionSelect.selectedIndex];
            const blocks = selectedOption.dataset.blocks ? JSON.parse(selectedOption.dataset.blocks) : [];
            
            blockSelect.innerHTML = '<option value="">Semua Blok</option>';
            blocks.forEach(block => {
                const option = document.createElement('option');
                option.value = block.id;
                option.textContent = block.code;
                if (block.id == currentBlockId) option.selected = true;
                blockSelect.appendChild(option);
            });
        }
        
        divisionSelect.addEventListener('change', updateFilterBlocks);
        updateFilterBlocks();
    });
    </script>
@endsection
