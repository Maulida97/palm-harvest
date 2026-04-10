@extends('layouts.palm')

@section('title', 'Edit Pupuk')

@php $pageTitle = 'Master Data Pupuk'; @endphp

@section('content')
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-bold text-text-main">Edit Pupuk</h2>
                <p class="text-text-secondary text-sm">Edit data pupuk: {{ $fertilizer->name }}</p>
            </div>
            <a href="{{ route('admin.fertilizers.index') }}" 
               class="h-10 px-4 border border-surface-border rounded-lg text-sm font-medium flex items-center gap-2 hover:bg-gray-50">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Kembali
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
            <form action="{{ route('admin.fertilizers.update', $fertilizer) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama Pupuk -->
                <div class="mb-4">
                    <label class="block text-xs font-medium text-text-secondary uppercase mb-1">Nama Pupuk <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $fertilizer->name) }}" required
                           placeholder="Contoh: Urea, NPK, KCl"
                           class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Harga per Kg -->
                <div class="mb-4">
                    <label class="block text-xs font-medium text-text-secondary uppercase mb-1">Harga per Kg (Rp) <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-text-secondary text-sm">Rp</span>
                        <input type="number" name="price_per_kg" value="{{ old('price_per_kg', $fertilizer->price_per_kg) }}" required
                               min="0" step="1" placeholder="0"
                               class="w-full h-10 pl-10 pr-3 rounded-lg border border-surface-border text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary @error('price_per_kg') border-red-500 @enderror">
                    </div>
                    @error('price_per_kg')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-6">
                    <label class="block text-xs font-medium text-text-secondary uppercase mb-1">Status</label>
                    <select name="status" class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary">
                        <option value="active" {{ old('status', $fertilizer->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status', $fertilizer->status) == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                <!-- Submit -->
                <div class="flex gap-3">
                    <button type="submit" 
                            class="flex items-center gap-2 h-10 px-6 bg-primary hover:bg-primary/90 text-white rounded-lg text-sm font-semibold transition-colors">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.fertilizers.index') }}" 
                       class="h-10 px-6 border border-surface-border rounded-lg text-sm font-medium flex items-center hover:bg-gray-50">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
