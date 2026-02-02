@extends('layouts.palm')

@section('title', 'Detail Panen')

@php $pageTitle = 'Detail Panen #' . $harvest->id; @endphp

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.harvests.index') }}" class="text-primary hover:underline text-sm flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">arrow_back</span>
            Kembali ke Data Panen
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
            <h2 class="text-lg font-bold text-text-main mb-4">Informasi Panen</h2>
            <dl class="space-y-4">
                <div class="flex justify-between"><dt class="text-text-secondary">Blok</dt><dd class="font-semibold">{{ $harvest->block->code }} - {{ $harvest->block->name }}</dd></div>
                <div class="flex justify-between"><dt class="text-text-secondary">Berat</dt><dd class="font-bold text-xl text-primary">{{ number_format($harvest->weight_kg) }} Kg</dd></div>
                <div class="flex justify-between"><dt class="text-text-secondary">Tanggal</dt><dd>{{ $harvest->harvest_date->format('d M Y') }}</dd></div>
                <div class="flex justify-between">
                    <dt class="text-text-secondary">Status</dt>
                    <dd>
                        @if($harvest->isVerified())<span class="px-2.5 py-1 rounded-full text-xs font-medium bg-[#e1f5d6] text-[#0c4e16]">Verified</span>
                        @elseif($harvest->isPending())<span class="px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700">Pending</span>
                        @else<span class="px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700">Rejected</span>@endif
                    </dd>
                </div>
                @if($harvest->notes)
                    <div><dt class="text-text-secondary mb-1">Catatan</dt><dd class="text-sm bg-surface-light p-3 rounded">{{ $harvest->notes }}</dd></div>
                @endif
            </dl>
            
            @if($harvest->isPending())
                <div class="mt-6 pt-4 border-t border-surface-border flex gap-3">
                    <form action="{{ route('admin.harvests.verify', $harvest) }}" method="POST" class="flex-1">
                        @csrf
                        <input type="hidden" name="action" value="verify">
                        <button type="submit" class="w-full h-10 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">check_circle</span>
                            Verifikasi
                        </button>
                    </form>
                    <form action="{{ route('admin.harvests.verify', $harvest) }}" method="POST" class="flex-1">
                        @csrf
                        <input type="hidden" name="action" value="reject">
                        <button type="submit" class="w-full h-10 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">cancel</span>
                            Tolak
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <div class="space-y-6">
            <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
                <h2 class="text-lg font-bold text-text-main mb-4">Petugas</h2>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-primary/20 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary">person</span>
                    </div>
                    <div>
                        <p class="font-semibold text-text-main">{{ $harvest->officer->name }}</p>
                        <p class="text-sm text-text-secondary">{{ $harvest->officer->email }}</p>
                    </div>
                </div>
            </div>

            @if($harvest->verifier)
                <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
                    <h2 class="text-lg font-bold text-text-main mb-4">Diverifikasi Oleh</h2>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                            <span class="material-symbols-outlined text-green-600">verified_user</span>
                        </div>
                        <div>
                            <p class="font-semibold text-text-main">{{ $harvest->verifier->name }}</p>
                            <p class="text-sm text-text-secondary">{{ $harvest->verified_at?->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
