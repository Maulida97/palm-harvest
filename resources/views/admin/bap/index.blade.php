@extends('layouts.palm')

@section('title', 'Input BAP')

@php $pageTitle = 'Data QC'; @endphp

@section('content')
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-xl font-bold text-text-main">Data QC</h2>
            <p class="text-text-secondary text-sm">Daftar hasil QC sektor</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.bap.create') }}" 
               class="flex items-center gap-2 h-10 px-4 bg-primary hover:bg-primary/90 text-white rounded-lg text-sm font-semibold transition-colors">
                <span class="material-symbols-outlined text-[18px]">add</span>
                + Input QC
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
                <label class="block text-xs font-medium text-text-secondary mb-1">Status</label>
                <select name="status" class="h-10 px-3 rounded-lg border border-surface-border text-sm min-w-[120px]">
                    <option value="">Semua</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Hold</option>
                    <option value="verified" {{ request('status') === 'verified' ? 'selected' : '' }}>OK</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Reject</option>
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
            <a href="{{ route('admin.bap.index') }}" class="h-10 px-4 border border-surface-border rounded-lg text-sm font-medium flex items-center">Reset</a>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const divisionSelect = document.getElementById('filter_division_id');
        const blockSelect = document.getElementById('filter_block_id');
        const currentBlockId = '{{ request('block_id') }}';
        
        function updateFilterBlocks() {
            const selectedOption = divisionSelect.options[divisionSelect.selectedIndex];
            const blocks = selectedOption.dataset.blocks ? JSON.parse(selectedOption.dataset.blocks) : [];
            
            // Clear block options except first
            blockSelect.innerHTML = '<option value="">Semua Blok</option>';
            
            // Add blocks for selected division
            blocks.forEach(block => {
                const option = document.createElement('option');
                option.value = block.id;
                option.textContent = block.code;
                if (block.id == currentBlockId) option.selected = true;
                blockSelect.appendChild(option);
            });
        }
        
        divisionSelect.addEventListener('change', function() {
            updateFilterBlocks();
        });
        
        // Initialize on page load
        updateFilterBlocks();
    });
    </script>

    <!-- Data Table -->
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
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs text-right">Aksi</th>
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
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <!-- Preview Button -->
                                <a href="{{ route('admin.bap.show', $harvest) }}" 
                                   class="p-1.5 text-text-secondary hover:text-primary transition-colors" title="Preview">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                                <!-- Edit Button -->
                                <a href="{{ route('admin.bap.edit', $harvest) }}" 
                                   class="p-1.5 text-text-secondary hover:text-blue-500 transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <!-- Delete Button -->
                                <form action="{{ route('admin.bap.destroy', $harvest) }}" method="POST" 
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
                        <td colspan="8" class="px-4 py-8 text-center text-text-secondary">Belum ada data QC.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">{{ $harvests->appends(request()->query())->links() }}</div>
@endsection
