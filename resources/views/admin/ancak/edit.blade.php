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
                <select name="status" class="h-10 px-3 rounded-lg border border-surface-border text-sm">
                    <option value="pending" {{ $ancak->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ $ancak->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">NAMA QC</label>
                    <input type="text" name="qc_name" value="{{ old('qc_name', $ancak->qc_name) }}" required class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                </div>
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">DIVISI</label>
                    <select name="division_id" id="division_id" required class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                        <option value="">Pilih Divisi</option>
                        @foreach($divisions as $division)
                            <option value="{{ $division->id }}" data-blocks='@json($division->blocks)' {{ old('division_id', $ancak->division_id) == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">BLOK</label>
                    <select name="block_id" id="block_id" required class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                        <option value="">Pilih Blok</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">LUAS BLOK (HA)</label>
                    <input type="text" id="luas_blok" readonly class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm bg-gray-50">
                </div>
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">TAHUN TANAM</label>
                    <input type="number" name="planting_year" value="{{ old('planting_year', $ancak->planting_year) }}" class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">JENIS BIBIT</label>
                    <input type="text" name="seed_type" value="{{ old('seed_type', $ancak->seed_type) }}" class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                </div>
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">SPH</label>
                    <input type="number" name="sph" value="{{ old('sph', $ancak->sph) }}" class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                </div>
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">TANGGAL</label>
                    <input type="date" name="inspection_date" value="{{ old('inspection_date', $ancak->inspection_date->format('Y-m-d')) }}" required class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                </div>
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">MANDOR PANEN</label>
                    <input type="text" name="foreman_name" value="{{ old('foreman_name', $ancak->foreman_name) }}" class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                </div>
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">KERANI PANEN</label>
                    <input type="text" name="clerk_name" value="{{ old('clerk_name', $ancak->clerk_name) }}" class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                </div>
            </div>
        </div>
        
        <!-- Inspection Table -->
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm mb-6">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm min-w-[1100px]">
                    <thead class="bg-[#edf3e7] border-b border-surface-border">
                        <tr>
                            <th class="px-3 py-2 font-semibold text-text-secondary uppercase text-xs w-12">NO</th>
                            <th class="px-3 py-2 font-semibold text-text-secondary uppercase text-xs">PEMANEN</th>
                            <th class="px-3 py-2 font-semibold text-text-secondary uppercase text-xs">ANCAK</th>
                            <th class="px-3 py-2 font-semibold text-text-secondary uppercase text-xs w-20">TT</th>
                            <th class="px-3 py-2 font-semibold text-text-secondary uppercase text-xs w-20">BT</th>
                            <th class="px-3 py-2 font-semibold text-text-secondary uppercase text-xs">TPH</th>
                            <th class="px-3 py-2 font-semibold text-text-secondary uppercase text-xs">APD</th>
                            <th class="px-3 py-2 font-semibold text-text-secondary uppercase text-xs w-36">DENDA</th>
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
                            <td class="px-3 py-2">
                                <select name="rows[{{ $index }}][tph_status]" class="w-full h-9 px-2 rounded border border-surface-border text-sm">
                                    <option value="bersih" {{ ($row->tph_status ?? 'bersih') === 'bersih' ? 'selected' : '' }}>Bersih</option>
                                    <option value="kotor" {{ ($row->tph_status ?? '') === 'kotor' ? 'selected' : '' }}>Kotor</option>
                                </select>
                            </td>
                            <td class="px-3 py-2">
                                <select name="rows[{{ $index }}][apd_status]" class="w-full h-9 px-2 rounded border border-surface-border text-sm">
                                    <option value="lengkap" {{ $row->apd_status === 'lengkap' ? 'selected' : '' }}>Lengkap</option>
                                    <option value="boot" {{ $row->apd_status === 'boot' ? 'selected' : '' }}>Boot</option>
                                    <option value="helm" {{ $row->apd_status === 'helm' ? 'selected' : '' }}>Helm</option>
                                </select>
                            </td>
                            <td class="px-3 py-2">
                                <button type="button" onclick="openFineModal({{ $index }})" class="w-full h-9 px-2 rounded border border-primary bg-primary/10 text-primary text-sm font-medium hover:bg-primary/20 flex items-center justify-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">edit</span>
                                    <span class="fine-display-{{ $index }}">{{ $row->fine_pemanen > 0 ? 'Rp ' . number_format($row->fine_pemanen) : 'Pilih' }}</span>
                                </button>
                                <input type="hidden" name="rows[{{ $index }}][fine_data]" id="fine_data_{{ $index }}" value="">
                                <input type="hidden" name="rows[{{ $index }}][fine_pemanen]" id="fine_pemanen_{{ $index }}" value="{{ $row->fine_pemanen ?? 0 }}">
                                <input type="hidden" name="rows[{{ $index }}][fine_amount]" id="fine_amount_{{ $index }}" value="{{ $row->fine_amount ?? 0 }}">
                            </td>
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
            
            <button type="button" onclick="addRow()" class="mt-4 flex items-center gap-2 text-primary hover:text-primary/80 text-sm font-medium">
                <span class="material-symbols-outlined text-[18px]">add_circle</span>
                Add Inspection Row
            </button>
        </div>
        
        <!-- Ringkasan Denda per Role -->
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm mb-6">
            <h3 class="text-lg font-semibold text-text-main mb-4">Ringkasan Denda per Role</h3>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                <div class="bg-red-50 p-4 rounded-lg border border-red-200">
                    <p class="text-xs text-red-600 uppercase font-medium mb-1">Denda Pemanen</p>
                    <p class="text-lg font-bold text-red-700" id="totalFinePemanen">Rp 0</p>
                </div>
                <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                    <p class="text-xs text-yellow-600 uppercase font-medium mb-1">Denda Kerani Panen</p>
                    <p class="text-lg font-bold text-yellow-700" id="totalFineKerani">Rp 0</p>
                </div>
                <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                    <p class="text-xs text-blue-600 uppercase font-medium mb-1">Denda Mandor Panen</p>
                    <p class="text-lg font-bold text-blue-700" id="totalFineMandorPanen">Rp 0</p>
                </div>
                <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                    <p class="text-xs text-purple-600 uppercase font-medium mb-1">Denda Mandor 1</p>
                    <p class="text-lg font-bold text-purple-700" id="totalFineMandor1">Rp 0</p>
                </div>
                <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                    <p class="text-xs text-green-600 uppercase font-medium mb-1">Denda Asisten</p>
                    <p class="text-lg font-bold text-green-700" id="totalFineAsisten">Rp 0</p>
                </div>
            </div>
        </div>
        
        <!-- Findings -->
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm mb-6">
            <h4 class="flex items-center gap-2 text-base font-semibold text-text-main mb-3">
                <span class="material-symbols-outlined text-[20px] text-text-secondary">search</span>
                Temuan (Findings)
            </h4>
            <textarea name="findings" rows="4" class="w-full px-3 py-2 rounded-lg border border-surface-border text-sm resize-none">{{ old('findings', $ancak->findings) }}</textarea>
            
            <div class="mt-4 pt-4 border-t border-surface-border">
                <label class="block text-xs font-medium text-text-secondary mb-2">UPLOAD GAMBAR BUKTI</label>
                <div class="flex items-start gap-4">
                    <div id="imagePreviewContainer" class="{{ $ancak->evidence_path ? '' : 'hidden' }} w-24 h-24 rounded-lg border border-surface-border overflow-hidden bg-gray-50">
                        <img id="imagePreview" src="{{ $ancak->evidence_path ? Storage::url($ancak->evidence_path) : '' }}" alt="Preview" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1">
                        <label class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-surface-border rounded-lg cursor-pointer hover:bg-gray-50">
                            <span class="material-symbols-outlined text-[28px] text-primary mb-1">cloud_upload</span>
                            <p class="text-xs text-text-secondary">Klik untuk upload</p>
                            <input type="file" name="evidence" accept=".jpg,.jpeg,.png" class="hidden" id="evidenceInput">
                        </label>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex justify-center gap-4">
            <a href="{{ route('admin.ancak.index') }}" class="h-12 px-8 border border-surface-border rounded-full text-sm font-semibold flex items-center">Batal</a>
            <button type="submit" class="flex items-center gap-2 h-12 px-8 bg-[#1a3636] hover:bg-[#1a3636]/90 text-white rounded-full text-sm font-semibold">
                Simpan Perubahan
                <span class="material-symbols-outlined text-[18px]">save</span>
            </button>
        </div>
    </form>

    <!-- Fine Modal - Multi Choice -->
    <div id="fineModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl w-full max-w-3xl max-h-[90vh] overflow-hidden shadow-2xl">
            <div class="flex items-center justify-between p-4 border-b border-surface-border bg-[#edf3e7]">
                <h3 class="text-lg font-semibold text-text-main">Pilih Kategori Denda (Multi-Pilih)</h3>
                <button type="button" onclick="closeFineModal()" class="p-1 hover:bg-gray-200 rounded">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="p-4 overflow-y-auto max-h-[55vh]">
                <p class="text-sm text-text-secondary mb-3">Centang kategori denda dan masukkan jumlah temuan untuk setiap pelanggaran:</p>
                <div class="space-y-2" id="fineCategories">
                    @foreach($fineCategories as $cat)
                    <div class="fine-option flex items-start gap-3 p-3 rounded-lg border border-surface-border hover:border-primary hover:bg-primary/5 transition-all" data-id="{{ $cat->id }}" data-code="{{ $cat->code }}" data-desc="{{ $cat->description }}" data-pemanen="{{ $cat->fine_pemanen_new }}" data-kerani="{{ $cat->fine_kerani_panen }}" data-mandor-panen="{{ $cat->fine_mandor_panen }}" data-mandor1="{{ $cat->fine_mandor_1 }}" data-asisten="{{ $cat->fine_asisten }}">
                        <input type="checkbox" name="modal_fine[]" value="{{ $cat->id }}" class="mt-1 fine-checkbox" data-cat-id="{{ $cat->id }}" onchange="updateFinePreview()">
                        <div class="flex-1">
                            <div class="flex items-center justify-between gap-2">
                                <p class="text-sm font-medium text-text-main">{{ $cat->code }}. {{ $cat->description }}</p>
                                @if($cat->code > 0)
                                <div class="flex items-center gap-2">
                                    <label class="text-xs text-text-secondary">Temuan:</label>
                                    <input type="number" class="fine-count w-16 h-8 px-2 rounded border border-surface-border text-sm text-center" data-cat-id="{{ $cat->id }}" value="1" min="1" onchange="updateFinePreview()">
                                </div>
                                @endif
                            </div>
                            @if($cat->code > 0)
                            <div class="flex flex-wrap gap-2 mt-2 text-xs">
                                <span class="px-2 py-0.5 rounded bg-red-100 text-red-700">Pemanen: Rp {{ number_format($cat->fine_pemanen_new) }}</span>
                                @if($cat->fine_kerani_panen > 0)<span class="px-2 py-0.5 rounded bg-yellow-100 text-yellow-700">Kerani: Rp {{ number_format($cat->fine_kerani_panen) }}</span>@endif
                                @if($cat->fine_mandor_panen > 0)<span class="px-2 py-0.5 rounded bg-blue-100 text-blue-700">Mandor P: Rp {{ number_format($cat->fine_mandor_panen) }}</span>@endif
                                @if($cat->fine_mandor_1 > 0)<span class="px-2 py-0.5 rounded bg-purple-100 text-purple-700">Mandor 1: Rp {{ number_format($cat->fine_mandor_1) }}</span>@endif
                                @if($cat->fine_asisten > 0)<span class="px-2 py-0.5 rounded bg-green-100 text-green-700">Asisten: Rp {{ number_format($cat->fine_asisten) }}</span>@endif
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-4 p-4 bg-gray-50 rounded-lg border" id="finePreview">
                    <p class="text-sm text-text-secondary">Pilih kategori denda untuk melihat preview total</p>
                </div>
            </div>
            <div class="flex justify-end gap-3 p-4 border-t border-surface-border">
                <button type="button" onclick="closeFineModal()" class="h-10 px-4 border border-surface-border rounded-lg text-sm font-medium">Batal</button>
                <button type="button" onclick="applyFine()" class="h-10 px-4 bg-primary text-white rounded-lg text-sm font-semibold">Terapkan Denda</button>
            </div>
        </div>
    </div>

    <script>
    let rowCount = {{ $ancak->rows->count() }};
    let currentRowIndex = 0;
    const selectedBlockId = {{ $ancak->block_id }};
    const fineCategories = @json($fineCategories);
    let rowFineData = {};
    
    // Initialize existing fine data
    @foreach($ancak->rows as $index => $row)
    @if($row->fine_pemanen > 0)
    rowFineData[{{ $index }}] = {
        details: [], // Will be populated when user edits
        pemanen: {{ $row->fine_pemanen ?? 0 }},
        kerani: {{ $row->fine_kerani_panen ?? 0 }},
        mandorPanen: {{ $row->fine_mandor_panen ?? 0 }},
        mandor1: {{ $row->fine_mandor_1 ?? 0 }},
        asisten: {{ $row->fine_asisten ?? 0 }}
    };
    @endif
    @endforeach
    
    function openFineModal(rowIndex) {
        currentRowIndex = rowIndex;
        
        // Reset all checkboxes and counts first
        document.querySelectorAll('.fine-checkbox').forEach(cb => cb.checked = false);
        document.querySelectorAll('.fine-count').forEach(input => input.value = 1);
        
        // Restore previous selections for this row if exists
        if (rowFineData[rowIndex] && rowFineData[rowIndex].details) {
            rowFineData[rowIndex].details.forEach(detail => {
                const checkbox = document.querySelector(`.fine-checkbox[data-cat-id="${detail.catId}"]`);
                if (checkbox) checkbox.checked = true;
                
                const countInput = document.querySelector(`.fine-count[data-cat-id="${detail.catId}"]`);
                if (countInput) countInput.value = detail.count;
            });
        }
        
        if (rowFineData[rowIndex] && rowFineData[rowIndex].hasNoFine) {
            const noFineCheckbox = document.querySelector('.fine-checkbox[data-cat-id="1"]');
            if (noFineCheckbox) noFineCheckbox.checked = true;
        }
        
        document.getElementById('fineModal').classList.remove('hidden');
        updateFinePreview();
    }
    
    function closeFineModal() {
        document.getElementById('fineModal').classList.add('hidden');
    }
    
    function updateFinePreview() {
        const preview = document.getElementById('finePreview');
        const selectedOptions = document.querySelectorAll('.fine-checkbox:checked');
        
        if (selectedOptions.length === 0) {
            preview.innerHTML = '<p class="text-sm text-text-secondary">Pilih kategori denda untuk melihat preview total</p>';
            return;
        }
        
        let totals = { pemanen: 0, kerani: 0, mandorPanen: 0, mandor1: 0, asisten: 0 };
        let details = [];
        
        selectedOptions.forEach(cb => {
            const option = cb.closest('.fine-option');
            const countInput = option.querySelector('.fine-count');
            const count = countInput ? parseInt(countInput.value) || 1 : 1;
            const code = option.dataset.code;
            const desc = option.dataset.desc;
            
            if (code == 0) { details.push(`<li class="text-green-600">✓ Tidak Ada Denda</li>`); return; }
            
            const pemanen = parseInt(option.dataset.pemanen) * count;
            totals.pemanen += pemanen;
            totals.kerani += parseInt(option.dataset.kerani) * count;
            totals.mandorPanen += parseInt(option.dataset.mandorPanen) * count;
            totals.mandor1 += parseInt(option.dataset.mandor1) * count;
            totals.asisten += parseInt(option.dataset.asisten) * count;
            
            details.push(`<li>${code}. ${desc} (${count}x) = <span class="text-red-600 font-medium">Rp ${pemanen.toLocaleString()}</span></li>`);
        });
        
        preview.innerHTML = `
            <p class="text-sm font-medium text-text-main mb-2">Detail Pelanggaran:</p>
            <ul class="text-sm space-y-1 mb-3">${details.join('')}</ul>
            <div class="grid grid-cols-5 gap-2 text-xs border-t pt-3">
                <div class="p-2 bg-red-100 rounded text-center"><p class="font-semibold text-red-700">Pemanen</p><p class="text-red-600">Rp ${totals.pemanen.toLocaleString()}</p></div>
                <div class="p-2 bg-yellow-100 rounded text-center"><p class="font-semibold text-yellow-700">Kerani</p><p class="text-yellow-600">Rp ${totals.kerani.toLocaleString()}</p></div>
                <div class="p-2 bg-blue-100 rounded text-center"><p class="font-semibold text-blue-700">Mandor P</p><p class="text-blue-600">Rp ${totals.mandorPanen.toLocaleString()}</p></div>
                <div class="p-2 bg-purple-100 rounded text-center"><p class="font-semibold text-purple-700">Mandor 1</p><p class="text-purple-600">Rp ${totals.mandor1.toLocaleString()}</p></div>
                <div class="p-2 bg-green-100 rounded text-center"><p class="font-semibold text-green-700">Asisten</p><p class="text-green-600">Rp ${totals.asisten.toLocaleString()}</p></div>
            </div>
        `;
    }
    
    function applyFine() {
        const selectedOptions = document.querySelectorAll('.fine-checkbox:checked');
        let totals = { pemanen: 0, kerani: 0, mandorPanen: 0, mandor1: 0, asisten: 0 };
        let fineDetails = [];
        let hasNoFine = false;
        
        selectedOptions.forEach(cb => {
            const option = cb.closest('.fine-option');
            const countInput = option.querySelector('.fine-count');
            const count = countInput ? parseInt(countInput.value) || 1 : 1;
            const code = parseInt(option.dataset.code);
            
            if (code === 0) { hasNoFine = true; return; }
            
            const catId = option.dataset.id;
            totals.pemanen += parseInt(option.dataset.pemanen) * count;
            totals.kerani += parseInt(option.dataset.kerani) * count;
            totals.mandorPanen += parseInt(option.dataset.mandorPanen) * count;
            totals.mandor1 += parseInt(option.dataset.mandor1) * count;
            totals.asisten += parseInt(option.dataset.asisten) * count;
            
            fineDetails.push({ catId, code, desc: option.dataset.desc, count });
        });
        
        document.getElementById(`fine_data_${currentRowIndex}`).value = JSON.stringify(fineDetails);
        document.getElementById(`fine_pemanen_${currentRowIndex}`).value = totals.pemanen;
        document.getElementById(`fine_amount_${currentRowIndex}`).value = totals.pemanen;
        
        rowFineData[currentRowIndex] = { details: fineDetails, hasNoFine: hasNoFine && fineDetails.length === 0, ...totals };
        
        const displayBtn = document.querySelector(`.fine-display-${currentRowIndex}`);
        if (hasNoFine && fineDetails.length === 0) displayBtn.textContent = 'Tidak Ada';
        else if (fineDetails.length > 0) displayBtn.textContent = `Rp ${totals.pemanen.toLocaleString()} (${fineDetails.length})`;
        else displayBtn.textContent = 'Pilih';
        
        updateTotalFines();
        closeFineModal();
    }
    
    function updateTotalFines() {
        let totals = { pemanen: 0, kerani: 0, mandorPanen: 0, mandor1: 0, asisten: 0 };
        Object.values(rowFineData).forEach(d => {
            totals.pemanen += d.pemanen || 0;
            totals.kerani += d.kerani || 0;
            totals.mandorPanen += d.mandorPanen || 0;
            totals.mandor1 += d.mandor1 || 0;
            totals.asisten += d.asisten || 0;
        });
        document.getElementById('totalFinePemanen').textContent = `Rp ${totals.pemanen.toLocaleString()}`;
        document.getElementById('totalFineKerani').textContent = `Rp ${totals.kerani.toLocaleString()}`;
        document.getElementById('totalFineMandorPanen').textContent = `Rp ${totals.mandorPanen.toLocaleString()}`;
        document.getElementById('totalFineMandor1').textContent = `Rp ${totals.mandor1.toLocaleString()}`;
        document.getElementById('totalFineAsisten').textContent = `Rp ${totals.asisten.toLocaleString()}`;
    }
    
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
            <td class="px-3 py-2"><select name="rows[${rowCount}][tph_status]" class="w-full h-9 px-2 rounded border border-surface-border text-sm"><option value="bersih">Bersih</option><option value="kotor">Kotor</option></select></td>
            <td class="px-3 py-2"><select name="rows[${rowCount}][apd_status]" class="w-full h-9 px-2 rounded border border-surface-border text-sm"><option value="lengkap">Lengkap</option><option value="boot">Boot</option><option value="helm">Helm</option></select></td>
            <td class="px-3 py-2">
                <button type="button" onclick="openFineModal(${rowCount})" class="w-full h-9 px-2 rounded border border-primary bg-primary/10 text-primary text-sm font-medium hover:bg-primary/20 flex items-center justify-center gap-1"><span class="material-symbols-outlined text-[16px]">add</span><span class="fine-display-${rowCount}">Pilih</span></button>
                <input type="hidden" name="rows[${rowCount}][fine_data]" id="fine_data_${rowCount}" value="">
                <input type="hidden" name="rows[${rowCount}][fine_pemanen]" id="fine_pemanen_${rowCount}" value="0">
                <input type="hidden" name="rows[${rowCount}][fine_amount]" id="fine_amount_${rowCount}" value="0">
            </td>
            <td class="px-3 py-2"><button type="button" onclick="removeRow(this)" class="p-1 text-red-400 hover:text-red-600"><span class="material-symbols-outlined text-[18px]">delete</span></button></td>
        `;
        tbody.appendChild(newRow);
        rowCount++;
        updateRowNumbers();
    }
    
    function removeRow(btn) {
        const tbody = document.getElementById('inspectionRows');
        if (tbody.children.length > 1) {
            const row = btn.closest('tr');
            delete rowFineData[parseInt(row.dataset.row)];
            row.remove();
            updateRowNumbers();
            updateTotalFines();
        }
    }
    
    function updateRowNumbers() {
        document.querySelectorAll('#inspectionRows tr').forEach((row, i) => row.querySelector('.row-number').textContent = i + 1);
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        const divisionSelect = document.getElementById('division_id');
        const blockSelect = document.getElementById('block_id');
        const luasInput = document.getElementById('luas_blok');
        
        function updateBlocks() {
            const opt = divisionSelect.options[divisionSelect.selectedIndex];
            const blocks = opt.dataset.blocks ? JSON.parse(opt.dataset.blocks) : [];
            blockSelect.innerHTML = '<option value="">Pilih Blok</option>';
            luasInput.value = '';
            blocks.forEach(b => {
                const o = document.createElement('option');
                o.value = b.id; o.textContent = b.code; o.dataset.area = b.area_hectares;
                if (b.id == selectedBlockId) o.selected = true;
                blockSelect.appendChild(o);
            });
            updateBlockInfo();
        }
        
        function updateBlockInfo() {
            const opt = blockSelect.options[blockSelect.selectedIndex];
            luasInput.value = opt && opt.value ? (opt.dataset.area || '') : '';
        }
        
        divisionSelect.addEventListener('change', updateBlocks);
        blockSelect.addEventListener('change', updateBlockInfo);
        if (divisionSelect.value) updateBlocks();
        
        document.getElementById('evidenceInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = e => { document.getElementById('imagePreview').src = e.target.result; document.getElementById('imagePreviewContainer').classList.remove('hidden'); };
                reader.readAsDataURL(file);
            }
        });
        
        updateTotalFines();
    });
    </script>
@endsection
