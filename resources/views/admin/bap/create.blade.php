@extends('layouts.palm')

@section('title', 'Input Data QC')

@php $pageTitle = 'Form Data QC'; @endphp

@section('content')
    <div class="max-w-4xl">
        <div class="mb-6">
            <a href="{{ route('admin.bap.index') }}" class="text-primary hover:underline text-sm flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                Kembali ke Data QC
            </a>
        </div>

        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
            <h2 class="text-lg font-bold text-text-main mb-6">Form Data QC</h2>
            
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <ul class="list-disc list-inside text-red-700 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('admin.bap.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="status" id="status" value="verified">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-4">
                        <!-- Row 1: Divisi & Block -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="division_id" class="block text-sm font-medium text-text-main mb-1">Divisi *</label>
                                <select name="division_id" id="division_id" required
                                        class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm bg-[#edf3e7]"
                                        onchange="updateBlocks()">
                                    <option value="">-- Pilih Divisi --</option>
                                    @foreach($divisions as $division)
                                        <option value="{{ $division->id }}" data-blocks='@json($division->blocks)' {{ old('division_id') == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="block_id" class="block text-sm font-medium text-text-main mb-1">Block *</label>
                                <select name="block_id" id="block_id" required
                                        class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm bg-[#edf3e7] @error('block_id') border-red-500 @enderror"
                                        onchange="updateBlockInfo()">
                                    <option value="">-- Pilih Block --</option>
                                </select>
                                @error('block_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        
                        <!-- Row 2: Tanggal Selesai & Luas -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-text-main mb-1">Tanggal Selesai</label>
                                <input type="date" name="end_date" id="end_date"
                                       value="{{ old('end_date', date('Y-m-d')) }}"
                                       class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm bg-[#edf3e7]">
                            </div>
                            <div>
                                <label for="luas" class="block text-sm font-medium text-text-main mb-1">Luas (Ha)</label>
                                <input type="number" name="luas" id="luas" step="0.01" min="0" readonly
                                       value="{{ old('luas') }}"
                                       placeholder="Otomatis dari master data"
                                       class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm bg-gray-100 cursor-not-allowed">
                            </div>
                        </div>
                        
                        <!-- Row 3: Jumlah Pokok -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="tree_count" class="block text-sm font-medium text-text-main mb-1">Jumlah Pokok</label>
                                <input type="number" name="tree_count" id="tree_count" readonly
                                       value="{{ old('tree_count') }}"
                                       placeholder="Otomatis dari master data"
                                       class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm bg-gray-100 cursor-not-allowed">
                            </div>
                            <div>
                                <label for="no_spk" class="block text-sm font-medium text-text-main mb-1">No. SPK</label>
                                <input type="text" name="no_spk" id="no_spk"
                                       value="{{ old('no_spk') }}"
                                       placeholder="Contoh: HARIAN, BORONGAN, SPK-001"
                                       class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm bg-[#edf3e7]">
                            </div>
                        </div>
                        
                        <!-- Row 4: Status & Keterangan -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-text-main mb-1">Status</label>
                                <div class="flex gap-2">
                                    <label class="flex items-center gap-2 px-3 py-2 rounded-lg border border-surface-border bg-[#edf3e7] cursor-pointer">
                                        <input type="radio" name="status_display" value="verified" checked class="text-primary focus:ring-primary" onchange="document.getElementById('status').value='verified'">
                                        <span class="text-sm">OK</span>
                                    </label>
                                    <label class="flex items-center gap-2 px-3 py-2 rounded-lg border border-surface-border bg-[#edf3e7] cursor-pointer">
                                        <input type="radio" name="status_display" value="pending" class="text-primary focus:ring-primary" onchange="document.getElementById('status').value='pending'">
                                        <span class="text-sm">Hold</span>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label for="weight_kg" class="block text-sm font-medium text-text-main mb-1">Total (Kg) *</label>
                                <input type="number" name="weight_kg" id="weight_kg" step="0.01" min="0.01" required
                                       value="{{ old('weight_kg') }}"
                                       placeholder="0.00"
                                       class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm bg-[#edf3e7] @error('weight_kg') border-red-500 @enderror">
                                @error('weight_kg')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        
                        <!-- Keterangan -->
                        <div>
                            <label for="notes" class="block text-sm font-medium text-text-main mb-1">Keterangan <span class="text-text-secondary text-xs">(Opsional)</span></label>
                            <textarea name="notes" id="notes" rows="2"
                                   class="w-full px-3 py-2 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm bg-[#edf3e7] resize-none">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="space-y-4">
                        <!-- Row 1: Tanggal Terakhir & Tanggal Mulai -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="harvest_date" class="block text-sm font-medium text-text-main mb-1">Tanggal Terakhir <span class="text-text-secondary text-xs">(Opsional)</span></label>
                                <input type="date" name="harvest_date" id="harvest_date"
                                       value="{{ old('harvest_date') }}"
                                       class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm bg-[#edf3e7] @error('harvest_date') border-red-500 @enderror">
                                @error('harvest_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-text-main mb-1">Tanggal Mulai</label>
                                <input type="date" name="start_date" id="start_date"
                                       value="{{ old('start_date') }}"
                                       class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm bg-[#edf3e7]">
                            </div>
                        </div>
                        
                        <!-- Input Gambar -->
                        <div>
                            <label for="image" class="block text-sm font-medium text-text-main mb-1">Input Gambar</label>
                            <div class="border-2 border-dashed border-surface-border rounded-lg bg-[#edf3e7] p-4 h-[180px] flex flex-col items-center justify-center cursor-pointer hover:border-primary/50 transition-colors" onclick="document.getElementById('image').click()">
                                <span class="material-symbols-outlined text-text-secondary text-4xl mb-2">add_photo_alternate</span>
                                <p class="text-text-secondary text-sm">Klik untuk upload gambar</p>
                                <p class="text-text-secondary text-xs mt-1">JPG, PNG (Max 2MB)</p>
                                <input type="file" name="image" id="image" accept="image/*" class="hidden" onchange="previewImage(this)">
                            </div>
                            <div id="imagePreview" class="mt-2 hidden">
                                <img id="preview" src="" alt="Preview" class="max-h-32 rounded-lg">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="mt-8 pt-6 border-t border-surface-border flex gap-3">
                    <button type="submit" onclick="document.getElementById('status').value='verified'" 
                            class="h-10 px-6 bg-primary hover:bg-primary/90 text-white rounded-lg font-semibold transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">check_circle</span>
                        Simpan Data
                    </button>
                    <a href="{{ route('admin.bap.index') }}" 
                       class="h-10 px-6 border border-surface-border rounded-lg font-semibold text-text-main hover:bg-surface-light transition-colors flex items-center gap-2">
                        Batalkan
                    </a>
                    <button type="submit" onclick="document.getElementById('status').value='pending'" 
                            class="h-10 px-6 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg font-semibold transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">pending</span>
                        Set Hold
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        // Store blocks data
        let blocksData = {};
        
        // Initialize blocks data from divisions
        document.querySelectorAll('#division_id option').forEach(option => {
            if (option.dataset.blocks) {
                blocksData[option.value] = JSON.parse(option.dataset.blocks);
            }
        });
        
        function updateBlocks() {
            const divisionId = document.getElementById('division_id').value;
            const blockSelect = document.getElementById('block_id');
            
            // Clear current options
            blockSelect.innerHTML = '<option value="">-- Pilih Block --</option>';
            
            // Clear luas and tree_count
            document.getElementById('luas').value = '';
            document.getElementById('tree_count').value = '';
            
            if (divisionId && blocksData[divisionId]) {
                blocksData[divisionId].forEach(block => {
                    const option = document.createElement('option');
                    option.value = block.id;
                    option.textContent = block.code;
                    option.dataset.area = block.area_hectares || '';
                    option.dataset.trees = block.tree_count || '';
                    blockSelect.appendChild(option);
                });
            }
        }
        
        function updateBlockInfo() {
            const blockSelect = document.getElementById('block_id');
            const selectedOption = blockSelect.options[blockSelect.selectedIndex];
            
            if (selectedOption && selectedOption.value) {
                document.getElementById('luas').value = selectedOption.dataset.area || '';
                document.getElementById('tree_count').value = selectedOption.dataset.trees || '';
            } else {
                document.getElementById('luas').value = '';
                document.getElementById('tree_count').value = '';
            }
        }
        
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        // Initialize on page load if there's old value
        @if(old('division_id'))
            document.getElementById('division_id').value = '{{ old('division_id') }}';
            updateBlocks();
            @if(old('block_id'))
                document.getElementById('block_id').value = '{{ old('block_id') }}';
                updateBlockInfo();
            @endif
        @endif
    </script>
@endsection
