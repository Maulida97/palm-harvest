@extends('layouts.palm')

@section('title', 'Detail Kebersihan Ancak')

@php $pageTitle = 'Kebersihan Ancak Panen & TPH'; @endphp

@section('content')
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-text-main">Detail Inspeksi</h2>
            <p class="text-text-secondary text-sm">{{ $ancak->inspection_date->format('d F Y') }}</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.ancak.edit', $ancak) }}" 
               class="flex items-center gap-2 h-10 px-4 bg-primary hover:bg-primary/90 text-white rounded-lg text-sm font-semibold transition-colors">
                <span class="material-symbols-outlined text-[18px]">edit</span>
                Edit
            </a>
            <a href="{{ route('admin.ancak.index') }}" 
               class="h-10 px-4 border border-surface-border rounded-lg text-sm font-medium flex items-center">
                Kembali
            </a>
        </div>
    </div>

    <!-- Info Card -->
    <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm mb-6">
        <div class="flex justify-between items-start mb-4">
            <h3 class="text-lg font-semibold text-text-main">Informasi Inspeksi</h3>
            @if($ancak->isCompleted())
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium bg-[#e1f5d6] text-[#0c4e16]">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                    Selesai
                </span>
            @else
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700">
                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                    Pending
                </span>
            @endif
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            <div>
                <p class="text-xs text-text-secondary uppercase mb-1">Nama QC</p>
                <p class="text-sm font-medium text-text-main">{{ $ancak->qc_name }}</p>
            </div>
            <div>
                <p class="text-xs text-text-secondary uppercase mb-1">Divisi</p>
                <p class="text-sm font-medium text-text-main">{{ $ancak->division->name ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs text-text-secondary uppercase mb-1">Blok</p>
                <p class="text-sm font-medium text-text-main">{{ $ancak->block->code ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs text-text-secondary uppercase mb-1">Luas (Ha)</p>
                <p class="text-sm font-medium text-text-main">{{ $ancak->block->area_hectares ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs text-text-secondary uppercase mb-1">Tahun Tanam</p>
                <p class="text-sm font-medium text-text-main">{{ $ancak->planting_year ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs text-text-secondary uppercase mb-1">Jenis Bibit</p>
                <p class="text-sm font-medium text-text-main">{{ $ancak->seed_type ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs text-text-secondary uppercase mb-1">SPH</p>
                <p class="text-sm font-medium text-text-main">{{ $ancak->sph ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs text-text-secondary uppercase mb-1">Tanggal</p>
                <p class="text-sm font-medium text-text-main">{{ $ancak->inspection_date->format('d/m/Y') }}</p>
            </div>
            <div>
                <p class="text-xs text-text-secondary uppercase mb-1">Mandor Panen</p>
                <p class="text-sm font-medium text-text-main">{{ $ancak->foreman_name ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs text-text-secondary uppercase mb-1">Kerani Panen</p>
                <p class="text-sm font-medium text-text-main">{{ $ancak->clerk_name ?? '-' }}</p>
            </div>
        </div>
    </div>

    <!-- Inspection Rows Table -->
    <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm mb-6">
        <h3 class="text-lg font-semibold text-text-main mb-4">Detail Inspeksi Pemanen</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm min-w-[800px]">
                <thead class="bg-[#edf3e7] border-b border-surface-border">
                    <tr>
                        <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">No</th>
                        <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Pemanen</th>
                        <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">Ancak</th>
                        <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">TT (Tandan)</th>
                        <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">BT (PKK)</th>
                        <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">TPH</th>
                        <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs">APD</th>
                        <th class="px-4 py-3 font-semibold text-text-secondary uppercase text-xs text-right">Denda (Rp)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($ancak->rows as $row)
                        <tr>
                            <td class="px-4 py-3 text-text-main">{{ $row->row_number }}</td>
                            <td class="px-4 py-3 text-text-main font-medium">{{ $row->harvester_name ?? '-' }}</td>
                            <td class="px-4 py-3 text-text-main">{{ $row->ancak_location ?? '-' }}</td>
                            <td class="px-4 py-3 text-text-main">{{ $row->bunch_count }}</td>
                            <td class="px-4 py-3 text-text-main">{{ $row->bt_pkk }}</td>
                            <td class="px-4 py-3 text-text-main">{{ $row->tph_number ?? '-' }}</td>
                            <td class="px-4 py-3">
                                @if($row->apd_status === 'lengkap')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-700">Lengkap</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-700">Tidak Lengkap</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-text-main text-right">{{ number_format($row->fine_amount) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-8 text-center text-text-secondary">Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
                @if($ancak->rows->count() > 0)
                <tfoot class="bg-[#edf3e7]">
                    <tr>
                        <td colspan="7" class="px-4 py-3 font-semibold text-text-main text-right">Total Denda:</td>
                        <td class="px-4 py-3 font-semibold text-text-main text-right">Rp {{ number_format($ancak->rows->sum('fine_amount')) }}</td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>

    <!-- Findings & Response -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
            <h4 class="flex items-center gap-2 text-base font-semibold text-text-main mb-3">
                <span class="material-symbols-outlined text-[20px] text-text-secondary">search</span>
                Temuan (Findings)
            </h4>
            <p class="text-sm text-text-main whitespace-pre-line">{{ $ancak->findings ?: 'Tidak ada temuan.' }}</p>
            
            @if($ancak->evidence_path)
                <div class="mt-4 pt-4 border-t border-surface-border">
                    <p class="text-xs text-text-secondary mb-2">Evidence:</p>
                    <a href="{{ Storage::url($ancak->evidence_path) }}" target="_blank" 
                       class="inline-flex items-center gap-2 text-sm text-primary hover:underline">
                        <span class="material-symbols-outlined text-[18px]">attach_file</span>
                        {{ basename($ancak->evidence_path) }}
                    </a>
                </div>
            @endif
        </div>
        
        <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm">
            <h4 class="flex items-center gap-2 text-base font-semibold text-text-main mb-3">
                <span class="material-symbols-outlined text-[20px] text-text-secondary">check_box</span>
                Tanggapan (Response)
            </h4>
            <p class="text-sm text-text-main whitespace-pre-line">{{ $ancak->response ?: 'Belum ada tanggapan.' }}</p>
            
            @if($ancak->target_completion)
                <div class="mt-4 pt-4 border-t border-surface-border">
                    <p class="text-xs text-text-secondary">Target Completion:</p>
                    <p class="text-sm font-medium text-text-main">{{ $ancak->target_completion->format('d F Y') }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection
