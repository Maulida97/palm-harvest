@extends('layouts.palm')

@section('title', 'Input Panen')

@php $pageTitle = 'Input Data Panen'; @endphp

@section('content')
    <div class="max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('officer.dashboard') }}" class="text-primary hover:underline text-sm flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                Kembali ke Dashboard
            </a>
        </div>

        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
            <h2 class="text-lg font-bold text-text-main mb-6">Form Input Panen</h2>
            
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <ul class="list-disc list-inside text-red-700 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('officer.harvests.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label for="block_id" class="block text-sm font-medium text-text-main mb-1">Pilih Blok *</label>
                    <select name="block_id" id="block_id" required
                            class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm @error('block_id') border-red-500 @enderror">
                        <option value="">-- Pilih Blok --</option>
                        @foreach($blocks as $block)
                            <option value="{{ $block->id }}" {{ old('block_id') == $block->id ? 'selected' : '' }}>
                                {{ $block->code }} - {{ $block->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('block_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="weight_kg" class="block text-sm font-medium text-text-main mb-1">Berat (Kg) *</label>
                    <input type="number" name="weight_kg" id="weight_kg" step="0.01" min="0.01" required
                           value="{{ old('weight_kg') }}"
                           placeholder="Contoh: 1250.50"
                           class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm @error('weight_kg') border-red-500 @enderror">
                    @error('weight_kg')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="harvest_date" class="block text-sm font-medium text-text-main mb-1">Tanggal Panen *</label>
                    <input type="date" name="harvest_date" id="harvest_date" required
                           value="{{ old('harvest_date', date('Y-m-d')) }}"
                           max="{{ date('Y-m-d') }}"
                           class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm @error('harvest_date') border-red-500 @enderror">
                    @error('harvest_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="notes" class="block text-sm font-medium text-text-main mb-1">Catatan (Opsional)</label>
                    <textarea name="notes" id="notes" rows="3"
                              placeholder="Catatan tambahan tentang kondisi panen..."
                              class="w-full px-3 py-2 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">{{ old('notes') }}</textarea>
                </div>
                
                <div class="pt-4 flex gap-3">
                    <button type="submit" class="flex-1 h-10 bg-primary hover:bg-primary/90 text-white rounded-lg font-semibold transition-colors flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Simpan
                    </button>
                    <a href="{{ route('officer.dashboard') }}" class="flex-1 h-10 border border-surface-border rounded-lg font-semibold text-text-main hover:bg-surface-light transition-colors flex items-center justify-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
