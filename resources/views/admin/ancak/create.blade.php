@extends('layouts.palm')

@section('title', 'Input Kebersihan Ancak')

@php $pageTitle = 'Kebersihan Ancak Panen & TPH'; @endphp

@section('content')
    <form action="{{ route('admin.ancak.store') }}" method="POST" enctype="multipart/form-data" id="ancakForm">
        @csrf
        
        <!-- Header Form -->
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm mb-6">
            <h3 class="text-lg font-semibold text-text-main mb-4">Informasi Inspeksi</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-4">
                <!-- Nama QC -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">NAMA QC</label>
                    <input type="text" name="qc_name" value="{{ old('qc_name') }}" required
                           placeholder="Nama Pemeriksa"
                           class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm @error('qc_name') border-red-500 @enderror">
                    @error('qc_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Divisi -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">DIVISI</label>
                    <select name="division_id" id="division_id" required
                            class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm @error('division_id') border-red-500 @enderror">
                        <option value="">Pilih Divisi</option>
                        @foreach($divisions as $division)
                            <option value="{{ $division->id }}" 
                                    data-blocks='@json($division->blocks)'
                                    {{ old('division_id') == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                        @endforeach
                    </select>
                    @error('division_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Blok -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">BLOK</label>
                    <select name="block_id" id="block_id" required
                            class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm @error('block_id') border-red-500 @enderror">
                        <option value="">Pilih Blok</option>
                    </select>
                    @error('block_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Luas Blok -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">LUAS BLOK (HA)</label>
                    <input type="text" id="luas_blok" readonly
                           class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm bg-gray-50">
                </div>
                
                <!-- Tahun Tanam -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">TAHUN TANAM</label>
                    <input type="number" name="planting_year" value="{{ old('planting_year') }}" 
                           placeholder="YYYY" min="1900" max="2100"
                           class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Jenis Bibit -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">JENIS BIBIT</label>
                    <input type="text" name="seed_type" value="{{ old('seed_type') }}" 
                           placeholder="Cth: Dami Mas"
                           class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                </div>
                
                <!-- SPH -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">SPH</label>
                    <input type="number" name="sph" value="{{ old('sph') }}" 
                           placeholder="143"
                           class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                </div>
                
                <!-- Tanggal -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">TANGGAL</label>
                    <input type="date" name="inspection_date" value="{{ old('inspection_date', date('Y-m-d')) }}" required
                           class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm @error('inspection_date') border-red-500 @enderror">
                    @error('inspection_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Mandor Panen -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">MANDOR PANEN</label>
                    <input type="text" name="foreman_name" value="{{ old('foreman_name') }}" 
                           placeholder="Nama Mandor"
                           class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                </div>
                
                <!-- Kerani Panen -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">KERANI PANEN</label>
                    <input type="text" name="clerk_name" value="{{ old('clerk_name') }}" 
                           placeholder="Nama Kerani"
                           class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                </div>
            </div>
        </div>
        
        <!-- Inspection Table -->
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm mb-6">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm min-w-[900px]" id="inspectionTable">
                    <thead class="bg-[#edf3e7] border-b border-surface-border">
                        <tr>
                            <th class="px-3 py-2 font-semibold text-text-secondary uppercase text-xs w-12">NO</th>
                            <th class="px-3 py-2 font-semibold text-text-secondary uppercase text-xs">PEMANEN</th>
                            <th class="px-3 py-2 font-semibold text-text-secondary uppercase text-xs">ANCAK</th>
                            <th class="px-3 py-2 font-semibold text-text-secondary uppercase text-xs w-20">TT (TANDAN)</th>
                            <th class="px-3 py-2 font-semibold text-text-secondary uppercase text-xs w-20">BT (PKK)</th>
                            <th class="px-3 py-2 font-semibold text-text-secondary uppercase text-xs">TPH</th>
                            <th class="px-3 py-2 font-semibold text-text-secondary uppercase text-xs w-28">APD</th>
                            <th class="px-3 py-2 font-semibold text-text-secondary uppercase text-xs w-28">DENDA (RP)</th>
                            <th class="px-3 py-2 w-10"></th>
                        </tr>
                    </thead>
                    <tbody id="inspectionRows">
                        <tr class="border-b border-surface-border" data-row="0">
                            <td class="px-3 py-2 text-text-main row-number">1</td>
                            <td class="px-3 py-2"><input type="text" name="rows[0][harvester_name]" placeholder="Nama Lengkap Pemanen" class="w-full h-9 px-2 rounded border border-surface-border text-sm"></td>
                            <td class="px-3 py-2"><input type="text" name="rows[0][ancak_location]" placeholder="Lokasi" class="w-full h-9 px-2 rounded border border-surface-border text-sm"></td>
                            <td class="px-3 py-2"><input type="number" name="rows[0][bunch_count]" value="0" min="0" class="w-full h-9 px-2 rounded border border-surface-border text-sm text-center"></td>
                            <td class="px-3 py-2"><input type="number" name="rows[0][bt_pkk]" value="0" min="0" class="w-full h-9 px-2 rounded border border-surface-border text-sm text-center"></td>
                            <td class="px-3 py-2"><input type="text" name="rows[0][tph_number]" placeholder="No. TPH" class="w-full h-9 px-2 rounded border border-surface-border text-sm"></td>
                            <td class="px-3 py-2">
                                <select name="rows[0][apd_status]" class="w-full h-9 px-2 rounded border border-surface-border text-sm">
                                    <option value="lengkap">Lengkap</option>
                                    <option value="tidak">Tidak</option>
                                </select>
                            </td>
                            <td class="px-3 py-2"><input type="number" name="rows[0][fine_amount]" value="0" min="0" class="w-full h-9 px-2 rounded border border-surface-border text-sm text-right"></td>
                            <td class="px-3 py-2">
                                <button type="button" onclick="removeRow(this)" class="p-1 text-red-400 hover:text-red-600">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <button type="button" onclick="addRow()" 
                    class="mt-4 flex items-center gap-2 text-primary hover:text-primary/80 text-sm font-medium">
                <span class="material-symbols-outlined text-[18px]">add_circle</span>
                Add Inspection Row
            </button>
        </div>
        
        <!-- Findings & Response -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Temuan -->
            <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
                <h4 class="flex items-center gap-2 text-base font-semibold text-text-main mb-3">
                    <span class="material-symbols-outlined text-[20px] text-text-secondary">search</span>
                    Temuan (Findings)
                </h4>
                <textarea name="findings" rows="4" 
                          placeholder="Catat temuan ketidaksesuaian di lapangan secara detail..."
                          class="w-full px-3 py-2 rounded-lg border border-surface-border text-sm resize-none">{{ old('findings') }}</textarea>
                
                <!-- Upload Gambar -->
                <div class="mt-4 pt-4 border-t border-surface-border">
                    <label class="block text-xs font-medium text-text-secondary mb-2">UPLOAD GAMBAR BUKTI</label>
                    <div class="flex items-start gap-4">
                        <div id="imagePreviewContainer" class="hidden w-24 h-24 rounded-lg border border-surface-border overflow-hidden bg-gray-50">
                            <img id="imagePreview" src="" alt="Preview" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <label class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-surface-border rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <div class="flex flex-col items-center justify-center py-2">
                                    <span class="material-symbols-outlined text-[28px] text-primary mb-1">cloud_upload</span>
                                    <p class="text-xs text-text-secondary">Klik untuk upload gambar</p>
                                    <p class="text-[10px] text-text-secondary/70">JPG, PNG (Max 5MB)</p>
                                </div>
                                <input type="file" name="evidence" accept=".jpg,.jpeg,.png" class="hidden" id="evidenceInput">
                            </label>
                            <p id="evidenceFileName" class="text-xs text-text-secondary mt-1"></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tanggapan -->
            <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
                <h4 class="flex items-center gap-2 text-base font-semibold text-text-main mb-3">
                    <span class="material-symbols-outlined text-[20px] text-text-secondary">check_box</span>
                    Tanggapan (Response)
                </h4>
                <textarea name="response" rows="6" 
                          placeholder="Tanggapan atau rencana tindakan perbaikan..."
                          class="w-full px-3 py-2 rounded-lg border border-surface-border text-sm resize-none">{{ old('response') }}</textarea>
            </div>
        </div>
        
        <!-- Submit Button -->
        <div class="flex justify-center">
            <button type="submit" 
                    class="flex items-center gap-2 h-12 px-8 bg-[#1a3636] hover:bg-[#1a3636]/90 text-white rounded-full text-sm font-semibold transition-colors">
                Submit Final Report
                <span class="material-symbols-outlined text-[18px]">send</span>
            </button>
        </div>
    </form>

    <script>
    let rowCount = 1;
    
    function addRow() {
        const tbody = document.getElementById('inspectionRows');
        const newRow = document.createElement('tr');
        newRow.className = 'border-b border-surface-border';
        newRow.dataset.row = rowCount;
        newRow.innerHTML = `
            <td class="px-3 py-2 text-text-main row-number">${rowCount + 1}</td>
            <td class="px-3 py-2"><input type="text" name="rows[${rowCount}][harvester_name]" placeholder="Nama Lengkap Pemanen" class="w-full h-9 px-2 rounded border border-surface-border text-sm"></td>
            <td class="px-3 py-2"><input type="text" name="rows[${rowCount}][ancak_location]" placeholder="Lokasi" class="w-full h-9 px-2 rounded border border-surface-border text-sm"></td>
            <td class="px-3 py-2"><input type="number" name="rows[${rowCount}][bunch_count]" value="0" min="0" class="w-full h-9 px-2 rounded border border-surface-border text-sm text-center"></td>
            <td class="px-3 py-2"><input type="number" name="rows[${rowCount}][bt_pkk]" value="0" min="0" class="w-full h-9 px-2 rounded border border-surface-border text-sm text-center"></td>
            <td class="px-3 py-2"><input type="text" name="rows[${rowCount}][tph_number]" placeholder="No. TPH" class="w-full h-9 px-2 rounded border border-surface-border text-sm"></td>
            <td class="px-3 py-2">
                <select name="rows[${rowCount}][apd_status]" class="w-full h-9 px-2 rounded border border-surface-border text-sm">
                    <option value="lengkap">Lengkap</option>
                    <option value="tidak">Tidak</option>
                </select>
            </td>
            <td class="px-3 py-2"><input type="number" name="rows[${rowCount}][fine_amount]" value="0" min="0" class="w-full h-9 px-2 rounded border border-surface-border text-sm text-right"></td>
            <td class="px-3 py-2">
                <button type="button" onclick="removeRow(this)" class="p-1 text-red-400 hover:text-red-600">
                    <span class="material-symbols-outlined text-[18px]">delete</span>
                </button>
            </td>
        `;
        tbody.appendChild(newRow);
        rowCount++;
        updateRowNumbers();
    }
    
    function removeRow(btn) {
        const tbody = document.getElementById('inspectionRows');
        if (tbody.children.length > 1) {
            btn.closest('tr').remove();
            updateRowNumbers();
        }
    }
    
    function updateRowNumbers() {
        const rows = document.querySelectorAll('#inspectionRows tr');
        rows.forEach((row, index) => {
            row.querySelector('.row-number').textContent = index + 1;
        });
    }
    
    // Dependent dropdown for division/block
    document.addEventListener('DOMContentLoaded', function() {
        const divisionSelect = document.getElementById('division_id');
        const blockSelect = document.getElementById('block_id');
        const luasInput = document.getElementById('luas_blok');
        
        function updateBlocks() {
            const selectedOption = divisionSelect.options[divisionSelect.selectedIndex];
            const blocks = selectedOption.dataset.blocks ? JSON.parse(selectedOption.dataset.blocks) : [];
            
            blockSelect.innerHTML = '<option value="">Pilih Blok</option>';
            luasInput.value = '';
            
            blocks.forEach(block => {
                const option = document.createElement('option');
                option.value = block.id;
                option.textContent = block.code;
                option.dataset.area = block.area_hectares;
                blockSelect.appendChild(option);
            });
        }
        
        function updateBlockInfo() {
            const selectedOption = blockSelect.options[blockSelect.selectedIndex];
            if (selectedOption && selectedOption.value) {
                luasInput.value = selectedOption.dataset.area || '';
            } else {
                luasInput.value = '';
            }
        }
        
        divisionSelect.addEventListener('change', updateBlocks);
        blockSelect.addEventListener('change', updateBlockInfo);
        
        // Initialize
        if (divisionSelect.value) {
            updateBlocks();
        }
        
        // Evidence file upload with preview
        document.getElementById('evidenceInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const previewContainer = document.getElementById('imagePreviewContainer');
            const preview = document.getElementById('imagePreview');
            const fileName = document.getElementById('evidenceFileName');
            
            if (file) {
                fileName.textContent = file.name;
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            } else {
                fileName.textContent = '';
                previewContainer.classList.add('hidden');
            }
        });
    });
    </script>
@endsection
