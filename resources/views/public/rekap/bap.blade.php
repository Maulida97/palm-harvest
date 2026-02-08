<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Input Panen - PT Ichiko Agro</title>
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
                <h1>Rekap Input Panen</h1>
                <p>Data rekapitulasi hasil panen</p>
            </div>
            
            <!-- Filter -->
            <form class="filter-bar" method="GET">
                <input type="date" name="start_date" value="{{ request('start_date') }}" placeholder="Dari Tanggal">
                <input type="date" name="end_date" value="{{ request('end_date') }}" placeholder="Sampai Tanggal">
                <select name="status">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Verified</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                <button type="submit">
                    <span class="material-symbols-outlined">search</span>
                    Filter
                </button>
            </form>
            
            @if($harvests->count() > 0)
                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>No. SPK</th>
                                <th>Blok</th>
                                <th>Berat (Kg)</th>
                                <th>Status</th>
                                <th>Petugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($harvests as $harvest)
                                <tr>
                                    <td>{{ $harvest->harvest_date->format('d/m/Y') }}</td>
                                    <td>{{ $harvest->no_spk ?? '-' }}</td>
                                    <td>{{ $harvest->block->name ?? '-' }}</td>
                                    <td>{{ number_format($harvest->weight_kg, 2, ',', '.') }}</td>
                                    <td>
                                        <span class="badge {{ $harvest->verification_status }}">
                                            {{ ucfirst($harvest->verification_status) }}
                                        </span>
                                    </td>
                                    <td>{{ $harvest->officer->name ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination">{{ $harvests->appends(request()->query())->links() }}</div>
            @else
                <div class="empty-state">
                    <span class="material-symbols-outlined">description</span>
                    <h3>Tidak ada data panen</h3>
                </div>
            @endif
        </div>
    </main>
    
    @include('public.rekap.footer')
</body>
</html>
