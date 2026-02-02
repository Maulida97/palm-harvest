@extends('layouts.palm')

@section('title', 'Input Internal Memo ' . ucfirst($type))

@php $pageTitle = 'Input Internal Memo ' . ucfirst($type); @endphp

@section('content')
    <div class="max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('admin.memo.index', $type) }}" class="text-primary hover:underline text-sm flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                Kembali ke Data Memo
            </a>
        </div>

        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
            <h2 class="text-lg font-bold text-text-main mb-6">Form Input Internal Memo {{ ucfirst($type) }}</h2>
            
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <ul class="list-disc list-inside text-red-700 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('admin.memo.store', $type) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="space-y-4">
                    <!-- No Item -->
                    <div>
                        <label for="no_item" class="block text-sm font-medium text-text-main mb-1">No Item *</label>
                        <input type="text" name="no_item" id="no_item" required
                               value="{{ old('no_item') }}"
                               placeholder="Contoh: IM-AGR-001"
                               class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm bg-[#edf3e7] @error('no_item') border-red-500 @enderror">
                        @error('no_item')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    
                    <!-- Berlaku & Tidak Berlaku -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="berlaku" class="block text-sm font-medium text-text-main mb-1">Berlaku *</label>
                            <input type="date" name="berlaku" id="berlaku" required
                                   value="{{ old('berlaku', date('Y-m-d')) }}"
                                   class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm bg-[#edf3e7] @error('berlaku') border-red-500 @enderror">
                            @error('berlaku')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="tidak_berlaku" class="block text-sm font-medium text-text-main mb-1">Tidak Berlaku <span class="text-text-secondary text-xs">(Opsional)</span></label>
                            <input type="date" name="tidak_berlaku" id="tidak_berlaku"
                                   value="{{ old('tidak_berlaku') }}"
                                   class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm bg-[#edf3e7]">
                        </div>
                    </div>
                    
                    <!-- Tanggal Revisi -->
                    <div>
                        <label for="tanggal_revisi" class="block text-sm font-medium text-text-main mb-1">Tanggal Revisi <span class="text-text-secondary text-xs">(Opsional)</span></label>
                        <input type="date" name="tanggal_revisi" id="tanggal_revisi"
                               value="{{ old('tanggal_revisi') }}"
                               class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm bg-[#edf3e7]">
                    </div>
                    
                    <!-- Upload File PDF -->
                    <div>
                        <label for="file" class="block text-sm font-medium text-text-main mb-1">Upload File PDF *</label>
                        <div id="dropZone" class="border-2 border-dashed border-surface-border rounded-lg bg-[#edf3e7] p-6 flex flex-col items-center justify-center cursor-pointer hover:border-primary/50 transition-colors" onclick="document.getElementById('file').click()">
                            <span class="material-symbols-outlined text-text-secondary text-4xl mb-2">upload_file</span>
                            <p class="text-text-secondary text-sm text-center">Klik untuk upload atau drag & drop file PDF</p>
                            <p class="text-text-secondary text-xs mt-1">Maksimal 5MB</p>
                            <input type="file" name="file" id="file" accept=".pdf" class="hidden" required onchange="showFileName(this)">
                        </div>
                        <div id="fileInfo" class="hidden mt-2 p-3 bg-green-50 border border-green-200 rounded-lg flex items-center gap-2">
                            <span class="material-symbols-outlined text-green-600 text-[20px]">picture_as_pdf</span>
                            <span id="fileName" class="text-green-700 text-sm flex-1"></span>
                            <button type="button" onclick="clearFile()" class="text-red-500 hover:text-red-700">
                                <span class="material-symbols-outlined text-[18px]">close</span>
                            </button>
                        </div>
                        @error('file')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="mt-8 pt-6 border-t border-surface-border flex gap-3">
                    <button type="submit" 
                            class="h-10 px-6 bg-primary hover:bg-primary/90 text-white rounded-lg font-semibold transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Simpan Memo
                    </button>
                    <a href="{{ route('admin.memo.index', $type) }}" 
                       class="h-10 px-6 border border-surface-border rounded-lg font-semibold text-text-main hover:bg-surface-light transition-colors flex items-center gap-2">
                        Batalkan
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function showFileName(input) {
            if (input.files && input.files[0]) {
                document.getElementById('fileName').textContent = input.files[0].name;
                document.getElementById('fileInfo').classList.remove('hidden');
                document.getElementById('dropZone').classList.add('border-primary');
            }
        }
        
        function clearFile() {
            document.getElementById('file').value = '';
            document.getElementById('fileInfo').classList.add('hidden');
            document.getElementById('dropZone').classList.remove('border-primary');
        }
        
        // Drag and drop support
        const dropZone = document.getElementById('dropZone');
        
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight(e) {
            dropZone.classList.add('border-primary', 'bg-primary/5');
        }
        
        function unhighlight(e) {
            dropZone.classList.remove('border-primary', 'bg-primary/5');
        }
        
        dropZone.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length && files[0].type === 'application/pdf') {
                document.getElementById('file').files = files;
                showFileName(document.getElementById('file'));
            }
        }
    </script>
@endsection
