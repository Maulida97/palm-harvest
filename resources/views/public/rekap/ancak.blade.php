<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Kebersihan Ancak - PT Ichiko Agro</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    @include('public.rekap.styles')
</head>
<body>
    @include('public.rekap.navbar')
    
    <main class="main-content">
        <div class="container">
            <div class="page-header">
                <h1>Rekap Kebersihan Ancak</h1>
                <p>Data rekapitulasi inspeksi kebersihan ancak panen & TPH</p>
            </div>
            
            <!-- Filter -->
            <form class="filter-bar" method="GET">
                <input type="date" name="start_date" value="{{ request('start_date') }}">
                <input type="date" name="end_date" value="{{ request('end_date') }}">
                <button type="submit">
                    <span class="material-symbols-outlined">search</span>
                    Filter
                </button>
            </form>
            
            @if($inspections->count() > 0)
                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Divisi</th>
                                <th>Blok</th>
                                <th>Nama QC</th>
                                <th>Mandor</th>
                                <th>Jumlah Baris</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inspections as $inspection)
                                <tr>
                                    <td>{{ $inspection->inspection_date->format('d/m/Y') }}</td>
                                    <td>{{ $inspection->division->name ?? '-' }}</td>
                                    <td>{{ $inspection->block->name ?? '-' }}</td>
                                    <td>{{ $inspection->qc_name ?? '-' }}</td>
                                    <td>{{ $inspection->foreman_name ?? '-' }}</td>
                                    <td>{{ $inspection->rows->count() }}</td>
                                    <td>
                                        <a href="{{ route('public.rekap.ancak.show', $inspection) }}" class="view-btn">
                                            <span class="material-symbols-outlined">visibility</span>
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination">{{ $inspections->appends(request()->query())->links() }}</div>
            @else
                <div class="empty-state">
                    <span class="material-symbols-outlined">cleaning_services</span>
                    <h3>Tidak ada data inspeksi</h3>
                </div>
            @endif
        </div>
    </main>
    
    @include('public.rekap.footer')
</body>
</html>
