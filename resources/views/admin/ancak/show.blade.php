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
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-text-main">Informasi Inspeksi</h3>
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

    <!-- Ringkasan Denda per Role -->
    <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm mb-6">
        <h3 class="text-lg font-semibold text-text-main mb-4">Ringkasan Denda per Role</h3>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <div class="bg-red-50 p-4 rounded-lg border border-red-200">
                <p class="text-xs text-red-600 uppercase font-medium mb-1">Denda Pemanen</p>
                <p class="text-lg font-bold text-red-700">Rp {{ number_format($ancak->rows->sum('fine_pemanen')) }}</p>
            </div>
            <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                <p class="text-xs text-yellow-600 uppercase font-medium mb-1">Denda Kerani Panen</p>
                <p class="text-lg font-bold text-yellow-700">Rp {{ number_format($ancak->rows->sum('fine_kerani_panen')) }}</p>
            </div>
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                <p class="text-xs text-blue-600 uppercase font-medium mb-1">Denda Mandor Panen</p>
                <p class="text-lg font-bold text-blue-700">Rp {{ number_format($ancak->rows->sum('fine_mandor_panen')) }}</p>
            </div>
            <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                <p class="text-xs text-purple-600 uppercase font-medium mb-1">Denda Mandor 1</p>
                <p class="text-lg font-bold text-purple-700">Rp {{ number_format($ancak->rows->sum('fine_mandor_1')) }}</p>
            </div>
            <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                <p class="text-xs text-green-600 uppercase font-medium mb-1">Denda Asisten</p>
                <p class="text-lg font-bold text-green-700">Rp {{ number_format($ancak->rows->sum('fine_asisten')) }}</p>
            </div>
        </div>
    </div>

    <!-- Inspection Rows Table -->
    <div class="bg-white p-6 rounded-xl border border-surface-border shadow-sm mb-6">
        <h3 class="text-lg font-semibold text-text-main mb-4">Detail Inspeksi Pemanen</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm min-w-[1200px]">
                <thead class="bg-[#edf3e7] border-b border-surface-border">
                    <tr>
                        <th class="px-3 py-3 font-semibold text-text-secondary uppercase text-xs">No</th>
                        <th class="px-3 py-3 font-semibold text-text-secondary uppercase text-xs">Pemanen</th>
                        <th class="px-3 py-3 font-semibold text-text-secondary uppercase text-xs">Ancak</th>
                        <th class="px-3 py-3 font-semibold text-text-secondary uppercase text-xs">TT</th>
                        <th class="px-3 py-3 font-semibold text-text-secondary uppercase text-xs">BT</th>
                        <th class="px-3 py-3 font-semibold text-text-secondary uppercase text-xs">TPH</th>
                        <th class="px-3 py-3 font-semibold text-text-secondary uppercase text-xs">APD</th>
                        <th class="px-3 py-3 font-semibold text-text-secondary uppercase text-xs">Jenis Denda</th>
                        <th class="px-3 py-3 font-semibold text-text-secondary uppercase text-xs text-right">Pemanen</th>
                        <th class="px-3 py-3 font-semibold text-text-secondary uppercase text-xs text-right">Kerani</th>
                        <th class="px-3 py-3 font-semibold text-text-secondary uppercase text-xs text-right">Mandor P</th>
                        <th class="px-3 py-3 font-semibold text-text-secondary uppercase text-xs text-right">Mandor 1</th>
                        <th class="px-3 py-3 font-semibold text-text-secondary uppercase text-xs text-right">Asisten</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($ancak->rows as $row)
                        <tr>
                            <td class="px-3 py-3 text-text-main">{{ $row->row_number }}</td>
                            <td class="px-3 py-3 text-text-main font-medium">{{ $row->harvester_name ?? '-' }}</td>
                            <td class="px-3 py-3 text-text-main">{{ $row->ancak_location ?? '-' }}</td>
                            <td class="px-3 py-3 text-text-main">{{ $row->bunch_count }}</td>
                            <td class="px-3 py-3 text-text-main">{{ $row->bt_pkk }}</td>
                            <td class="px-3 py-3">
                                @if(($row->tph_status ?? 'bersih') === 'bersih')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-700">Bersih</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-700">Kotor</span>
                                @endif
                            </td>
                            <td class="px-3 py-3">
                                @if($row->apd_status === 'lengkap')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-700">Lengkap</span>
                                @elseif($row->apd_status === 'boot')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-700">Boot</span>
                                @elseif($row->apd_status === 'helm')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-700">Helm</span>
                                @endif
                            </td>
                            <td class="px-3 py-3 text-text-main text-xs">
                                @if($row->fine_data)
                                    @php
                                        $fineData = is_string($row->fine_data) ? json_decode($row->fine_data, true) : $row->fine_data;
                                    @endphp
                                    @if(!empty($fineData))
                                        <div class="space-y-1">
                                            @foreach($fineData as $fine)
                                                <div class="px-2 py-1 rounded bg-red-50 text-red-700">
                                                    {{ $fine['code'] ?? '' }}. {{ $fine['desc'] ?? '' }} ({{ $fine['count'] ?? 1 }}x)
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-green-600">Tidak Ada</span>
                                    @endif
                                @elseif($row->fine_pemanen > 0)
                                    <span class="px-2 py-1 rounded bg-red-50 text-red-700">Ada Denda</span>
                                @else
                                    <span class="text-green-600">Tidak Ada</span>
                                @endif
                            </td>
                            <td class="px-3 py-3 text-right {{ $row->fine_pemanen > 0 ? 'text-red-600 font-medium' : 'text-text-main' }}">
                                {{ number_format($row->fine_pemanen ?? 0) }}
                            </td>
                            <td class="px-3 py-3 text-right {{ $row->fine_kerani_panen > 0 ? 'text-yellow-600 font-medium' : 'text-text-main' }}">
                                {{ number_format($row->fine_kerani_panen ?? 0) }}
                            </td>
                            <td class="px-3 py-3 text-right {{ $row->fine_mandor_panen > 0 ? 'text-blue-600 font-medium' : 'text-text-main' }}">
                                {{ number_format($row->fine_mandor_panen ?? 0) }}
                            </td>
                            <td class="px-3 py-3 text-right {{ $row->fine_mandor_1 > 0 ? 'text-purple-600 font-medium' : 'text-text-main' }}">
                                {{ number_format($row->fine_mandor_1 ?? 0) }}
                            </td>
                            <td class="px-3 py-3 text-right {{ $row->fine_asisten > 0 ? 'text-green-600 font-medium' : 'text-text-main' }}">
                                {{ number_format($row->fine_asisten ?? 0) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13" class="px-4 py-8 text-center text-text-secondary">Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
                @if($ancak->rows->count() > 0)
                <tfoot class="bg-[#edf3e7]">
                    <tr>
                        <td colspan="8" class="px-3 py-3 font-semibold text-text-main text-right">Total Denda:</td>
                        <td class="px-3 py-3 font-semibold text-red-700 text-right">Rp {{ number_format($ancak->rows->sum('fine_pemanen')) }}</td>
                        <td class="px-3 py-3 font-semibold text-yellow-700 text-right">Rp {{ number_format($ancak->rows->sum('fine_kerani_panen')) }}</td>
                        <td class="px-3 py-3 font-semibold text-blue-700 text-right">Rp {{ number_format($ancak->rows->sum('fine_mandor_panen')) }}</td>
                        <td class="px-3 py-3 font-semibold text-purple-700 text-right">Rp {{ number_format($ancak->rows->sum('fine_mandor_1')) }}</td>
                        <td class="px-3 py-3 font-semibold text-green-700 text-right">Rp {{ number_format($ancak->rows->sum('fine_asisten')) }}</td>
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
