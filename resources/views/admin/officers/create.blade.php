@extends('layouts.palm')

@section('title', 'Tambah Anggota QC')

@php $pageTitle = 'Tambah Anggota QC'; @endphp

@section('content')
    <div class="max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('admin.officers.index') }}" class="text-primary hover:underline text-sm flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                Kembali ke Daftar Anggota QC
            </a>
        </div>

        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
            <h2 class="text-lg font-bold text-text-main mb-6">Form Tambah Anggota QC</h2>
            
            <form action="{{ route('admin.officers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- Foto Profil -->
                <div>
                    <label class="block text-sm font-medium text-text-main mb-2">Foto Profil <span class="text-text-secondary text-xs">(Opsional)</span></label>
                    <div class="flex items-center gap-4">
                        <div id="photo-preview" class="w-20 h-20 rounded-full bg-surface-light border-2 border-dashed border-surface-border flex items-center justify-center overflow-hidden">
                            <span class="material-symbols-outlined text-text-secondary text-[32px]" id="photo-placeholder">add_a_photo</span>
                        </div>
                        <div>
                            <label for="profile_photo" class="cursor-pointer inline-flex items-center gap-2 h-9 px-4 border border-surface-border rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                                <span class="material-symbols-outlined text-[16px]">upload</span>
                                Pilih Foto
                            </label>
                            <input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="hidden" onchange="previewPhoto(this)">
                            <p class="text-text-secondary text-xs mt-1">JPG, PNG, WEBP. Maks 2MB</p>
                            @error('profile_photo')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
                
                <div>
                    <label for="name" class="block text-sm font-medium text-text-main mb-1">Nama Lengkap *</label>
                    <input type="text" name="name" id="name" required
                           value="{{ old('name') }}"
                           class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm @error('name') border-red-500 @enderror">
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="username" class="block text-sm font-medium text-text-main mb-1">Username *</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-secondary text-[18px]">alternate_email</span>
                        <input type="text" name="username" id="username" required
                               value="{{ old('username') }}"
                               placeholder="contoh: budi_santoso"
                               class="w-full h-10 pl-10 pr-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm @error('username') border-red-500 @enderror">
                    </div>
                    <p class="text-text-secondary text-xs mt-1">Hanya huruf, angka, strip (-) dan underscore (_)</p>
                    @error('username')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="jabatan" class="block text-sm font-medium text-text-main mb-1">Jabatan <span class="text-text-secondary text-xs">(Opsional)</span></label>
                    <input type="text" name="jabatan" id="jabatan"
                           value="{{ old('jabatan') }}"
                           placeholder="Contoh: Ketua, Anggota, Koordinator"
                           class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-text-main mb-1">Password *</label>
                    <input type="password" name="password" id="password" required
                           class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm @error('password') border-red-500 @enderror">
                    @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-text-main mb-1">Konfirmasi Password *</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                           class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                </div>
                
                <div class="pt-4 flex gap-3">
                    <button type="submit" class="flex-1 h-10 bg-primary hover:bg-primary/90 text-white rounded-lg font-semibold transition-colors flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Simpan
                    </button>
                    <a href="{{ route('admin.officers.index') }}" class="flex-1 h-10 border border-surface-border rounded-lg font-semibold text-text-main hover:bg-surface-light transition-colors flex items-center justify-center">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewPhoto(input) {
            const preview = document.getElementById('photo-preview');
            const placeholder = document.getElementById('photo-placeholder');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    placeholder.style.display = 'none';
                    preview.innerHTML = '<img src="' + e.target.result + '" class="w-full h-full object-cover">';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
