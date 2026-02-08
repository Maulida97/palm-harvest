<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail BAP Material - PT Ichiko Agro</title>
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
        
        .back-btn { display: inline-flex; align-items: center; gap: 0.5rem; padding: 10px 16px; background: white; border: 1px solid #ddd; border-radius: 8px; color: #555; font-size: 0.9rem; text-decoration: none; transition: all 0.2s; margin-bottom: 1.5rem; }
        .back-btn:hover { background: #f5f5f5; }
        
        .photo-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1rem; }
        .photo-item { position: relative; overflow: hidden; border-radius: 12px; aspect-ratio: 4/3; }
        .photo-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s; }
        .photo-item:hover img { transform: scale(1.05); }
        .photo-item a { display: block; height: 100%; }
        .photo-overlay { position: absolute; inset: 0; background: rgba(0,0,0,0); display: flex; align-items: center; justify-content: center; transition: background 0.3s; }
        .photo-item:hover .photo-overlay { background: rgba(0,0,0,0.3); }
        .photo-overlay .material-symbols-outlined { color: white; font-size: 32px; opacity: 0; transition: opacity 0.3s; }
        .photo-item:hover .photo-overlay .material-symbols-outlined { opacity: 1; }
        
        .photo-empty { text-align: center; padding: 2rem; border-radius: 12px; }
        .photo-empty.green { background: #f0fdf4; color: #16a34a; }
        .photo-empty.blue { background: #eff6ff; color: #2563eb; }
        .photo-empty .material-symbols-outlined { font-size: 48px; opacity: 0.5; margin-bottom: 0.5rem; }
        
        .section-badge { display: inline-flex; align-items: center; gap: 0.25rem; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 500; margin-left: 0.5rem; }
        .section-badge.green { background: #dcfce7; color: #166534; }
        .section-badge.blue { background: #dbeafe; color: #1e40af; }
    </style>
</head>
<body>
    @include('public.rekap.navbar')
    
    <main class="main-content">
        <div class="container">
            <a href="{{ route('public.rekap.bap-material') }}" class="back-btn">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali ke Daftar
            </a>
            
            <div class="page-header">
                <h1>Detail BAP Material</h1>
                <p>{{ $bapMaterial->jenis_material }} - {{ $bapMaterial->inspection_date->format('d F Y') }}</p>
            </div>
            
            <!-- Info Card -->
            <div class="info-card">
                <h3><span class="material-symbols-outlined">info</span> Informasi Material</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Nama QC</label>
                        <span>{{ $bapMaterial->qc_name ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <label>Jenis Material</label>
                        <span>{{ $bapMaterial->jenis_material ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <label>Tanggal Inspeksi</label>
                        <span>{{ $bapMaterial->inspection_date->format('d F Y') }}</span>
                    </div>
                    <div class="info-item">
                        <label>Dimensi (P×L×T)</label>
                        <span>{{ $bapMaterial->panjang ?? '-' }} × {{ $bapMaterial->lebar ?? '-' }} × {{ $bapMaterial->tinggi ?? '-' }} cm</span>
                    </div>
                </div>
                
                @if($bapMaterial->keterangan)
                    <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid #eee;">
                        <label style="display: block; font-size: 0.7rem; text-transform: uppercase; color: #666; margin-bottom: 0.25rem;">Keterangan</label>
                        <p style="color: #1a1a1a;">{{ $bapMaterial->keterangan }}</p>
                    </div>
                @endif
            </div>
            
            <!-- Foto Dokumentasi -->
            <div class="info-card">
                <h3>
                    <span class="material-symbols-outlined" style="color: #16a34a">photo_camera</span> 
                    Foto Dokumentasi
                    <span class="section-badge green">{{ $bapMaterial->dokumentasiPhotos->count() }} foto</span>
                </h3>
                
                @if($bapMaterial->dokumentasiPhotos->count() > 0)
                    <div class="photo-grid">
                        @foreach($bapMaterial->dokumentasiPhotos as $photo)
                            <div class="photo-item" style="border: 2px solid #bbf7d0;">
                                <a href="{{ asset('storage/' . $photo->photo_path) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Foto Dokumentasi">
                                    <div class="photo-overlay">
                                        <span class="material-symbols-outlined">zoom_in</span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="photo-empty green">
                        <span class="material-symbols-outlined">image_not_supported</span>
                        <p>Tidak ada foto dokumentasi.</p>
                    </div>
                @endif
            </div>
            
            <!-- Foto Surat Jalan -->
            <div class="info-card">
                <h3>
                    <span class="material-symbols-outlined" style="color: #2563eb">description</span> 
                    Foto Surat Jalan
                    <span class="section-badge blue">{{ $bapMaterial->suratJalanPhotos->count() }} foto</span>
                </h3>
                
                @if($bapMaterial->suratJalanPhotos->count() > 0)
                    <div class="photo-grid">
                        @foreach($bapMaterial->suratJalanPhotos as $photo)
                            <div class="photo-item" style="border: 2px solid #bfdbfe;">
                                <a href="{{ asset('storage/' . $photo->photo_path) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Foto Surat Jalan">
                                    <div class="photo-overlay">
                                        <span class="material-symbols-outlined">zoom_in</span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="photo-empty blue">
                        <span class="material-symbols-outlined">image_not_supported</span>
                        <p>Tidak ada foto surat jalan.</p>
                    </div>
                @endif
            </div>
        </div>
    </main>
    
    @include('public.rekap.footer')
</body>
</html>
