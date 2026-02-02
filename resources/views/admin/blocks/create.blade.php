@extends('layouts.palm')

@section('title', 'Tambah Blok')

@php $pageTitle = 'Tambah Blok Baru'; @endphp

@section('content')
    <div class="max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('admin.blocks.index') }}" class="text-primary hover:underline text-sm flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                Kembali ke Daftar Blok
            </a>
        </div>

        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
            <h2 class="text-lg font-bold text-text-main mb-6">Form Tambah Blok</h2>
            
            <form action="{{ route('admin.blocks.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label for="division_id" class="block text-sm font-medium text-text-main mb-1">Divisi *</label>
                    <select name="division_id" id="division_id" required
                            class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm @error('division_id') border-red-500 @enderror">
                        <option value="">-- Pilih Divisi --</option>
                        @foreach($divisions as $division)
                            <option value="{{ $division->id }}" {{ old('division_id') == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                        @endforeach
                    </select>
                    @error('division_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="code" class="block text-sm font-medium text-text-main mb-1">Kode Blok *</label>
                        <input type="text" name="code" id="code" required maxlength="20"
                               value="{{ old('code') }}"
                               placeholder="Contoh: F4-3"
                               class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm @error('code') border-red-500 @enderror">
                        @error('code')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-text-main mb-1">Nama Blok *</label>
                        <input type="text" name="name" id="name" required
                               value="{{ old('name') }}"
                               placeholder="Contoh: Blok Utara 1"
                               class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="area_hectares" class="block text-sm font-medium text-text-main mb-1">Luas (Hektar)</label>
                        <input type="number" name="area_hectares" id="area_hectares" step="0.01" min="0"
                               value="{{ old('area_hectares') }}"
                               placeholder="Contoh: 25.5"
                               class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                    </div>
                    
                    <div>
                        <label for="tree_count" class="block text-sm font-medium text-text-main mb-1">Jumlah Pokok</label>
                        <input type="number" name="tree_count" id="tree_count" min="0"
                               value="{{ old('tree_count') }}"
                               placeholder="Contoh: 3500"
                               class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                    </div>
                </div>
                
                <div>
                    <label for="status" class="block text-sm font-medium text-text-main mb-1">Status *</label>
                    <select name="status" id="status" required
                            class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
                
                <div>
                    <label for="description" class="block text-sm font-medium text-text-main mb-1">Deskripsi</label>
                    <textarea name="description" id="description" rows="3"
                              placeholder="Deskripsi singkat tentang blok ini..."
                              class="w-full px-3 py-2 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">{{ old('description') }}</textarea>
                </div>
                
                <div class="pt-4 flex gap-3">
                    <button type="submit" 
                            class="flex-1 h-10 bg-primary hover:bg-primary/90 text-white rounded-lg font-semibold transition-colors flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Simpan
                    </button>
                    <a href="{{ route('admin.blocks.index') }}" 
                       class="flex-1 h-10 border border-surface-border rounded-lg font-semibold text-text-main hover:bg-surface-light transition-colors flex items-center justify-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
