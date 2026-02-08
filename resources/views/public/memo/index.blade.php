<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internal Memo - PT Ichiko Agro</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; color: #1a1a1a; line-height: 1.6; background: #f8faf9; min-height: 100vh; }
        
        .navbar { position: fixed; top: 0; left: 0; right: 0; z-index: 100; background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); padding: 0 5%; }
        .navbar-inner { max-width: 1200px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; height: 70px; }
        .logo { display: flex; align-items: center; gap: 10px; font-weight: 700; font-size: 1.25rem; color: #0d7c3d; text-decoration: none; }
        .logo-icon { width: 40px; height: 40px; background: linear-gradient(135deg, #0d7c3d, #15a050); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; }
        .nav-links { display: flex; align-items: center; gap: 2rem; list-style: none; }
        .nav-links a { text-decoration: none; color: #555; font-size: 0.9rem; font-weight: 500; transition: color 0.3s; }
        .nav-links a:hover, .nav-links a.active { color: #0d7c3d; }
        .btn-login { background: #0d7c3d; color: white; padding: 10px 24px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: background 0.3s; }
        .btn-login:hover { background: #0a6331; }
        
        .nav-dropdown { position: relative; }
        .nav-dropdown > a { display: flex; align-items: center; gap: 4px; }
        .nav-dropdown > a .material-symbols-outlined { font-size: 18px; transition: transform 0.3s; }
        .nav-dropdown:hover > a .material-symbols-outlined { transform: rotate(180deg); }
        .dropdown-menu { position: absolute; top: 100%; left: 50%; transform: translateX(-50%); background: white; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.15); min-width: 200px; padding: 8px 0; opacity: 0; visibility: hidden; transition: all 0.3s; z-index: 100; margin-top: 10px; }
        .nav-dropdown:hover .dropdown-menu { opacity: 1; visibility: visible; margin-top: 0; }
        .dropdown-menu a { display: flex; align-items: center; gap: 10px; padding: 12px 16px; color: #333 !important; font-size: 0.85rem; transition: background 0.2s; }
        .dropdown-menu a:hover { background: #f0fdf4; color: #0d7c3d !important; }
        .dropdown-menu a .material-symbols-outlined { font-size: 20px; color: #0d7c3d; }
        
        .main-content { padding-top: 100px; padding-bottom: 60px; min-height: calc(100vh - 200px); }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 5%; }
        .page-header { margin-bottom: 2rem; }
        .page-header h1 { font-size: 2rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem; }
        .page-header p { color: #666; }
        
        .filter-bar { display: flex; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap; }
        .filter-bar input, .filter-bar select { padding: 10px 16px; border: 1px solid #ddd; border-radius: 8px; font-size: 0.9rem; background: white; }
        .filter-bar input { flex: 1; min-width: 250px; }
        .filter-bar button { padding: 10px 20px; background: #0d7c3d; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: background 0.3s; }
        .filter-bar button:hover { background: #0a6331; }
        
        .memo-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 1.5rem; }
        .memo-card { background: white; border-radius: 16px; padding: 1.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.08); transition: transform 0.3s, box-shadow 0.3s; text-decoration: none; color: inherit; display: block; }
        .memo-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.12); }
        .memo-type { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; margin-bottom: 1rem; }
        .memo-type.agronomi { background: #e1f5d6; color: #0c4e16; }
        .memo-type.pabrik { background: #fff3cd; color: #856404; }
        .memo-number { font-size: 1rem; font-weight: 600; color: #1a1a1a; margin-bottom: 0.75rem; }
        .memo-date { display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: #666; }
        .memo-date .material-symbols-outlined { font-size: 18px; }
        .memo-status { display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 12px; font-size: 0.75rem; font-weight: 500; margin-top: 0.75rem; }
        .memo-status.active { background: #e1f5d6; color: #0c4e16; }
        .memo-status.expired { background: #fee2e2; color: #991b1b; }
        
        .empty-state { text-align: center; padding: 4rem 2rem; background: white; border-radius: 16px; }
        .empty-state .material-symbols-outlined { font-size: 64px; color: #ccc; margin-bottom: 1rem; }
        .empty-state h3 { font-size: 1.25rem; color: #666; margin-bottom: 0.5rem; }
        .empty-state p { color: #888; }
        
        .pagination { display: flex; justify-content: center; gap: 0.5rem; margin-top: 2rem; }
        .pagination a, .pagination span { padding: 8px 14px; border-radius: 8px; text-decoration: none; font-size: 0.9rem; }
        .pagination a { background: white; color: #555; border: 1px solid #ddd; }
        .pagination a:hover { background: #0d7c3d; color: white; border-color: #0d7c3d; }
        
        .footer { background: #1a1a1a; color: white; padding: 30px 5%; text-align: center; }
        .footer p { color: #888; font-size: 0.9rem; }
        
        .mobile-menu-btn { display: none; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #333; }
        @media (max-width: 768px) {
            .nav-links { display: none; }
            .mobile-menu-btn { display: block; }
            .memo-grid { grid-template-columns: 1fr; }
            .filter-bar { flex-direction: column; }
            .filter-bar input { min-width: 100%; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-inner">
            <a href="{{ url('/') }}" class="logo">
                <div class="logo-icon"><span class="material-symbols-outlined">eco</span></div>
                PT ICHIKO AGRO
            </a>
            <ul class="nav-links">
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li><a href="{{ url('/#tentang') }}">Tentang Kami</a></li>
                <li><a href="{{ url('/#layanan') }}">Produk & Layanan</a></li>
                <li><a href="{{ url('/#keunggulan') }}">Keunggulan</a></li>
                <li><a href="{{ url('/#sertifikasi') }}">Sertifikasi</a></li>
                <li><a href="{{ route('public.memo.index') }}" class="active">Memo</a></li>
                <li class="nav-dropdown">
                    <a href="#">
                        Rekap
                        <span class="material-symbols-outlined">expand_more</span>
                    </a>
                    <div class="dropdown-menu">
                        <a href="{{ route('public.rekap.bap') }}">
                            <span class="material-symbols-outlined">assignment</span>
                            Input BAP & Hold
                        </a>
                        <a href="{{ route('public.rekap.ancak') }}">
                            <span class="material-symbols-outlined">cleaning_services</span>
                            Kebersihan Ancak
                        </a>
                        <a href="{{ route('public.rekap.bap-material') }}">
                            <span class="material-symbols-outlined">inventory_2</span>
                            BAP Material
                        </a>
                    </div>
                </li>
            </ul>
            <a href="{{ route('login') }}" class="btn-login">Login</a>
            <button class="mobile-menu-btn"><span class="material-symbols-outlined">menu</span></button>
        </div>
    </nav>
    
    <main class="main-content">
        <div class="container">
            <div class="page-header">
                <h1>Internal Memo</h1>
                <p>Daftar memo internal dari departemen Agronomi dan Pabrik</p>
            </div>
            
            <form class="filter-bar" method="GET">
                <input type="text" name="search" placeholder="Cari nomor item..." value="{{ request('search') }}">
                <select name="type">
                    <option value="">Semua Departemen</option>
                    <option value="agronomi" {{ request('type') == 'agronomi' ? 'selected' : '' }}>Agronomi</option>
                    <option value="pabrik" {{ request('type') == 'pabrik' ? 'selected' : '' }}>Pabrik</option>
                </select>
                <button type="submit">
                    <span class="material-symbols-outlined" style="font-size: 18px; vertical-align: middle;">search</span>
                    Cari
                </button>
            </form>
            
            @if($memos->count() > 0)
                <div class="memo-grid">
                    @foreach($memos as $memo)
                        <a href="{{ route('public.memo.show', $memo) }}" class="memo-card">
                            <span class="memo-type {{ $memo->type }}">{{ $memo->type }}</span>
                            <div class="memo-number">{{ $memo->no_item }}</div>
                            <div class="memo-date">
                                <span class="material-symbols-outlined">calendar_today</span>
                                Berlaku: {{ $memo->berlaku->format('d M Y') }}
                            </div>
                            @if($memo->tidak_berlaku)
                                <div class="memo-date" style="margin-top: 0.25rem;">
                                    <span class="material-symbols-outlined">event_busy</span>
                                    Berakhir: {{ $memo->tidak_berlaku->format('d M Y') }}
                                </div>
                            @endif
                            <span class="memo-status {{ $memo->isActive() ? 'active' : 'expired' }}">
                                <span class="material-symbols-outlined" style="font-size: 14px;">{{ $memo->isActive() ? 'check_circle' : 'cancel' }}</span>
                                {{ $memo->isActive() ? 'Aktif' : 'Tidak Berlaku' }}
                            </span>
                        </a>
                    @endforeach
                </div>
                
                @if($memos->hasPages())
                    <div class="pagination">
                        {{ $memos->appends(request()->query())->links('vendor.pagination.simple-tailwind') }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <span class="material-symbols-outlined">description</span>
                    <h3>Tidak ada memo ditemukan</h3>
                    <p>Coba ubah filter pencarian Anda</p>
                </div>
            @endif
        </div>
    </main>
    
    <footer class="footer">
        <p>&copy; {{ date('Y') }} PT Ichiko Agro Lestari. All rights reserved.</p>
    </footer>
</body>
</html>
