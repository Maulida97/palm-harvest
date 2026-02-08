@extends('layouts.palm')

@section('title', 'Detail BAP Material')

@php $pageTitle = 'BAP Material'; @endphp

@section('content')
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-bold text-text-main">Detail BAP Material</h2>
            <p class="text-text-secondary text-sm">{{ $bapMaterial->jenis_material }} - {{ $bapMaterial->inspection_date->format('d F Y') }}</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.bap-material.edit', $bapMaterial) }}" 
               class="flex items-center gap-2 h-10 px-4 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-sm font-semibold transition-colors">
                <span class="material-symbols-outlined text-[18px]">edit</span>
                Edit
            </a>
            <a href="{{ route('admin.bap-material.index') }}" 
               class="flex items-center gap-2 h-10 px-4 border border-surface-border rounded-lg text-sm font-medium">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Kembali
            </a>
        </div>
    </div>

    <!-- Info Card -->
    <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm mb-6">
        <h3 class="text-lg font-semibold text-text-main mb-4">Informasi Material</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div>
                <p class="text-xs text-text-secondary uppercase mb-1">Nama QC</p>
                <p class="font-semibold text-text-main">{{ $bapMaterial->qc_name }}</p>
            </div>
            <div>
                <p class="text-xs text-text-secondary uppercase mb-1">Jenis Material</p>
                <p class="font-semibold text-text-main">{{ $bapMaterial->jenis_material }}</p>
            </div>
            <div>
                <p class="text-xs text-text-secondary uppercase mb-1">Tanggal Inspeksi</p>
                <p class="font-semibold text-text-main">{{ $bapMaterial->inspection_date->format('d F Y') }}</p>
            </div>
            <div>
                <p class="text-xs text-text-secondary uppercase mb-1">Dimensi (P×L×T)</p>
                <p class="font-semibold text-text-main">
                    {{ $bapMaterial->panjang ?? '-' }} × {{ $bapMaterial->lebar ?? '-' }} × {{ $bapMaterial->tinggi ?? '-' }} cm
                </p>
            </div>
        </div>
        
        @if($bapMaterial->keterangan)
            <div class="mt-6 pt-4 border-t border-surface-border">
                <p class="text-xs text-text-secondary uppercase mb-1">Keterangan</p>
                <p class="text-text-main">{{ $bapMaterial->keterangan }}</p>
            </div>
        @endif
    </div>

    <!-- Foto Dokumentasi -->
    <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm mb-6">
        <h3 class="text-lg font-semibold text-text-main mb-4">
            <span class="material-symbols-outlined text-primary align-middle mr-1">photo_camera</span>
            Foto Dokumentasi 
            <span class="text-sm font-normal text-text-secondary">({{ $bapMaterial->dokumentasiPhotos->count() }} foto)</span>
        </h3>
        
        @if($bapMaterial->dokumentasiPhotos->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($bapMaterial->dokumentasiPhotos as $photo)
                    <a href="{{ asset('storage/' . $photo->photo_path) }}" target="_blank" class="block group">
                        <div class="relative overflow-hidden rounded-lg border-2 border-green-200">
                            <img src="{{ asset('storage/' . $photo->photo_path) }}" 
                                 alt="Foto Dokumentasi" 
                                 class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors flex items-center justify-center">
                                <span class="material-symbols-outlined text-white opacity-0 group-hover:opacity-100 transition-opacity text-[32px]">zoom_in</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-6 text-text-secondary bg-green-50 rounded-lg">
                <span class="material-symbols-outlined text-[36px] mb-1 text-green-300">image_not_supported</span>
                <p>Tidak ada foto dokumentasi.</p>
            </div>
        @endif
    </div>

    <!-- Foto Surat Jalan -->
    <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
        <h3 class="text-lg font-semibold text-text-main mb-4">
            <span class="material-symbols-outlined text-blue-500 align-middle mr-1">description</span>
            Foto Surat Jalan 
            <span class="text-sm font-normal text-text-secondary">({{ $bapMaterial->suratJalanPhotos->count() }} foto)</span>
        </h3>
        
        @if($bapMaterial->suratJalanPhotos->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($bapMaterial->suratJalanPhotos as $photo)
                    <a href="{{ asset('storage/' . $photo->photo_path) }}" target="_blank" class="block group">
                        <div class="relative overflow-hidden rounded-lg border-2 border-blue-200">
                            <img src="{{ asset('storage/' . $photo->photo_path) }}" 
                                 alt="Foto Surat Jalan" 
                                 class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors flex items-center justify-center">
                                <span class="material-symbols-outlined text-white opacity-0 group-hover:opacity-100 transition-opacity text-[32px]">zoom_in</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-6 text-text-secondary bg-blue-50 rounded-lg">
                <span class="material-symbols-outlined text-[36px] mb-1 text-blue-300">image_not_supported</span>
                <p>Tidak ada foto surat jalan.</p>
            </div>
        @endif
    </div>
@endsection
