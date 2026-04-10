@extends('layouts.palm')

@section('title', 'Edit Spotchek Pemupukan')

@php $pageTitle = 'Edit Spotchek Pemupukan'; @endphp

@section('content')
    <div class="max-w-4xl">
        <div class="mb-6">
            <a href="{{ route('admin.fertilizer-spotchecks.index') }}" class="text-primary hover:underline text-sm flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                Kembali ke Daftar Spotchek
            </a>
        </div>

        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
            <h2 class="text-lg font-bold text-text-main mb-6">Form Edit Spotchek Pemupukan #{{ $fertilizer_spotcheck->id }}</h2>
            
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <ul class="list-disc list-inside text-red-700 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('admin.fertilizer-spotchecks.update', $fertilizer_spotcheck) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kolom Kiri -->
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="division_id" class="block text-sm font-medium text-text-main mb-1">Divisi *</label>
                                <select name="division_id" id="division_id" required
                                        class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm bg-[#edf3e7]"
                                        onchange="updateBlocks()">
                                    <option value="">-- Pilih Divisi --</option>
                                    @foreach($divisions as $division)
                                        <option value="{{ $division->id }}" data-blocks='@json($division->blocks)' {{ old('division_id', $fertilizer_spotcheck->division_id) == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="block_id" class="block text-sm font-medium text-text-main mb-1">Block *</label>
                                <select name="block_id" id="block_id" required
                                        class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm bg-[#edf3e7]">
                                    <option value="">-- Pilih Block --</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="inspection_date" class="block text-sm font-medium text-text-main mb-1">Tanggal Inspeksi *</label>
                            <input type="date" name="inspection_date" id="inspection_date" required
                                   value="{{ old('inspection_date', $fertilizer_spotcheck->inspection_date->format('Y-m-d')) }}"
                                   class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm bg-[#edf3e7]">
                        </div>

                        <div>
                            <label for="worker_name" class="block text-sm font-medium text-text-main mb-1">Nama Pekerja <span class="text-text-secondary text-xs">(Opsional)</span></label>
                            <input type="text" name="worker_name" id="worker_name" 
                                   value="{{ old('worker_name', $fertilizer_spotcheck->worker_name) }}"
                                   placeholder="Contoh: Budi Susanto"
                                   class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm bg-[#edf3e7]">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-text-main mb-1">Status Tindak Lanjut</label>
                            <div class="flex gap-2">
                                <label class="flex items-center gap-2 px-3 py-2 rounded-lg border border-surface-border bg-[#edf3e7] cursor-pointer">
                                    <input type="radio" name="status" value="pending" {{ old('status', $fertilizer_spotcheck->status) == 'pending' ? 'checked' : '' }} class="text-primary focus:ring-primary">
                                    <span class="text-sm">Pending</span>
                                </label>
                                <label class="flex items-center gap-2 px-3 py-2 rounded-lg border border-surface-border bg-[#edf3e7] cursor-pointer">
                                    <input type="radio" name="status" value="completed" {{ old('status', $fertilizer_spotcheck->status) == 'completed' ? 'checked' : '' }} class="text-primary focus:ring-primary">
                                    <span class="text-sm">Completed</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Kolom Kanan -->
                    <div class="space-y-4">
                        <div>
                            <label for="fertilizer_id" class="block text-sm font-medium text-text-main mb-1">Jenis Pupuk & Harga *</label>
                            <select name="fertilizer_id" id="fertilizer_id" required
                                    class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm bg-[#edf3e7]"
                                    onchange="updatePenalty()">
                                <option value="" data-price="0">-- Pilih Jenis Pupuk --</option>
                                @foreach($fertilizers as $fertilizer)
                                    <option value="{{ $fertilizer->id }}" 
                                            data-price="{{ $fertilizer->price_per_kg }}" 
                                            {{ old('fertilizer_id', $fertilizer_spotcheck->fertilizer_id) == $fertilizer->id ? 'selected' : '' }}>
                                        {{ $fertilizer->name }} - Rp {{ number_format($fertilizer->price_per_kg, 0, ',', '.') }}/Kg
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="unapplied_kg" class="block text-sm font-medium text-text-main mb-1">Temuan / Tidak Ditabur (Kg) *</label>
                            <input type="number" name="unapplied_kg" id="unapplied_kg" step="0.01" min="0" required
                                   value="{{ old('unapplied_kg', $fertilizer_spotcheck->unapplied_kg) }}"
                                   onkeyup="updatePenalty()" onchange="updatePenalty()"
                                   class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm bg-[#edf3e7] text-red-600 font-bold">
                        </div>

                        <!-- Info Denda -->
                        <div class="p-4 bg-red-50 rounded-lg border border-red-200">
                            <h3 class="text-sm font-semibold text-red-800 mb-1">Estimasi Denda (Otomatis)</h3>
                            <div class="text-xl font-bold text-red-600" id="penalty_amount_display">
                                Rp {{ number_format($fertilizer_spotcheck->penalty_amount, 0, ',', '.') }}
                            </div>
                            <p class="text-xs text-red-500 mt-1">Dihitung dari: Temuan (Kg) &times; Harga Pupuk Pilihan</p>
                        </div>

                        <div>
                            <label for="evidence_path" class="block text-sm font-medium text-text-main mb-1">Foto Bukti Lapangan <span class="text-text-secondary text-xs">(Opsional)</span></label>
                            @if($fertilizer_spotcheck->evidence_path)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $fertilizer_spotcheck->evidence_path) }}" alt="Bukti" class="h-20 rounded border border-surface-border object-cover">
                                </div>
                            @endif
                            <input type="file" name="evidence_path" id="evidence_path" accept="image/*"
                                   class="w-full text-sm text-text-secondary file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition-colors">
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <label for="findings" class="block text-sm font-medium text-text-main mb-1">Keterangan / Temuan QC <span class="text-text-secondary text-xs">(Opsional)</span></label>
                    <textarea name="findings" id="findings" rows="3"
                           class="w-full px-3 py-2 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm bg-[#edf3e7] resize-none">{{ old('findings', $fertilizer_spotcheck->findings) }}</textarea>
                </div>
                
                <!-- Action Buttons -->
                <div class="mt-8 pt-6 border-t border-surface-border flex gap-3">
                    <button type="submit" 
                            class="h-10 px-6 bg-primary hover:bg-primary/90 text-white rounded-lg font-semibold transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.fertilizer-spotchecks.index') }}" 
                       class="h-10 px-6 border border-surface-border rounded-lg font-semibold text-text-main hover:bg-surface-light transition-colors flex items-center gap-2">
                        Batalkan
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        let blocksData = {};
        
        document.querySelectorAll('#division_id option').forEach(option => {
            if (option.dataset.blocks) blocksData[option.value] = JSON.parse(option.dataset.blocks);
        });
        
        function updateBlocks() {
            const divisionId = document.getElementById('division_id').value;
            const blockSelect = document.getElementById('block_id');
            const oldBlockId = '{{ old('block_id', $fertilizer_spotcheck->block_id) }}';
            
            blockSelect.innerHTML = '<option value="">-- Pilih Block --</option>';
            
            if (divisionId && blocksData[divisionId]) {
                blocksData[divisionId].forEach(block => {
                    const option = document.createElement('option');
                    option.value = block.id;
                    option.textContent = block.code;
                    if (oldBlockId == block.id) option.selected = true;
                    blockSelect.appendChild(option);
                });
            }
        }
        
        function updatePenalty() {
            const fertilizerSelect = document.getElementById('fertilizer_id');
            const selectedOpt = fertilizerSelect.options[fertilizerSelect.selectedIndex];
            const price = parseFloat(selectedOpt.dataset.price) || 0;
            
            const kgInput = document.getElementById('unapplied_kg').value;
            const kg = parseFloat(kgInput) || 0;
            
            const penalty = price * kg;
            
            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
            
            document.getElementById('penalty_amount_display').innerText = formatter.format(penalty);
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            if (document.getElementById('division_id').value) updateBlocks();
            updatePenalty();
        });
    </script>
@endsection
