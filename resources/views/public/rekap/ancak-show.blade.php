<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kebersihan Ancak - PT Ichiko Agro</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    @include('public.rekap.styles')
    <style>
        .info-card { background: white; border-radius: 16px; padding: 1.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.08); margin-bottom: 1.5rem; }
        .info-card h3 { font-size: 1.1rem; font-weight: 600; color: #1a1a1a; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem; }
        .info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; }
        .info-item label { display: block; font-size: 0.7rem; text-transform: uppercase; color: #666; margin-bottom: 0.25rem; }
        .info-item span { font-size: 0.95rem; font-weight: 500; color: #1a1a1a; }
        
        .summary-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 1.5rem; }
        .summary-card { padding: 1rem; border-radius: 12px; text-align: center; }
        .summary-card.red { background: #fef2f2; border: 1px solid #fecaca; }
        .summary-card.yellow { background: #fefce8; border: 1px solid #fef08a; }
        .summary-card.blue { background: #eff6ff; border: 1px solid #bfdbfe; }
        .summary-card.purple { background: #faf5ff; border: 1px solid #e9d5ff; }
        .summary-card.green { background: #f0fdf4; border: 1px solid #bbf7d0; }
        .summary-card label { font-size: 0.7rem; text-transform: uppercase; font-weight: 500; }
        .summary-card.red label { color: #dc2626; }
        .summary-card.yellow label { color: #ca8a04; }
        .summary-card.blue label { color: #2563eb; }
        .summary-card.purple label { color: #9333ea; }
        .summary-card.green label { color: #16a34a; }
        .summary-card .amount { font-size: 1.25rem; font-weight: 700; margin-top: 0.25rem; }
        .summary-card.red .amount { color: #b91c1c; }
        .summary-card.yellow .amount { color: #a16207; }
        .summary-card.blue .amount { color: #1d4ed8; }
        .summary-card.purple .amount { color: #7e22ce; }
        .summary-card.green .amount { color: #15803d; }
        
        .back-btn { display: inline-flex; align-items: center; gap: 0.5rem; padding: 10px 16px; background: white; border: 1px solid #ddd; border-radius: 8px; color: #555; font-size: 0.9rem; text-decoration: none; transition: all 0.2s; margin-bottom: 1.5rem; }
        .back-btn:hover { background: #f5f5f5; }
        
        .status-bersih { background: #dcfce7; color: #166534; padding: 2px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 500; }
        .status-kotor { background: #fee2e2; color: #991b1b; padding: 2px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 500; }
        .status-lengkap { background: #dcfce7; color: #166534; padding: 2px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 500; }
        .fine-tag { display: inline-block; background: #fef2f2; color: #991b1b; padding: 2px 6px; border-radius: 4px; font-size: 0.7rem; margin: 2px; }
    </style>
</head>
<body>
    @include('public.rekap.navbar')
    
    <main class="main-content">
        <div class="container">
            <a href="{{ route('public.rekap.ancak') }}" class="back-btn">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali ke Daftar
            </a>
            
            <div class="page-header">
                <h1>Detail Inspeksi Kebersihan Ancak</h1>
                <p>{{ $ancak->inspection_date->format('d F Y') }}</p>
            </div>
            
            <!-- Info Card -->
            <div class="info-card">
                <h3><span class="material-symbols-outlined">info</span> Informasi Inspeksi</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Nama QC</label>
                        <span>{{ $ancak->qc_name ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <label>Divisi</label>
                        <span>{{ $ancak->division->name ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <label>Blok</label>
                        <span>{{ $ancak->block->code ?? $ancak->block->name ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <label>Tahun Tanam</label>
                        <span>{{ $ancak->planting_year ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <label>Jenis Bibit</label>
                        <span>{{ $ancak->seed_type ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <label>SPH</label>
                        <span>{{ $ancak->sph ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <label>Mandor Panen</label>
                        <span>{{ $ancak->foreman_name ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <label>Kerani Panen</label>
                        <span>{{ $ancak->clerk_name ?? '-' }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Summary Card -->
            <div class="info-card">
                <h3><span class="material-symbols-outlined">payments</span> Ringkasan Denda per Role</h3>
                <div class="summary-grid">
                    <div class="summary-card red">
                        <label>Denda Pemanen</label>
                        <div class="amount">Rp {{ number_format($ancak->rows->sum('fine_pemanen'), 0, ',', '.') }}</div>
                    </div>
                    <div class="summary-card yellow">
                        <label>Denda Kerani Panen</label>
                        <div class="amount">Rp {{ number_format($ancak->rows->sum('fine_kerani_panen'), 0, ',', '.') }}</div>
                    </div>
                    <div class="summary-card blue">
                        <label>Denda Mandor Panen</label>
                        <div class="amount">Rp {{ number_format($ancak->rows->sum('fine_mandor_panen'), 0, ',', '.') }}</div>
                    </div>
                    <div class="summary-card purple">
                        <label>Denda Mandor 1</label>
                        <div class="amount">Rp {{ number_format($ancak->rows->sum('fine_mandor_1'), 0, ',', '.') }}</div>
                    </div>
                    <div class="summary-card green">
                        <label>Denda Asisten</label>
                        <div class="amount">Rp {{ number_format($ancak->rows->sum('fine_asisten'), 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
            
            <!-- Detail Table -->
            <div class="info-card">
                <h3><span class="material-symbols-outlined">table_chart</span> Detail Inspeksi Pemanen</h3>
                @if($ancak->rows->count() > 0)
                    <div class="table-wrapper" style="margin: 0 -1.5rem -1.5rem; border-radius: 0 0 16px 16px;">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pemanen</th>
                                    <th>Ancak</th>
                                    <th>TT</th>
                                    <th>BT</th>
                                    <th>TPH</th>
                                    <th>APD</th>
                                    <th>Jenis Denda</th>
                                    <th style="text-align: right">Pemanen</th>
                                    <th style="text-align: right">Kerani</th>
                                    <th style="text-align: right">Mandor P</th>
                                    <th style="text-align: right">Mandor 1</th>
                                    <th style="text-align: right">Asisten</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ancak->rows as $row)
                                    <tr>
                                        <td>{{ $row->row_number }}</td>
                                        <td style="font-weight: 500">{{ $row->harvester_name ?? '-' }}</td>
                                        <td>{{ $row->ancak_location ?? '-' }}</td>
                                        <td>{{ $row->bunch_count }}</td>
                                        <td>{{ $row->bt_pkk }}</td>
                                        <td>
                                            @if(($row->tph_status ?? 'bersih') === 'bersih')
                                                <span class="status-bersih">Bersih</span>
                                            @else
                                                <span class="status-kotor">Kotor</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->apd_status === 'lengkap')
                                                <span class="status-lengkap">Lengkap</span>
                                            @else
                                                <span>{{ ucfirst($row->apd_status ?? '-') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->fine_data)
                                                @php
                                                    $fineData = is_string($row->fine_data) ? json_decode($row->fine_data, true) : $row->fine_data;
                                                @endphp
                                                @if(!empty($fineData))
                                                    @foreach($fineData as $fine)
                                                        <span class="fine-tag">{{ $fine['code'] ?? '' }}. {{ $fine['desc'] ?? '' }} ({{ $fine['count'] ?? 1 }}x)</span>
                                                    @endforeach
                                                @else
                                                    <span style="color: #16a34a">Tidak Ada</span>
                                                @endif
                                            @elseif($row->fine_pemanen > 0)
                                                <span class="fine-tag">Ada Denda</span>
                                            @else
                                                <span style="color: #16a34a">Tidak Ada</span>
                                            @endif
                                        </td>
                                        <td style="text-align: right; {{ $row->fine_pemanen > 0 ? 'color: #dc2626; font-weight: 500' : '' }}">{{ number_format($row->fine_pemanen ?? 0, 0, ',', '.') }}</td>
                                        <td style="text-align: right; {{ $row->fine_kerani_panen > 0 ? 'color: #ca8a04; font-weight: 500' : '' }}">{{ number_format($row->fine_kerani_panen ?? 0, 0, ',', '.') }}</td>
                                        <td style="text-align: right; {{ $row->fine_mandor_panen > 0 ? 'color: #2563eb; font-weight: 500' : '' }}">{{ number_format($row->fine_mandor_panen ?? 0, 0, ',', '.') }}</td>
                                        <td style="text-align: right; {{ $row->fine_mandor_1 > 0 ? 'color: #9333ea; font-weight: 500' : '' }}">{{ number_format($row->fine_mandor_1 ?? 0, 0, ',', '.') }}</td>
                                        <td style="text-align: right; {{ $row->fine_asisten > 0 ? 'color: #16a34a; font-weight: 500' : '' }}">{{ number_format($row->fine_asisten ?? 0, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot style="background: #f0fdf4;">
                                <tr>
                                    <td colspan="8" style="text-align: right; font-weight: 600">Total Denda:</td>
                                    <td style="text-align: right; font-weight: 700; color: #b91c1c">Rp {{ number_format($ancak->rows->sum('fine_pemanen'), 0, ',', '.') }}</td>
                                    <td style="text-align: right; font-weight: 700; color: #a16207">Rp {{ number_format($ancak->rows->sum('fine_kerani_panen'), 0, ',', '.') }}</td>
                                    <td style="text-align: right; font-weight: 700; color: #1d4ed8">Rp {{ number_format($ancak->rows->sum('fine_mandor_panen'), 0, ',', '.') }}</td>
                                    <td style="text-align: right; font-weight: 700; color: #7e22ce">Rp {{ number_format($ancak->rows->sum('fine_mandor_1'), 0, ',', '.') }}</td>
                                    <td style="text-align: right; font-weight: 700; color: #15803d">Rp {{ number_format($ancak->rows->sum('fine_asisten'), 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @else
                    <div class="empty-state" style="padding: 2rem;">
                        <span class="material-symbols-outlined">table_chart</span>
                        <h3>Tidak ada data inspeksi</h3>
                    </div>
                @endif
            </div>
            
            <!-- Findings & Response -->
            @if($ancak->findings || $ancak->response)
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                <div class="info-card">
                    <h3><span class="material-symbols-outlined">search</span> Temuan (Findings)</h3>
                    <p style="color: #555; white-space: pre-line;">{{ $ancak->findings ?: 'Tidak ada temuan.' }}</p>
                </div>
                <div class="info-card">
                    <h3><span class="material-symbols-outlined">check_box</span> Tanggapan (Response)</h3>
                    <p style="color: #555; white-space: pre-line;">{{ $ancak->response ?: 'Belum ada tanggapan.' }}</p>
                    @if($ancak->target_completion)
                        <p style="margin-top: 1rem; font-size: 0.85rem; color: #666;">
                            <strong>Target Completion:</strong> {{ $ancak->target_completion->format('d F Y') }}
                        </p>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </main>
    
    @include('public.rekap.footer')
</body>
</html>
