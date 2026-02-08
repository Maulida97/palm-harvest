<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Ichiko Agro - Menjamin Kualitas Terbaik Sawit Indonesia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            color: #1a1a1a;
            line-height: 1.6;
        }
        
        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 0 5%;
        }
        
        .navbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70px;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 1.25rem;
            color: #0d7c3d;
        }
        
        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #0d7c3d, #15a050);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        
        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
        }
        
        .nav-links a {
            text-decoration: none;
            color: #555;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .nav-links a:hover {
            color: #0d7c3d;
        }
        
        /* Dropdown Menu */
        .nav-dropdown {
            position: relative;
        }
        
        .nav-dropdown > a {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .nav-dropdown > a .material-symbols-outlined {
            font-size: 18px;
            transition: transform 0.3s;
        }
        
        .nav-dropdown:hover > a .material-symbols-outlined {
            transform: rotate(180deg);
        }
        
        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            min-width: 200px;
            padding: 8px 0;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
            z-index: 100;
            margin-top: 10px;
        }
        
        .nav-dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            margin-top: 0;
        }
        
        .dropdown-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            color: #333 !important;
            font-size: 0.85rem;
            transition: background 0.2s;
        }
        
        .dropdown-menu a:hover {
            background: #f0fdf4;
            color: #0d7c3d !important;
        }
        
        .dropdown-menu a .material-symbols-outlined {
            font-size: 20px;
            color: #0d7c3d;
        }
        
        .btn-login {
            background: #0d7c3d;
            color: white;
            padding: 10px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: background 0.3s;
        }
        
        .btn-login:hover {
            background: #0a6331;
        }
        
        /* Hero Section */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, rgba(13, 124, 61, 0.95), rgba(21, 160, 80, 0.9)), 
                        url('https://images.unsplash.com/photo-1558770147-d2a384e3eb6e?w=1920') center/cover;
            display: flex;
            align-items: center;
            padding: 120px 5% 80px;
            position: relative;
        }
        
        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }
        
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            padding: 8px 16px;
            border-radius: 50px;
            color: white;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
        }
        
        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            line-height: 1.2;
            max-width: 600px;
            margin-bottom: 1.5rem;
        }
        
        .hero h1 span {
            color: #a8e6cf;
        }
        
        .hero p {
            color: rgba(255,255,255,0.9);
            font-size: 1.1rem;
            max-width: 500px;
            margin-bottom: 2rem;
        }
        
        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .btn-primary {
            background: white;
            color: #0d7c3d;
            padding: 14px 28px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .btn-secondary {
            background: transparent;
            color: white;
            padding: 14px 28px;
            border: 2px solid rgba(255,255,255,0.5);
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s, border-color 0.3s;
        }
        
        .btn-secondary:hover {
            background: rgba(255,255,255,0.1);
            border-color: white;
        }
        
        /* About Section */
        .about {
            padding: 100px 5%;
            background: #f8faf9;
        }
        
        .about-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }
        
        .section-label {
            color: #0d7c3d;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 1rem;
        }
        
        .about h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 1.5rem;
            line-height: 1.3;
        }
        
        .about p {
            color: #666;
            margin-bottom: 2rem;
        }
        
        .stats {
            display: flex;
            gap: 3rem;
        }
        
        .stat-item h3 {
            font-size: 2rem;
            font-weight: 700;
            color: #0d7c3d;
        }
        
        .stat-item span {
            color: #888;
            font-size: 0.9rem;
        }
        
        .about-image {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0,0,0,0.15);
        }
        
        .about-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
        
        /* Services Section */
        .services {
            padding: 100px 5%;
            background: white;
        }
        
        .services-inner {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }
        
        .services h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .services > p {
            color: #666;
            max-width: 600px;
            margin: 0 auto 3rem;
        }
        
        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }
        
        .service-card {
            background: #f8faf9;
            border-radius: 16px;
            padding: 2.5rem 2rem;
            text-align: left;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .service-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #0d7c3d, #15a050);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-bottom: 1.5rem;
        }
        
        .service-card h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }
        
        .service-card p {
            color: #666;
            font-size: 0.95rem;
        }
        
        /* Why Choose Us */
        .why-us {
            padding: 100px 5%;
            background: #f8faf9;
        }
        
        .why-us-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }
        
        .why-us-image {
            position: relative;
        }
        
        .why-us-image img {
            width: 100%;
            border-radius: 20px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.15);
        }
        
        .experience-badge {
            position: absolute;
            bottom: -20px;
            left: -20px;
            background: linear-gradient(135deg, #0d7c3d, #15a050);
            color: white;
            padding: 1.5rem 2rem;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 15px 30px rgba(13, 124, 61, 0.3);
        }
        
        .experience-badge h3 {
            font-size: 2.5rem;
            font-weight: 800;
        }
        
        .experience-badge span {
            font-size: 0.85rem;
            opacity: 0.9;
        }
        
        .why-us h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.3;
        }
        
        .why-us > div > p {
            color: #666;
            margin-bottom: 2rem;
        }
        
        .features-list {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        
        .feature-item {
            display: flex;
            gap: 1rem;
            align-items: flex-start;
        }
        
        .feature-icon {
            width: 48px;
            height: 48px;
            background: rgba(13, 124, 61, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0d7c3d;
            flex-shrink: 0;
        }
        
        .feature-item h4 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .feature-item p {
            color: #666;
            font-size: 0.9rem;
        }
        
        /* Certification */
        .certification {
            padding: 80px 5%;
            background: #0d7c3d;
        }
        
        .certification-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }
        
        .certification h2 {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
        }
        
        .certification p {
            color: rgba(255,255,255,0.85);
            margin-bottom: 1.5rem;
        }
        
        .cert-features {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        
        .cert-feature {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: white;
            font-size: 0.95rem;
        }
        
        .cert-feature .material-symbols-outlined {
            color: #a8e6cf;
        }
        
        .cert-logos {
            display: flex;
            gap: 2rem;
            justify-content: center;
        }
        
        .cert-logo {
            background: white;
            padding: 2rem 3rem;
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }
        
        .cert-logo h3 {
            font-size: 2rem;
            font-weight: 800;
            color: #0d7c3d;
        }
        
        .cert-logo span {
            font-size: 0.75rem;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        /* Footer */
        .footer {
            background: #1a1a1a;
            color: white;
            padding: 60px 5% 30px;
        }
        
        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }
        
        .footer-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }
        
        .footer-logo .logo-icon {
            background: linear-gradient(135deg, #0d7c3d, #15a050);
        }
        
        .footer p {
            color: #888;
            font-size: 0.9rem;
            line-height: 1.7;
        }
        
        .footer h4 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1.25rem;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 0.75rem;
        }
        
        .footer-links a {
            color: #888;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: #0d7c3d;
        }
        
        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            margin-bottom: 1rem;
            color: #888;
            font-size: 0.9rem;
        }
        
        .contact-item .material-symbols-outlined {
            color: #0d7c3d;
            font-size: 20px;
        }
        
        .footer-bottom {
            border-top: 1px solid #333;
            padding-top: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            color: #666;
        }
        
        .footer-bottom-links {
            display: flex;
            gap: 2rem;
        }
        
        .footer-bottom-links a {
            color: #666;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-bottom-links a:hover {
            color: #0d7c3d;
        }
        
        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #333;
        }
        
        /* Responsive */
        @media (max-width: 1024px) {
            .hero h1 {
                font-size: 2.75rem;
            }
            
            .about-inner,
            .why-us-inner,
            .certification-inner {
                grid-template-columns: 1fr;
            }
            
            .services-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .mobile-menu-btn {
                display: block;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .services-grid {
                grid-template-columns: 1fr;
            }
            
            .cert-logos {
                flex-direction: column;
                align-items: center;
            }
            
            .footer-grid {
                grid-template-columns: 1fr;
            }
            
            .footer-bottom {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-inner">
            <div class="logo">
                <div class="logo-icon">
                    <span class="material-symbols-outlined">eco</span>
                </div>
                PT ICHIKO AGRO
            </div>
            <ul class="nav-links">
                <li><a href="#beranda">Beranda</a></li>
                <li><a href="#tentang">Tentang Kami</a></li>
                <li><a href="#layanan">Produk & Layanan</a></li>
                <li><a href="#keunggulan">Keunggulan</a></li>
                <li><a href="#sertifikasi">Sertifikasi</a></li>
                <li><a href="{{ route('public.memo.index') }}">Memo</a></li>
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
            <button class="mobile-menu-btn">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </nav>
    
    <!-- Hero Section -->
    <section class="hero" id="beranda">
        <div class="hero-content">
            <div class="hero-badge">
                <span class="material-symbols-outlined" style="font-size: 18px;">verified</span>
                Standar Mutu Internasional
            </div>
            <h1>Menjamin Kualitas Terbaik <span>Sawit Indonesia</span></h1>
            <p>Berkomitmen pada standar tertinggi dalam pengawasan mutu dan kontrol kualitas kelapa sawit untuk hasil yang optimal dan berkelanjutan.</p>
            <div class="hero-buttons">
                <a href="#layanan" class="btn-primary">
                    Pelajari Lebih Lanjut
                    <span class="material-symbols-outlined" style="font-size: 18px;">arrow_forward</span>
                </a>
                <a href="#kontak" class="btn-secondary">Hubungi Kami</a>
            </div>
        </div>
    </section>
    
    <!-- About Section -->
    <section class="about" id="tentang">
        <div class="about-inner">
            <div>
                <div class="section-label">Tentang Kami</div>
                <h2>Berdedikasi Untuk Integritas Produk</h2>
                <p>Divisi Quality Control PT Ichiko Agro Lestari berdedikasi untuk memastikan kualitas produk kelapa sawit memenuhi standar industri global melalui pengujian ketat dan pemantauan berkelanjutan di seluruh rantai nilai.</p>
                <div class="stats">
                    <div class="stat-item">
                        <h3>100%</h3>
                        <span>Akurasi Analisis</span>
                    </div>
                    <div class="stat-item">
                        <h3>ISO 17025</h3>
                        <span>Tersertifikasi</span>
                    </div>
                </div>
            </div>
            <div class="about-image">
                <img src="https://images.unsplash.com/photo-1581093458791-9d42e3c7e117?w=800" alt="Quality Control Lab">
            </div>
        </div>
    </section>
    
    <!-- Services Section -->
    <section class="services" id="layanan">
        <div class="services-inner">
            <div class="section-label">Produk & Layanan</div>
            <h2>Layanan Kontrol Kualitas Komprehensif</h2>
            <p>Kami menyediakan solusi kontrol kualitas untuk memaksimalkan output minyak sawit mentah (CPO) dan inti sawit (PK) dengan standar tertinggi.</p>
            
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <span class="material-symbols-outlined">search</span>
                    </div>
                    <h3>Inspeksi Lapangan</h3>
                    <p>Pengawasan langsung di area perkebunan untuk memastikan kualitas buah dan praktik panen yang baik sesuai standar.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <span class="material-symbols-outlined">grade</span>
                    </div>
                    <h3>Grading TBS</h3>
                    <p>Penilaian kualitas Tandan Buah Segar yang ketat terhadap penentuan rendemen dan kualitas produk akhir.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <span class="material-symbols-outlined">science</span>
                    </div>
                    <h3>Analisa Laboratorium</h3>
                    <p>Pengujian komposisi kimia dan kadar asam lemak untuk memastikan CPO memenuhi standar internasional.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Why Choose Us -->
    <section class="why-us" id="keunggulan">
        <div class="why-us-inner">
            <div class="why-us-image">
                <img src="https://images.unsplash.com/photo-1605000797499-95a51c5269ae?w=800" alt="Palm Plantation">
                <div class="experience-badge">
                    <h3>15+</h3>
                    <span>Tahun Pengalaman</span>
                </div>
            </div>
            <div>
                <div class="section-label">Keunggulan Kami</div>
                <h2>Mengapa Memilih Standar Ichiko Agro?</h2>
                <p>Kepercayaan klien terhadap pada integritas produk adalah prioritas utama kami. Beberapa kelebihan yang kami tawarkan untuk klien:</p>
                
                <div class="features-list">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <span class="material-symbols-outlined">memory</span>
                        </div>
                        <div>
                            <h4>Teknologi Modern</h4>
                            <p>Menggunakan NIR Infrared spektrometer untuk analisis cepat dan akurat.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <span class="material-symbols-outlined">workspace_premium</span>
                        </div>
                        <div>
                            <h4>Tenaga Ahli Bersertifikat</h4>
                            <p>Tim profesional memiliki sertifikasi kompetensi industri nasional dan internasional.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <span class="material-symbols-outlined">monitoring</span>
                        </div>
                        <div>
                            <h4>Reporting Real-time</h4>
                            <p>Sistem informasi QC yang terintegrasi memungkinkan akses data kapan saja.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Certification -->
    <section class="certification" id="sertifikasi">
        <div class="certification-inner">
            <div>
                <div class="section-label" style="color: #a8e6cf;">Sertifikasi Resmi</div>
                <h2>Komitmen Terhadap Standar RSPO & ISPO</h2>
                <p>Kami berkomitmen untuk mewujudkan masa depan kelapa sawit yang berkelanjutan. Proses QC telah terakreditasi dan terakreditasi standar untuk keabsahan tertinggi.</p>
                
                <div class="cert-features">
                    <div class="cert-feature">
                        <span class="material-symbols-outlined">check_circle</span>
                        Zero-Waste Processing Monitoring
                    </div>
                    <div class="cert-feature">
                        <span class="material-symbols-outlined">check_circle</span>
                        High Conservation Value (HCV) Preservation
                    </div>
                    <div class="cert-feature">
                        <span class="material-symbols-outlined">check_circle</span>
                        Full Traceability from Mill to Plantation
                    </div>
                </div>
            </div>
            <div class="cert-logos">
                <div class="cert-logo">
                    <h3>RSPO</h3>
                    <span>Certified Sustainable</span>
                </div>
                <div class="cert-logo">
                    <h3 style="color: #f59e0b;">ISPO</h3>
                    <span>National Standard</span>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="footer" id="kontak">
        <div class="footer-inner">
            <div class="footer-grid">
                <div>
                    <div class="footer-logo">
                        <div class="logo-icon">
                            <span class="material-symbols-outlined">eco</span>
                        </div>
                        PT ICHIKO AGRO
                    </div>
                    <p>Perusahaan jasa pengawasan produksi sawit dengan fokus utama pada quality control berkelanjutan.</p>
                </div>
                <div>
                    <h4>Tautan Cepat</h4>
                    <ul class="footer-links">
                        <li><a href="#beranda">Beranda</a></li>
                        <li><a href="#tentang">Tentang Kami</a></li>
                        <li><a href="#layanan">Produk & Layanan</a></li>
                        <li><a href="#keunggulan">Keunggulan</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Informasi Kontak</h4>
                    <div class="contact-item">
                        <span class="material-symbols-outlined">location_on</span>
                        <span>Jl. Sudirman No. 123, Jakarta Selatan</span>
                    </div>
                    <div class="contact-item">
                        <span class="material-symbols-outlined">phone</span>
                        <span>+62 21 1234 5678</span>
                    </div>
                    <div class="contact-item">
                        <span class="material-symbols-outlined">mail</span>
                        <span>info@ichikoagro.co.id</span>
                    </div>
                </div>
                <div>
                    <h4>Lokasi Operasional</h4>
                    <ul class="footer-links">
                        <li><a href="#">Sumatera Utara</a></li>
                        <li><a href="#">Riau</a></li>
                        <li><a href="#">Kalimantan Barat</a></li>
                        <li><a href="#">Kalimantan Tengah</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <span>© 2026 PT Ichiko Agro Lestari. All rights reserved.</span>
                <div class="footer-bottom-links">
                    <a href="#">Kebijakan Privasi</a>
                    <a href="#">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
