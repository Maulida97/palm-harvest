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
            <li><a href="{{ route('public.memo.index') }}">Memo</a></li>
            <li class="nav-dropdown">
                <a href="#" class="active">
                    Rekap
                    <span class="material-symbols-outlined">expand_more</span>
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('public.rekap.bap') }}" class="{{ request()->routeIs('public.rekap.bap') ? 'active' : '' }}">
                        <span class="material-symbols-outlined">assignment</span>
                        Input BAP & Hold
                    </a>
                    <a href="{{ route('public.rekap.ancak') }}" class="{{ request()->routeIs('public.rekap.ancak') ? 'active' : '' }}">
                        <span class="material-symbols-outlined">cleaning_services</span>
                        Kebersihan Ancak
                    </a>
                    <a href="{{ route('public.rekap.bap-material') }}" class="{{ request()->routeIs('public.rekap.bap-material') ? 'active' : '' }}">
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
