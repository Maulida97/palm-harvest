@extends('layouts.palm')

@section('title', 'Master Data Pupuk')

@php $pageTitle = 'Master Data Pupuk'; @endphp

@section('content')
    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-text-main">Master Data Pupuk</h2>
            <p class="text-text-secondary text-sm">Kelola data pupuk dan harga per kilogram</p>
        </div>
        <a href="{{ route('admin.fertilizers.create') }}" 
           class="flex items-center gap-2 h-10 px-4 bg-primary hover:bg-primary/90 text-white rounded-lg text-sm font-semibold transition-colors">
            <span class="material-symbols-outlined text-[18px]">add</span>
            Tambah Pupuk
        </a>
    </div>


    <!-- Filter & Search -->
    <div class="bg-white p-4 rounded-xl border border-surface-border shadow-sm mb-4">
        <form action="{{ route('admin.fertilizers.index') }}" method="GET" class="flex flex-col md:flex-row gap-3">
            <!-- Search -->
            <div class="flex-1">
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-secondary text-[20px]">search</span>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari nama pupuk..."
                           class="w-full h-10 pl-10 pr-4 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                </div>
            </div>
            
            <!-- Filter Status -->
            <div class="w-full md:w-36">
                <select name="status" class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
            
            <button type="submit" class="h-10 px-4 bg-primary hover:bg-primary/90 text-white rounded-lg text-sm font-semibold transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">filter_list</span>
                Filter
            </button>
            
            @if(request('search') || request('status'))
                <a href="{{ route('admin.fertilizers.index') }}" class="h-10 px-4 border border-surface-border rounded-lg text-sm font-medium flex items-center gap-2 hover:bg-gray-50">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl border border-surface-border shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#edf3e7] border-b border-surface-border">
                    <tr>
                        <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs w-12">No</th>
                        <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Nama Pupuk</th>
                        <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Harga/Kg</th>
                        <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Status</th>
                        <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs w-32 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($fertilizers as $index => $fertilizer)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-4 py-3 text-text-secondary">{{ $fertilizers->firstItem() + $index }}</td>
                            <td class="px-4 py-3 text-text-main font-medium">{{ $fertilizer->name }}</td>
                            <td class="px-4 py-3 text-text-main">Rp {{ number_format($fertilizer->price_per_kg, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                @if($fertilizer->status === 'active')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">Aktif</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-center gap-1">
                                    <a href="{{ route('admin.fertilizers.edit', $fertilizer) }}" 
                                       class="p-1.5 rounded-lg hover:bg-blue-50 text-blue-500 hover:text-blue-700 transition-colors" title="Edit">
                                        <span class="material-symbols-outlined text-[18px]">edit</span>
                                    </a>
                                    <form action="{{ route('admin.fertilizers.destroy', $fertilizer) }}" method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus pupuk {{ $fertilizer->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg hover:bg-red-50 text-red-400 hover:text-red-600 transition-colors" title="Hapus">
                                            <span class="material-symbols-outlined text-[18px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-12 text-center">
                                <span class="material-symbols-outlined text-[48px] text-gray-300 mb-2 block">compost</span>
                                <p class="text-text-secondary">Belum ada data pupuk.</p>
                                <a href="{{ route('admin.fertilizers.create') }}" class="text-primary text-sm font-medium hover:underline mt-1 inline-block">+ Tambah Pupuk</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($fertilizers->hasPages())
            <div class="px-4 py-3 border-t border-surface-border">
                {{ $fertilizers->links() }}
            </div>
        @endif
    </div>
@endsection
