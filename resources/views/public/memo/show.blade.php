<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $memo->no_item }} - PT Ichiko Agro</title>
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
        
        .main-content { padding-top: 100px; padding-bottom: 60px; }
        .container { max-width: 1100px; margin: 0 auto; padding: 0 5%; }
        
        .back-link { display: inline-flex; align-items: center; gap: 0.5rem; color: #666; text-decoration: none; font-size: 0.9rem; margin-bottom: 1.5rem; transition: color 0.3s; }
        .back-link:hover { color: #0d7c3d; }
        
        .memo-container { background: white; border-radius: 16px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); overflow: hidden; }
        .memo-header { padding: 2rem; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem; }
        .memo-header-left { flex: 1; }
        .memo-type { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; margin-bottom: 1rem; }
        .memo-type.agronomi { background: #e1f5d6; color: #0c4e16; }
        .memo-type.pabrik { background: #fff3cd; color: #856404; }
        .memo-title { font-size: 1.5rem; font-weight: 700; color: #1a1a1a; margin-bottom: 1rem; line-height: 1.3; }
        .memo-meta { display: flex; flex-wrap: wrap; gap: 1.5rem; color: #666; font-size: 0.9rem; }
        .memo-meta-item { display: flex; align-items: center; gap: 0.5rem; }
        .memo-meta-item .material-symbols-outlined { font-size: 18px; color: #0d7c3d; }
        .memo-status { display: inline-flex; align-items: center; gap: 4px; padding: 6px 12px; border-radius: 12px; font-size: 0.85rem; font-weight: 500; margin-top: 1rem; }
        .memo-status.active { background: #e1f5d6; color: #0c4e16; }
        .memo-status.expired { background: #fee2e2; color: #991b1b; }
        
        .download-btn { display: inline-flex; align-items: center; gap: 0.5rem; padding: 12px 20px; background: #0d7c3d; color: white; border-radius: 8px; text-decoration: none; font-size: 0.9rem; font-weight: 600; transition: background 0.3s; }
        .download-btn:hover { background: #0a6331; }
        .download-btn .material-symbols-outlined { font-size: 20px; }
        
        .pdf-viewer { padding: 0; background: #333; min-height: 600px; }
        .pdf-viewer iframe { width: 100%; height: 800px; border: none; }
        .pdf-viewer embed { width: 100%; height: 800px; }
        .pdf-viewer object { width: 100%; height: 800px; }
        
        .no-preview { padding: 3rem; text-align: center; background: #f8faf9; }
        .no-preview .material-symbols-outlined { font-size: 64px; color: #ccc; margin-bottom: 1rem; }
        .no-preview p { color: #666; margin-bottom: 1rem; }
        
        .footer { background: #1a1a1a; color: white; padding: 30px 5%; text-align: center; }
        .footer p { color: #888; font-size: 0.9rem; }
        
        .mobile-menu-btn { display: none; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #333; }
        @media (max-width: 768px) {
            .nav-links { display: none; }
            .mobile-menu-btn { display: block; }
            .memo-title { font-size: 1.2rem; }
            .memo-meta { flex-direction: column; gap: 0.75rem; }
            .memo-header { flex-direction: column; }
            .pdf-viewer iframe, .pdf-viewer embed, .pdf-viewer object { height: 500px; }
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
            <a href="{{ route('public.memo.index') }}" class="back-link">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali ke Daftar Memo
            </a>
            
            <div class="memo-container">
                <div class="memo-header">
                    <div class="memo-header-left">
                        <span class="memo-type {{ $memo->type }}">{{ $memo->type }}</span>
                        <h1 class="memo-title">{{ $memo->no_item }}</h1>
                        <div class="memo-meta">
                            <div class="memo-meta-item">
                                <span class="material-symbols-outlined">calendar_today</span>
                                Berlaku: {{ $memo->berlaku->format('d F Y') }}
                            </div>
                            @if($memo->tidak_berlaku)
                                <div class="memo-meta-item">
                                    <span class="material-symbols-outlined">event_busy</span>
                                    Berakhir: {{ $memo->tidak_berlaku->format('d F Y') }}
                                </div>
                            @endif
                            @if($memo->tanggal_revisi)
                                <div class="memo-meta-item">
                                    <span class="material-symbols-outlined">edit_calendar</span>
                                    Revisi: {{ $memo->tanggal_revisi->format('d F Y') }}
                                </div>
                            @endif
                        </div>
                        <span class="memo-status {{ $memo->isActive() ? 'active' : 'expired' }}">
                            <span class="material-symbols-outlined" style="font-size: 16px;">{{ $memo->isActive() ? 'check_circle' : 'cancel' }}</span>
                            {{ $memo->isActive() ? 'Memo ini masih berlaku' : 'Memo ini sudah tidak berlaku' }}
                        </span>
                    </div>
                    @if($memo->file_path)
                        <a href="{{ asset('storage/' . $memo->file_path) }}" download class="download-btn">
                            <span class="material-symbols-outlined">download</span>
                            Download PDF
                        </a>
                    @endif
                </div>
                
                @if($memo->file_path)
                    @php
                        $fileUrl = asset('storage/' . $memo->file_path);
                        $extension = pathinfo($memo->file_path, PATHINFO_EXTENSION);
                    @endphp
                    
                    @if(strtolower($extension) === 'pdf')
                        <div class="pdf-viewer">
                            <iframe src="{{ $fileUrl }}#toolbar=1&navpanes=0&scrollbar=1" type="application/pdf"></iframe>
                        </div>
                    @elseif(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                        <div style="padding: 2rem; text-align: center; background: #f5f5f5;">
                            <img src="{{ $fileUrl }}" alt="{{ $memo->no_item }}" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                        </div>
                    @else
                        <div class="no-preview">
                            <span class="material-symbols-outlined">description</span>
                            <p>Preview tidak tersedia untuk tipe file ini.</p>
                            <a href="{{ $fileUrl }}" download class="download-btn">
                                <span class="material-symbols-outlined">download</span>
                                Download File
                            </a>
                        </div>
                    @endif
                @else
                    <div class="no-preview">
                        <span class="material-symbols-outlined">folder_off</span>
                        <p>Tidak ada dokumen yang dilampirkan pada memo ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </main>
    
    <footer class="footer">
        <p>&copy; {{ date('Y') }} PT Ichiko Agro Lestari. All rights reserved.</p>
    </footer>
</body>
</html>
