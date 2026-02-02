@extends('layouts.palm')

@section('title', 'Profil Saya')

@section('content')
    <div class="max-w-2xl">
        <div class="mb-6">
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="text-primary hover:underline text-sm flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                    Kembali ke Dashboard
                </a>
            @else
                <a href="{{ route('officer.dashboard') }}" class="text-primary hover:underline text-sm flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                    Kembali ke Dashboard
                </a>
            @endif
        </div>

        <!-- Profile Header -->
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm mb-6">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-primary/20 flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary text-3xl">person</span>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-text-main">{{ $user->name }}</h2>
                    <p class="text-text-secondary text-sm">{{ $user->email }}</p>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium mt-1 {{ $user->isAdmin() ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                        {{ $user->isAdmin() ? 'Administrator' : 'Petugas' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Update Profile Form -->
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm mb-6">
            <h3 class="text-lg font-bold text-text-main mb-4">Informasi Profil</h3>
            <p class="text-text-secondary text-sm mb-4">Perbarui nama dan informasi profil Anda.</p>
            
            <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                
                <div>
                    <label for="name" class="block text-sm font-medium text-text-main mb-1">Nama Lengkap</label>
                    <input type="text" name="name" id="name" required
                           value="{{ old('name', $user->name) }}"
                           class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-text-main mb-1">Email</label>
                    <input type="email" name="email" id="email" required
                           value="{{ old('email', $user->email) }}"
                           class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="phone" class="block text-sm font-medium text-text-main mb-1">Telepon</label>
                    <input type="text" name="phone" id="phone"
                           value="{{ old('phone', $user->phone) }}"
                           placeholder="08xxxxxxxxxx"
                           class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                </div>
                
                <div class="pt-2">
                    <button type="submit" class="h-10 px-6 bg-primary hover:bg-primary/90 text-white rounded-lg font-semibold transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Update Password Form -->
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
            <h3 class="text-lg font-bold text-text-main mb-4">Ubah Password</h3>
            <p class="text-text-secondary text-sm mb-4">Pastikan menggunakan password yang kuat dan unik.</p>
            
            <form action="{{ route('profile.password') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label for="current_password" class="block text-sm font-medium text-text-main mb-1">Password Saat Ini</label>
                    <input type="password" name="current_password" id="current_password" required
                           class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm @error('current_password') border-red-500 @enderror">
                    @error('current_password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-text-main mb-1">Password Baru</label>
                    <input type="password" name="password" id="password" required
                           class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-text-main mb-1">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                           class="w-full h-10 px-3 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                </div>
                
                <div class="pt-2">
                    <button type="submit" class="h-10 px-6 bg-primary hover:bg-primary/90 text-white rounded-lg font-semibold transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">lock</span>
                        Ubah Password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
