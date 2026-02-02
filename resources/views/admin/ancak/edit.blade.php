@extends('layouts.palm')

@section('title', 'Edit Kebersihan Ancak')

@php $pageTitle = 'Kebersihan Ancak Panen & TPH'; @endphp

@section('content')
    <form action="{{ route('admin.ancak.update', $ancak) }}" method="POST" enctype="multipart/form-data" id="ancakForm">
        @csrf
        @method('PUT')
        
        <!-- Header Form -->
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm mb-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-text-main">Edit Informasi Inspeksi</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-4">
                <!-- Nama QC -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">NAMA QC</label>
                    <input type="text" name="qc_name" value="{{ old('qc_name', $ancak->qc_name) }}" required
                           class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                </div>
                
                <!-- Divisi -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">DIVISI</label>
                    <select name="division_id" id="division_id" required
                            class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                        <option value="">Pilih Divisi</option>
                        @foreach($divisions as $division)
                            <option value="{{ $division->id }}" 
                                    data-blocks='@json($division->blocks)'
                                    {{ old('division_id', $ancak->division_id) == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Blok -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">BLOK</label>
                    <select name="block_id" id="block_id" required
                            class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                        <option value="">Pilih Blok</option>
                    </select>
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
                    <input type="number" name="planting_year" value="{{ old('planting_year', $ancak->planting_year) }}" 
                           class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Jenis Bibit -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">JENIS BIBIT</label>
                    <input type="text" name="seed_type" value="{{ old('seed_type', $ancak->seed_type) }}" 
                           class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                </div>
                
                <!-- SPH -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">SPH</label>
                    <input type="number" name="sph" value="{{ old('sph', $ancak->sph) }}" 
                           class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                </div>
                
                <!-- Tanggal -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">TANGGAL</label>
                    <input type="date" name="inspection_date" value="{{ old('inspection_date', $ancak->inspection_date->format('Y-m-d')) }}" required
                           class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                </div>
                
                <!-- Mandor Panen -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">MANDOR PANEN</label>
                    <input type="text" name="foreman_name" value="{{ old('foreman_name', $ancak->foreman_name) }}" 
                           class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                </div>
                
                <!-- Kerani Panen -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">KERANI PANEN</label>
                    <input type="text" name="clerk_name" value="{{ old('clerk_name', $ancak->clerk_name) }}" 
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
                            <th class="px-3 py-2 font-semibold text-text-secondary uppercase text-xs w-20">TT</th>
                            <th class="px-3 py-2 font-semibold text-text-secondary uppercase text-xs w-20">BT</th>
                            <th class="px-3 py-2 font-semibold text-text-secondary uppercase text-xs">TPH</th>
                            <th class="px-3 py-2 font-semibold text-text-secondary uppercase text-xs w-28">APD</th>
                            <th class="px-3 py-2 font-semibold text-text-secondary uppercase text-xs w-28">DENDA</th>
                            <th class="px-3 py-2 w-10"></th>
                        </tr>
                    </thead>
                    <tbody id="inspectionRows">
                        @foreach($ancak->rows as $index => $row)
                        <tr class="border-b border-surface-border" data-row="{{ $index }}">
                            <td class="px-3 py-2 text-text-main row-number">{{ $index + 1 }}</td>
                            <td class="px-3 py-2"><input type="text" name="rows[{{ $index }}][harvester_name]" value="{{ $row->harvester_name }}" class="w-full h-9 px-2 rounded border border-surface-border text-sm"></td>
                            <td class="px-3 py-2"><input type="text" name="rows[{{ $index }}][ancak_location]" value="{{ $row->ancak_location }}" class="w-full h-9 px-2 rounded border border-surface-border text-sm"></td>
                            <td class="px-3 py-2"><input type="number" name="rows[{{ $index }}][bunch_count]" value="{{ $row->bunch_count }}" min="0" class="w-full h-9 px-2 rounded border border-surface-border text-sm text-center"></td>
                            <td class="px-3 py-2"><input type="number" name="rows[{{ $index }}][bt_pkk]" value="{{ $row->bt_pkk }}" min="0" class="w-full h-9 px-2 rounded border border-surface-border text-sm text-center"></td>
                            <td class="px-3 py-2"><input type="text" name="rows[{{ $index }}][tph_number]" value="{{ $row->tph_number }}" class="w-full h-9 px-2 rounded border border-surface-border text-sm"></td>
                            <td class="px-3 py-2">
                                <select name="rows[{{ $index }}][apd_status]" class="w-full h-9 px-2 rounded border border-surface-border text-sm">
                                    <option value="lengkap" {{ $row->apd_status === 'lengkap' ? 'selected' : '' }}>Lengkap</option>
                                    <option value="tidak" {{ $row->apd_status === 'tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </td>
                            <td class="px-3 py-2"><input type="number" name="rows[{{ $index }}][fine_amount]" value="{{ $row->fine_amount }}" min="0" class="w-full h-9 px-2 rounded border border-surface-border text-sm text-right"></td>
                            <td class="px-3 py-2">
                                <button type="button" onclick="removeRow(this)" class="p-1 text-red-400 hover:text-red-600">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </td>
                        </tr>
                        @endforeach
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
            <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
                <h4 class="flex items-center gap-2 text-base font-semibold text-text-main mb-3">
                    <span class="material-symbols-outlined text-[20px] text-text-secondary">search</span>
                    Temuan (Findings)
                </h4>
                <textarea name="findings" rows="4" class="w-full px-3 py-2 rounded-lg border border-surface-border text-sm resize-none">{{ old('findings', $ancak->findings) }}</textarea>
                
                <!-- Upload Gambar -->
                <div class="mt-4 pt-4 border-t border-surface-border">
                    <label class="block text-xs font-medium text-text-secondary mb-2">UPLOAD GAMBAR BUKTI</label>
                    <div class="flex items-start gap-4">
                        <div id="imagePreviewContainer" class="{{ $ancak->evidence_path ? '' : 'hidden' }} w-24 h-24 rounded-lg border border-surface-border overflow-hidden bg-gray-50">
                            @if($ancak->evidence_path)
                                <img id="imagePreview" src="{{ Storage::url($ancak->evidence_path) }}" alt="Preview" class="w-full h-full object-cover">
                            @else
                                <img id="imagePreview" src="" alt="Preview" class="w-full h-full object-cover">
                            @endif
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
                            <p id="evidenceFileName" class="text-xs text-text-secondary mt-1">{{ $ancak->evidence_path ? basename($ancak->evidence_path) : '' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
                <h4 class="flex items-center gap-2 text-base font-semibold text-text-main mb-3">
                    <span class="material-symbols-outlined text-[20px] text-text-secondary">check_box</span>
                    Tanggapan (Response)
                </h4>
                <textarea name="response" rows="6" class="w-full px-3 py-2 rounded-lg border border-surface-border text-sm resize-none">{{ old('response', $ancak->response) }}</textarea>
            </div>
        </div>
        
        <!-- Submit Button -->
        <div class="flex justify-center gap-4">
            <a href="{{ route('admin.ancak.index') }}" 
               class="h-12 px-8 border border-surface-border rounded-full text-sm font-semibold flex items-center">
                Batal
            </a>
            <button type="submit" 
                    class="flex items-center gap-2 h-12 px-8 bg-[#1a3636] hover:bg-[#1a3636]/90 text-white rounded-full text-sm font-semibold transition-colors">
                Update Report
                <span class="material-symbols-outlined text-[18px]">send</span>
            </button>
        </div>
    </form>

    <script>
    let rowCount = {{ $ancak->rows->count() }};
    const currentBlockId = '{{ $ancak->block_id }}';
    
    function addRow() {
        const tbody = document.getElementById('inspectionRows');
        const newRow = document.createElement('tr');
        newRow.className = 'border-b border-surface-border';
        newRow.dataset.row = rowCount;
        newRow.innerHTML = `
            <td class="px-3 py-2 text-text-main row-number">${rowCount + 1}</td>
            <td class="px-3 py-2"><input type="text" name="rows[${rowCount}][harvester_name]" class="w-full h-9 px-2 rounded border border-surface-border text-sm"></td>
            <td class="px-3 py-2"><input type="text" name="rows[${rowCount}][ancak_location]" class="w-full h-9 px-2 rounded border border-surface-border text-sm"></td>
            <td class="px-3 py-2"><input type="number" name="rows[${rowCount}][bunch_count]" value="0" min="0" class="w-full h-9 px-2 rounded border border-surface-border text-sm text-center"></td>
            <td class="px-3 py-2"><input type="number" name="rows[${rowCount}][bt_pkk]" value="0" min="0" class="w-full h-9 px-2 rounded border border-surface-border text-sm text-center"></td>
            <td class="px-3 py-2"><input type="text" name="rows[${rowCount}][tph_number]" class="w-full h-9 px-2 rounded border border-surface-border text-sm"></td>
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
    
    document.addEventListener('DOMContentLoaded', function() {
        const divisionSelect = document.getElementById('division_id');
        const blockSelect = document.getElementById('block_id');
        const luasInput = document.getElementById('luas_blok');
        
        function updateBlocks(initBlockId = null) {
            const selectedOption = divisionSelect.options[divisionSelect.selectedIndex];
            const blocks = selectedOption.dataset.blocks ? JSON.parse(selectedOption.dataset.blocks) : [];
            
            blockSelect.innerHTML = '<option value="">Pilih Blok</option>';
            luasInput.value = '';
            
            blocks.forEach(block => {
                const option = document.createElement('option');
                option.value = block.id;
                option.textContent = block.code;
                option.dataset.area = block.area_hectares;
                if (initBlockId && block.id == initBlockId) {
                    option.selected = true;
                    luasInput.value = block.area_hectares || '';
                }
                blockSelect.appendChild(option);
            });
        }
        
        function updateBlockInfo() {
            const selectedOption = blockSelect.options[blockSelect.selectedIndex];
            if (selectedOption && selectedOption.value) {
                luasInput.value = selectedOption.dataset.area || '';
            }
        }
        
        divisionSelect.addEventListener('change', () => updateBlocks());
        blockSelect.addEventListener('change', updateBlockInfo);
        
        // Initialize with current block
        updateBlocks(currentBlockId);
        
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
            }
        });
    });
    </script>
@endsection
