@extends('layouts.palm')

@section('title', 'Detail Anggota QC')

@php $pageTitle = 'Detail Anggota QC'; @endphp

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.officers.index') }}" class="text-primary hover:underline text-sm flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">arrow_back</span>
            Kembali ke Daftar Anggota QC
        </a>
    </div>

    <div class="max-w-2xl">
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
            <div class="flex flex-col items-center text-center mb-6">
                @if($officer->profile_photo)
                    <img src="{{ asset('storage/' . $officer->profile_photo) }}" 
                         alt="{{ $officer->name }}" 
                         class="w-24 h-24 rounded-full object-cover border-2 border-primary/20 mb-4">
                @else
                    <div class="w-24 h-24 rounded-full bg-primary/20 flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-primary text-4xl">person</span>
                    </div>
                @endif
                <h2 class="text-lg font-bold text-text-main">{{ $officer->name }}</h2>
                <p class="text-text-secondary text-sm flex items-center gap-1 mt-1">
                    <span class="material-symbols-outlined text-[14px]">alternate_email</span>
                    {{ $officer->username ?? '-' }}
                </p>
            </div>
            <dl class="space-y-3">
                <div><dt class="text-xs text-text-secondary">Username</dt><dd class="text-text-main font-medium">{{ $officer->username ?? '-' }}</dd></div>
                <div><dt class="text-xs text-text-secondary">Jabatan</dt><dd class="text-text-main font-medium">{{ $officer->jabatan ?? '-' }}</dd></div>
                <div><dt class="text-xs text-text-secondary">Bergabung</dt><dd class="text-text-main">{{ $officer->created_at->format('d M Y') }}</dd></div>
            </dl>
            <div class="mt-6 pt-4 border-t border-surface-border">
                <a href="{{ route('admin.officers.edit', $officer) }}" class="w-full h-10 bg-primary hover:bg-primary/90 text-white rounded-lg font-semibold transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">edit</span>
                    Edit Anggota QC
                </a>
            </div>
        </div>
    </div>
@endsection
