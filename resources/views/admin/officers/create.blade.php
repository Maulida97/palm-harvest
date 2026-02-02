@extends('layouts.palm')

@section('title', 'Tambah Petugas')

@php $pageTitle = 'Tambah Petugas Baru'; @endphp

@section('content')
    <div class="max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('admin.officers.index') }}" class="text-primary hover:underline text-sm flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                Kembali ke Daftar Petugas
            </a>
        </div>

        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
            <h2 class="text-lg font-bold text-text-main mb-6">Form Tambah Petugas</h2>
            
            <form action="{{ route('admin.officers.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label for="name" class="block text-sm font-medium text-text-main mb-1">Nama Lengkap *</label>
                    <input type="text" name="name" id="name" required
                           value="{{ old('name') }}"
                           class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm @error('name') border-red-500 @enderror">
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-text-main mb-1">Email *</label>
                    <input type="email" name="email" id="email" required
                           value="{{ old('email') }}"
                           class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm @error('email') border-red-500 @enderror">
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="phone" class="block text-sm font-medium text-text-main mb-1">Telepon</label>
                    <input type="text" name="phone" id="phone"
                           value="{{ old('phone') }}"
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
@endsection
