@extends('layouts.palm')

@section('title', 'Preview Internal Memo')

@php $pageTitle = 'Preview Internal Memo ' . ucfirst($type); @endphp

@section('content')
    <div class="max-w-4xl">
        <div class="mb-6">
            <a href="{{ route('admin.memo.index', $type) }}" class="text-primary hover:underline text-sm flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                Kembali ke Data Memo
            </a>
        </div>

        <!-- Memo Detail Card -->
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm mb-6">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h2 class="text-lg font-bold text-text-main">Detail Internal Memo</h2>
                    <p class="text-text-secondary text-sm mt-1">Kategori: {{ ucfirst($type) }}</p>
                </div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium {{ $memo->isActive() ? 'bg-[#e1f5d6] text-[#0c4e16]' : 'bg-red-50 text-red-700' }}">
                    <span class="w-1.5 h-1.5 rounded-full {{ $memo->isActive() ? 'bg-primary' : 'bg-red-500' }}"></span>
                    {{ $memo->isActive() ? 'Aktif' : 'Tidak Aktif' }}
                </span>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <p class="text-xs font-medium text-text-secondary uppercase mb-1">No Item</p>
                        <p class="text-text-main font-semibold">{{ $memo->no_item }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-text-secondary uppercase mb-1">Tanggal Berlaku</p>
                        <p class="text-text-main">{{ $memo->berlaku->format('d F Y') }}</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <p class="text-xs font-medium text-text-secondary uppercase mb-1">Tanggal Tidak Berlaku</p>
                        <p class="text-text-main">{{ $memo->tidak_berlaku ? $memo->tidak_berlaku->format('d F Y') : '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-text-secondary uppercase mb-1">Tanggal Revisi</p>
                        <p class="text-text-main">{{ $memo->tanggal_revisi ? $memo->tanggal_revisi->format('d F Y') : '-' }}</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 pt-4 border-t border-surface-border">
                <p class="text-xs text-text-secondary">
                    Dibuat oleh: {{ $memo->creator->name ?? 'Unknown' }} • 
                    {{ $memo->created_at->format('d/m/Y H:i') }}
                </p>
            </div>
        </div>

        <!-- PDF Preview Section -->
        @if($memo->file_path)
            <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-md font-bold text-text-main flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">picture_as_pdf</span>
                        Dokumen PDF
                    </h3>
                    <a href="{{ Storage::url($memo->file_path) }}" 
                       target="_blank"
                       download
                       class="flex items-center gap-2 h-9 px-4 bg-primary hover:bg-primary/90 text-white rounded-lg text-sm font-semibold transition-colors">
                        <span class="material-symbols-outlined text-[18px]">download</span>
                        Download PDF
                    </a>
                </div>
                
                <!-- PDF Embed -->
                <div class="bg-[#edf3e7] rounded-lg overflow-hidden">
                    <iframe 
                        src="{{ Storage::url($memo->file_path) }}" 
                        class="w-full h-[600px] md:h-[800px]"
                        title="PDF Preview">
                    </iframe>
                </div>
                
                <!-- Fallback message -->
                <p class="text-center text-text-secondary text-sm mt-4">
                    Jika PDF tidak tampil, 
                    <a href="{{ Storage::url($memo->file_path) }}" target="_blank" class="text-primary hover:underline">klik di sini untuk membuka di tab baru</a>.
                </p>
            </div>
        @else
            <div class="bg-white p-8 rounded-xl border border-surface-border shadow-sm text-center">
                <span class="material-symbols-outlined text-text-secondary text-5xl mb-3">description</span>
                <p class="text-text-secondary">Tidak ada file PDF yang dilampirkan.</p>
            </div>
        @endif
        
        <!-- Action Buttons -->
        <div class="mt-6 flex gap-3">
            <a href="{{ route('admin.memo.index', $type) }}" 
               class="h-10 px-6 border border-surface-border rounded-lg font-semibold text-text-main hover:bg-surface-light transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Kembali
            </a>
            <form action="{{ route('admin.memo.destroy', [$type, $memo]) }}" method="POST" 
                  onsubmit="return confirm('Yakin ingin menghapus memo ini?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="h-10 px-6 bg-red-500 hover:bg-red-600 text-white rounded-lg font-semibold transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">delete</span>
                    Hapus Memo
                </button>
            </form>
        </div>
    </div>
@endsection
