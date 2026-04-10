@extends('layouts.palm')

@section('title', 'Admin Dashboard')

@php $pageTitle = 'Dashboard'; @endphp

@section('content')
    <!-- Stats Cards Row 1 - Master Data -->
    <div class="mb-2">
        <h3 class="text-sm font-semibold text-text-secondary uppercase tracking-wider mb-3">Master Data</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Total Divisi -->
            <div class="bg-white border border-surface-border rounded-xl p-5 hover:shadow-md transition-shadow group">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-lg bg-[#edf3e7] flex items-center justify-center group-hover:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined text-primary text-[22px]">apartment</span>
                    </div>
                    <a href="{{ route('admin.blocks.index') }}" class="text-text-secondary hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>
                <p class="text-3xl font-bold text-text-main">{{ $totalDivisions }}</p>
                <p class="text-text-secondary text-sm mt-1">Total Divisi</p>
            </div>
            
            <!-- Total Blok -->
            <div class="bg-white border border-surface-border rounded-xl p-5 hover:shadow-md transition-shadow group">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-lg bg-[#edf3e7] flex items-center justify-center group-hover:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined text-primary text-[22px]">map</span>
                    </div>
                    <a href="{{ route('admin.blocks.index') }}" class="text-text-secondary hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>
                <p class="text-3xl font-bold text-text-main">{{ $totalBlocks }}</p>
                <p class="text-text-secondary text-sm mt-1">Total Blok <span class="text-primary font-medium">({{ $activeBlocks }} aktif)</span></p>
            </div>
            
            <!-- Total Pupuk -->
            <div class="bg-white border border-surface-border rounded-xl p-5 hover:shadow-md transition-shadow group">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-lg bg-[#edf3e7] flex items-center justify-center group-hover:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined text-primary text-[22px]">compost</span>
                    </div>
                    <a href="{{ route('admin.fertilizers.index') }}" class="text-text-secondary hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>
                <p class="text-3xl font-bold text-text-main">{{ $totalFertilizers }}</p>
                <p class="text-text-secondary text-sm mt-1">Jenis Pupuk</p>
            </div>
            
            <!-- Total Anggota QC -->
            <div class="bg-white border border-surface-border rounded-xl p-5 hover:shadow-md transition-shadow group">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-lg bg-[#edf3e7] flex items-center justify-center group-hover:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined text-primary text-[22px]">group</span>
                    </div>
                    <a href="{{ route('admin.officers.index') }}" class="text-text-secondary hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>
                <p class="text-3xl font-bold text-text-main">{{ $totalOfficers }}</p>
                <p class="text-text-secondary text-sm mt-1">Anggota QC</p>
            </div>
        </div>
    </div>

    <!-- Stats Cards Row 2 - Aktivitas -->
    <div class="mt-6">
        <h3 class="text-sm font-semibold text-text-secondary uppercase tracking-wider mb-3">Aktivitas</h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <!-- Total Kebersihan Ancak -->
            <div class="bg-white border border-surface-border rounded-xl p-5 hover:shadow-md transition-shadow group">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                        <span class="material-symbols-outlined text-blue-600 text-[22px]">cleaning_services</span>
                    </div>
                    <a href="{{ route('admin.ancak.index') }}" class="text-text-secondary hover:text-blue-600 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>
                <p class="text-3xl font-bold text-text-main">{{ $totalAncak }}</p>
                <p class="text-text-secondary text-sm mt-1">Inspeksi Ancak</p>
            </div>
            
            <!-- Total BAP Material -->
            <div class="bg-white border border-surface-border rounded-xl p-5 hover:shadow-md transition-shadow group">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-lg bg-orange-50 flex items-center justify-center group-hover:bg-orange-100 transition-colors">
                        <span class="material-symbols-outlined text-orange-600 text-[22px]">construction</span>
                    </div>
                    <a href="{{ route('admin.bap-material.index') }}" class="text-text-secondary hover:text-orange-600 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>
                <p class="text-3xl font-bold text-text-main">{{ $totalBapMaterial }}</p>
                <p class="text-text-secondary text-sm mt-1">BAP Material</p>
            </div>
            
            <!-- Total Internal Memo -->
            <div class="bg-white border border-surface-border rounded-xl p-5 hover:shadow-md transition-shadow group">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center group-hover:bg-purple-100 transition-colors">
                        <span class="material-symbols-outlined text-purple-600 text-[22px]">mail</span>
                    </div>
                    <a href="{{ route('admin.memo.index', 'agronomi') }}" class="text-text-secondary hover:text-purple-600 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>
                <p class="text-3xl font-bold text-text-main">{{ $totalMemos }}</p>
                <p class="text-text-secondary text-sm mt-1">Internal Memo</p>
            </div>
        </div>
    </div>
@endsection
