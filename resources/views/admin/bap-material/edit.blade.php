@extends('layouts.palm')

@section('title', 'Edit BAP Material')

@php $pageTitle = 'BAP Material'; @endphp

@section('content')
    <form action="{{ route('admin.bap-material.update', $bapMaterial) }}" method="POST" enctype="multipart/form-data" id="bapMaterialForm">
        @csrf
        @method('PUT')
        <input type="hidden" name="delete_photos" id="deletePhotos" value="">
        
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm mb-6">
            <h3 class="text-lg font-semibold text-text-main mb-4">Edit Data Material</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                <!-- Nama QC -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">NAMA QC <span class="text-red-500">*</span></label>
                    <input type="text" name="qc_name" value="{{ old('qc_name', $bapMaterial->qc_name) }}" required
                           placeholder="Nama Pemeriksa"
                           class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm @error('qc_name') border-red-500 @enderror">
                    @error('qc_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Jenis Material -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">JENIS MATERIAL <span class="text-red-500">*</span></label>
                    <input type="text" name="jenis_material" value="{{ old('jenis_material', $bapMaterial->jenis_material) }}" required
                           placeholder="Cth: Besi, Pipa, dll"
                           class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm @error('jenis_material') border-red-500 @enderror">
                    @error('jenis_material') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Tanggal -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">TANGGAL <span class="text-red-500">*</span></label>
                    <input type="date" name="inspection_date" value="{{ old('inspection_date', $bapMaterial->inspection_date->format('Y-m-d')) }}" required
                           class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm @error('inspection_date') border-red-500 @enderror">
                    @error('inspection_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <!-- Panjang -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">PANJANG (CM)</label>
                    <input type="number" name="panjang" value="{{ old('panjang', $bapMaterial->panjang) }}" step="0.01" min="0"
                           placeholder="0.00"
                           class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                </div>
                
                <!-- Lebar -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">LEBAR (CM)</label>
                    <input type="number" name="lebar" value="{{ old('lebar', $bapMaterial->lebar) }}" step="0.01" min="0"
                           placeholder="0.00"
                           class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                </div>
                
                <!-- Tinggi -->
                <div>
                    <label class="block text-xs font-medium text-text-secondary mb-1">TINGGI (CM)</label>
                    <input type="number" name="tinggi" value="{{ old('tinggi', $bapMaterial->tinggi) }}" step="0.01" min="0"
                           placeholder="0.00"
                           class="w-full h-10 px-3 rounded-lg border border-surface-border text-sm">
                </div>
            </div>
            
            <!-- Keterangan -->
            <div class="mb-4">
                <label class="block text-xs font-medium text-text-secondary mb-1">KETERANGAN</label>
                <textarea name="keterangan" rows="3" 
                          placeholder="Catatan tambahan tentang material..."
                          class="w-full px-3 py-2 rounded-lg border border-surface-border text-sm resize-none">{{ old('keterangan', $bapMaterial->keterangan) }}</textarea>
            </div>
        </div>
        
        <!-- Foto Dokumentasi -->
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm mb-6">
            <h3 class="text-lg font-semibold text-text-main mb-4">
                <span class="material-symbols-outlined text-primary align-middle mr-1">photo_camera</span>
                Foto Dokumentasi
            </h3>
            
            @if($bapMaterial->dokumentasiPhotos->count() > 0)
                <div class="mb-4">
                    <p class="text-xs font-medium text-text-secondary mb-2">FOTO EXISTING</p>
                    <div id="existingDokumentasiPhotos" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
                        @foreach($bapMaterial->dokumentasiPhotos as $photo)
                            <div class="relative group" id="photo-{{ $photo->id }}">
                                <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Photo" class="w-full h-24 object-cover rounded-lg border border-green-200">
                                <button type="button" onclick="markPhotoForDelete({{ $photo->id }})"
                                        class="absolute top-1 right-1 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span class="material-symbols-outlined text-[14px]">close</span>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <div class="mb-4">
                <p class="text-xs font-medium text-text-secondary mb-2">TAMBAH FOTO DOKUMENTASI BARU</p>
                <div class="flex flex-col items-center justify-center w-full h-28 border-2 border-dashed border-green-300 bg-green-50 rounded-lg cursor-pointer hover:bg-green-100 transition-colors" 
                     onclick="document.getElementById('photoDokumentasiInput').click()">
                    <span class="material-symbols-outlined text-[32px] text-primary mb-1">add_photo_alternate</span>
                    <p class="text-sm text-text-main font-medium">Upload foto dokumentasi</p>
                    <p class="text-xs text-text-secondary/70">JPG, PNG (Max 5MB)</p>
                </div>
                <input type="file" name="photos_dokumentasi[]" id="photoDokumentasiInput" accept=".jpg,.jpeg,.png" multiple class="hidden" onchange="previewPhotos(this, 'dokumentasiPreview')">
            </div>
            
            <div id="dokumentasiPreview" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3"></div>
        </div>
        
        <!-- Foto Surat Jalan -->
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm mb-6">
            <h3 class="text-lg font-semibold text-text-main mb-4">
                <span class="material-symbols-outlined text-blue-500 align-middle mr-1">description</span>
                Foto Surat Jalan
            </h3>
            
            @if($bapMaterial->suratJalanPhotos->count() > 0)
                <div class="mb-4">
                    <p class="text-xs font-medium text-text-secondary mb-2">FOTO EXISTING</p>
                    <div id="existingSuratJalanPhotos" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
                        @foreach($bapMaterial->suratJalanPhotos as $photo)
                            <div class="relative group" id="photo-{{ $photo->id }}">
                                <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Photo" class="w-full h-24 object-cover rounded-lg border border-blue-200">
                                <button type="button" onclick="markPhotoForDelete({{ $photo->id }})"
                                        class="absolute top-1 right-1 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span class="material-symbols-outlined text-[14px]">close</span>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <div class="mb-4">
                <p class="text-xs font-medium text-text-secondary mb-2">TAMBAH FOTO SURAT JALAN BARU</p>
                <div class="flex flex-col items-center justify-center w-full h-28 border-2 border-dashed border-blue-300 bg-blue-50 rounded-lg cursor-pointer hover:bg-blue-100 transition-colors" 
                     onclick="document.getElementById('photoSuratJalanInput').click()">
                    <span class="material-symbols-outlined text-[32px] text-blue-500 mb-1">upload_file</span>
                    <p class="text-sm text-text-main font-medium">Upload foto surat jalan</p>
                    <p class="text-xs text-text-secondary/70">JPG, PNG (Max 5MB)</p>
                </div>
                <input type="file" name="photos_surat_jalan[]" id="photoSuratJalanInput" accept=".jpg,.jpeg,.png" multiple class="hidden" onchange="previewPhotos(this, 'suratJalanPreview')">
            </div>
            
            <div id="suratJalanPreview" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3"></div>
        </div>
        
        <!-- Submit Button -->
        <div class="flex justify-center gap-4">
            <a href="{{ route('admin.bap-material.index') }}" 
               class="h-12 px-8 border border-surface-border rounded-full text-sm font-semibold flex items-center">
                Batal
            </a>
            <button type="submit" 
                    class="flex items-center gap-2 h-12 px-8 bg-[#1a3636] hover:bg-[#1a3636]/90 text-white rounded-full text-sm font-semibold transition-colors">
                Update Data
                <span class="material-symbols-outlined text-[18px]">save</span>
            </button>
        </div>
    </form>

    <script>
    let deletePhotoIds = [];

    function markPhotoForDelete(photoId) {
        if (!deletePhotoIds.includes(photoId)) {
            deletePhotoIds.push(photoId);
        }
        document.getElementById('deletePhotos').value = deletePhotoIds.join(',');
        document.getElementById('photo-' + photoId).style.display = 'none';
    }

    function previewPhotos(input, containerId) {
        const container = document.getElementById(containerId);
        container.innerHTML = '';
        
        if (input.files) {
            Array.from(input.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative group';
                    div.innerHTML = `
                        <img src="${e.target.result}" alt="Preview ${index + 1}" class="w-full h-24 object-cover rounded-lg border border-surface-border">
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                            <span class="text-white text-xs text-center px-1">${file.name}</span>
                        </div>
                    `;
                    container.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }
    }
    </script>
@endsection
