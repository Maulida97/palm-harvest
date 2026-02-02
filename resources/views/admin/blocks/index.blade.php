@extends('layouts.palm')

@section('title', 'Kelola Blok')

@php $pageTitle = 'Kelola Blok'; @endphp

@section('content')
    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-text-main">Master Data Blok</h2>
            <p class="text-text-secondary text-sm">Kelola blok/sektor kebun sawit</p>
        </div>
        <a href="{{ route('admin.blocks.create') }}" 
           class="flex items-center gap-2 h-10 px-4 bg-primary hover:bg-primary/90 text-white rounded-lg text-sm font-semibold transition-colors">
            <span class="material-symbols-outlined text-[18px]">add</span>
            Tambah Blok
        </a>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white p-4 rounded-xl border border-surface-border shadow-sm mb-4">
        <form action="{{ route('admin.blocks.index') }}" method="GET" class="flex flex-col md:flex-row gap-3">
            <!-- Search -->
            <div class="flex-1">
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-secondary text-[20px]">search</span>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari kode atau nama blok..."
                           class="w-full h-10 pl-10 pr-4 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                </div>
            </div>
            
            <!-- Filter Divisi -->
            <div class="w-full md:w-48">
                <select name="division_id" class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                    <option value="">Semua Divisi</option>
                    @foreach($divisions as $division)
                        <option value="{{ $division->id }}" {{ request('division_id') == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- Filter Status -->
            <div class="w-full md:w-36">
                <select name="status" class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
            
            <!-- Buttons -->
            <div class="flex gap-2">
                <button type="submit" class="h-10 px-4 bg-primary hover:bg-primary/90 text-white rounded-lg text-sm font-semibold transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">filter_list</span>
                    Filter
                </button>
                @if(request()->hasAny(['search', 'division_id', 'status']))
                    <a href="{{ route('admin.blocks.index') }}" class="h-10 px-4 border border-surface-border rounded-lg text-sm font-semibold text-text-main hover:bg-surface-light transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Results Info -->
    @if(request()->hasAny(['search', 'division_id', 'status']))
        <div class="mb-4 text-sm text-text-secondary">
            Menampilkan {{ $blocks->total() }} blok
            @if(request('division_id'))
                di <strong>{{ $divisions->find(request('division_id'))->name ?? '' }}</strong>
            @endif
            @if(request('search'))
                dengan kata kunci "<strong>{{ request('search') }}</strong>"
            @endif
        </div>
    @endif

    <!-- Blocks Table -->
    <div class="overflow-hidden rounded-xl border border-surface-border bg-white shadow-sm">
        <div class="overflow-x-auto">
        <table class="w-full text-left text-sm min-w-[700px]">
            <thead class="bg-surface-light border-b border-surface-border">
                <tr>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs tracking-wider">Divisi</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs tracking-wider">Kode</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs tracking-wider">Nama Blok</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs tracking-wider">Luas (Ha)</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs tracking-wider">Jml Pokok</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs tracking-wider">Status</th>
                    <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-border">
                @forelse($blocks as $block)
                    <tr class="hover:bg-[#fafcf8] transition-colors">
                        <td class="px-4 py-3 text-text-main">{{ $block->division->name ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#edf3e7] text-text-main">
                                {{ $block->code }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-text-main font-medium">{{ $block->name }}</td>
                        <td class="px-4 py-3 text-text-main">{{ number_format($block->area_hectares ?? 0, 2) }}</td>
                        <td class="px-4 py-3 text-text-main">{{ number_format($block->tree_count ?? 0) }}</td>
                        <td class="px-4 py-3">
                            @if($block->status === 'active')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-[#e1f5d6] text-[#0c4e16]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#66bd0f]"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                    Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.blocks.edit', $block) }}" class="p-1.5 text-text-secondary hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('admin.blocks.destroy', $block) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus blok ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-text-secondary hover:text-red-500 transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-text-secondary">
                            @if(request()->hasAny(['search', 'division_id', 'status']))
                                Tidak ada blok yang cocok dengan filter.
                            @else
                                Belum ada data blok.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $blocks->links() }}
    </div>
@endsection
