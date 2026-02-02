@extends('layouts.palm')

@section('title', 'Data Panen')

@php $pageTitle = 'Data Panen'; @endphp

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-xl font-bold text-text-main">Data Panen</h2>
            <p class="text-text-secondary text-sm">Lihat dan verifikasi data panen dari petugas</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white p-4 rounded-xl border border-surface-border shadow-sm">
        <form method="GET" class="flex flex-wrap gap-4 items-end">
            <div>
                <label class="block text-xs font-medium text-text-secondary mb-1">Status</label>
                <select name="status" class="h-10 px-3 rounded-lg border border-surface-border text-sm min-w-[120px]">
                    <option value="">Semua</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="verified" {{ request('status') === 'verified' ? 'selected' : '' }}>Verified</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
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
            <button type="submit" class="h-10 px-4 bg-primary text-white rounded-lg text-sm font-semibold">Filter</button>
            <a href="{{ route('admin.harvests.index') }}" class="h-10 px-4 border border-surface-border rounded-lg text-sm font-medium flex items-center">Reset</a>
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-hidden rounded-xl border border-surface-border bg-white shadow-sm">
        <div class="overflow-x-auto">
        <table class="w-full text-left text-sm min-w-[700px]">
            <thead class="bg-surface-light border-b border-surface-border">
                <tr>
                    <th class="px-6 py-3 font-semibold text-text-secondary uppercase text-xs">Tanggal</th>
                    <th class="px-6 py-3 font-semibold text-text-secondary uppercase text-xs">Blok</th>
                    <th class="px-6 py-3 font-semibold text-text-secondary uppercase text-xs">Berat (Kg)</th>
                    <th class="px-6 py-3 font-semibold text-text-secondary uppercase text-xs">Petugas</th>
                    <th class="px-6 py-3 font-semibold text-text-secondary uppercase text-xs">Status</th>
                    <th class="px-6 py-3 font-semibold text-text-secondary uppercase text-xs text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-border">
                @forelse($harvests as $harvest)
                    <tr class="hover:bg-[#fafcf8]">
                        <td class="px-6 py-4">{{ $harvest->harvest_date->format('d M, Y') }}</td>
                        <td class="px-6 py-4"><span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#edf3e7]">{{ $harvest->block->code }}</span></td>
                        <td class="px-6 py-4 font-semibold">{{ number_format($harvest->weight_kg) }} Kg</td>
                        <td class="px-6 py-4">{{ $harvest->officer->name }}</td>
                        <td class="px-6 py-4">
                            @if($harvest->isVerified())<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-[#e1f5d6] text-[#0c4e16]"><span class="w-1.5 h-1.5 rounded-full bg-[#66bd0f]"></span>Verified</span>
                            @elseif($harvest->isPending())<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700"><span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>Pending</span>
                            @else<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700"><span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>Rejected</span>@endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-1">
                                @if($harvest->isPending())
                                    <form action="{{ route('admin.harvests.verify', $harvest) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="action" value="verify">
                                        <button type="submit" class="p-1.5 text-green-600 hover:bg-green-50 rounded" title="Verifikasi">
                                            <span class="material-symbols-outlined text-[20px]">check_circle</span>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.harvests.verify', $harvest) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="action" value="reject">
                                        <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded" title="Tolak">
                                            <span class="material-symbols-outlined text-[20px]">cancel</span>
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('admin.harvests.show', $harvest) }}" class="p-1.5 text-text-secondary hover:text-primary">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-6 py-8 text-center text-text-secondary">Tidak ada data panen.</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    <div class="mt-4">{{ $harvests->appends(request()->query())->links() }}</div>
@endsection
