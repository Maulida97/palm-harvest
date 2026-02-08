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
    
    .main-content { padding-top: 100px; padding-bottom: 60px; min-height: calc(100vh - 100px); }
    .container { max-width: 1200px; margin: 0 auto; padding: 0 5%; }
    .page-header { margin-bottom: 2rem; }
    .page-header h1 { font-size: 2rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem; }
    .page-header p { color: #666; }
    
    .filter-bar { display: flex; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap; }
    .filter-bar input, .filter-bar select { padding: 10px 16px; border: 1px solid #ddd; border-radius: 8px; font-size: 0.9rem; background: white; }
    .filter-bar button { display: flex; align-items: center; gap: 0.5rem; padding: 10px 20px; background: #0d7c3d; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: background 0.3s; }
    .filter-bar button:hover { background: #0a6331; }
    .filter-bar button .material-symbols-outlined { font-size: 18px; }
    
    .tabs { display: flex; gap: 0.5rem; margin-bottom: 1.5rem; border-bottom: 2px solid #eee; padding-bottom: 0; }
    .tab-btn { padding: 12px 24px; background: none; border: none; font-size: 0.95rem; font-weight: 500; color: #666; cursor: pointer; border-bottom: 2px solid transparent; margin-bottom: -2px; transition: all 0.3s; }
    .tab-btn.active { color: #0d7c3d; border-bottom-color: #0d7c3d; }
    .tab-btn:hover { color: #0d7c3d; }
    .tab-content { display: none; }
    .tab-content.active { display: block; }
    
    .table-wrapper { background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.08); overflow-x: auto; }
    .data-table { width: 100%; border-collapse: collapse; }
    .data-table th, .data-table td { padding: 14px 16px; text-align: left; border-bottom: 1px solid #eee; font-size: 0.9rem; }
    .data-table th { background: #f8faf9; font-weight: 600; color: #333; white-space: nowrap; }
    .data-table tbody tr:hover { background: #f0fdf4; }
    .data-table tbody tr:last-child td { border-bottom: none; }
    
    .badge { display: inline-block; padding: 4px 10px; border-radius: 12px; font-size: 0.75rem; font-weight: 500; }
    .badge.pending { background: #fff3cd; color: #856404; }
    .badge.verified { background: #d4edda; color: #155724; }
    .badge.approved { background: #d4edda; color: #155724; }
    .badge.rejected { background: #f8d7da; color: #721c24; }
    
    .view-btn { display: inline-flex; align-items: center; gap: 4px; padding: 6px 12px; background: #0d7c3d; color: white; border-radius: 6px; font-size: 0.8rem; font-weight: 500; text-decoration: none; transition: background 0.2s; }
    .view-btn:hover { background: #0a6331; }
    .view-btn .material-symbols-outlined { font-size: 16px; }
    
    .empty-state { text-align: center; padding: 4rem 2rem; background: white; border-radius: 16px; }
    .empty-state .material-symbols-outlined { font-size: 64px; color: #ccc; margin-bottom: 1rem; }
    .empty-state h3 { font-size: 1.25rem; color: #666; margin-bottom: 0.5rem; }
    
    .pagination { display: flex; justify-content: center; align-items: center; gap: 0.5rem; margin-top: 2rem; flex-wrap: wrap; }
    .pagination nav { display: flex; justify-content: center; align-items: center; gap: 0.5rem; }
    .pagination nav > div { display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; justify-content: center; }
    .pagination nav > div > div:first-child { font-size: 0.85rem; color: #666; }
    .pagination a, .pagination span { padding: 8px 14px; border-radius: 8px; text-decoration: none; font-size: 0.9rem; }
    .pagination a { background: white; color: #555; border: 1px solid #ddd; transition: all 0.2s; }
    .pagination a:hover { background: #0d7c3d; color: white; border-color: #0d7c3d; }
    .pagination span[aria-current="page"] span { background: #0d7c3d; color: white; padding: 8px 14px; border-radius: 8px; }
    .pagination svg { width: 16px; height: 16px; }
    
    .footer { background: #1a1a1a; color: white; padding: 30px 5%; text-align: center; }
    .footer p { color: #888; font-size: 0.9rem; }
    
    .mobile-menu-btn { display: none; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #333; }
    @media (max-width: 768px) {
        .nav-links { display: none; }
        .mobile-menu-btn { display: block; }
        .filter-bar { flex-direction: column; }
        .tabs { overflow-x: auto; }
        .tab-btn { white-space: nowrap; }
    }
</style>
