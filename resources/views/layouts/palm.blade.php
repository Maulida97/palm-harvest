<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PalmHarvest') - Admin Dashboard</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Theme Configuration -->
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#66bd0f",
                        "background-light": "#f7f8f6",
                        "background-dark": "#192210",
                        "surface-light": "#fafcf8",
                        "surface-border": "#edf3e7",
                        "text-main": "#141b0d",
                        "text-secondary": "#739a4c",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-size: 24px;
        }
        .material-symbols-outlined.filled {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        
        /* Custom scrollbar for webkit */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #dbe7cf;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #66bd0f;
        }
        
        /* Mobile sidebar overlay */
        #sidebar-overlay {
            transition: opacity 0.3s ease;
        }
        #sidebar-overlay.hidden {
            opacity: 0;
            pointer-events: none;
        }
        
        /* Sidebar slide animation */
        #mobile-sidebar {
            transition: transform 0.3s ease;
        }
        #mobile-sidebar.sidebar-closed {
            transform: translateX(-100%);
        }
        /* Override for desktop - always show sidebar */
        @media (min-width: 1024px) {
            #mobile-sidebar {
                transform: translateX(0) !important;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body class="font-display bg-background-light text-text-main h-screen w-full overflow-hidden flex">
    <!-- Mobile Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 lg:hidden hidden" onclick="toggleSidebar()"></div>
    
    <!-- Sidebar - Hidden on mobile by default -->
    <aside id="mobile-sidebar" class="fixed lg:relative w-64 bg-surface-light border-r border-surface-border flex-shrink-0 flex flex-col justify-between h-full p-4 z-50 sidebar-closed lg:transform-none">
        <div class="flex flex-col gap-8">
            <!-- Brand -->
            <div class="flex items-center justify-between">
                <div class="flex gap-3 px-2 pt-2">
                    <div class="bg-primary/20 rounded-full size-10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary">eco</span>
                    </div>
                    <div class="flex flex-col justify-center">
                        <h1 class="text-text-main text-base font-bold leading-none">PalmHarvest</h1>
                        <p class="text-text-secondary text-xs font-normal mt-1">{{ auth()->user()->isAdmin() ? 'Admin Console' : 'Officer Panel' }}</p>
                    </div>
                </div>
                <!-- Close button for mobile -->
                <button onclick="toggleSidebar()" class="lg:hidden p-2 hover:bg-surface-border rounded-lg">
                    <span class="material-symbols-outlined text-text-secondary">close</span>
                </button>
            </div>
            
            <!-- Navigation -->
            <x-palm-sidebar-nav />
        </div>
        
        <!-- Bottom User Profile -->
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-3 mt-auto rounded-lg border border-surface-border bg-white hover:bg-surface-light hover:border-primary/30 transition-all group">
            <div class="bg-primary/20 rounded-full size-8 flex items-center justify-center">
                <span class="material-symbols-outlined text-primary text-[18px]">person</span>
            </div>
            <div class="flex flex-col min-w-0 flex-1">
                <p class="text-text-main text-xs font-semibold truncate">{{ auth()->user()->name }}</p>
                <p class="text-text-secondary text-[10px] truncate">{{ auth()->user()->email }}</p>
            </div>
            <span class="material-symbols-outlined text-text-secondary text-[16px] group-hover:text-primary">settings</span>
        </a>
    </aside>
    
    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-full bg-[#fcfdfa] relative overflow-hidden w-full">
        <!-- Header -->
        <header class="h-14 lg:h-16 flex items-center justify-between px-4 lg:px-8 border-b border-surface-border bg-surface-light shrink-0 z-10">
            <div class="flex items-center gap-3">
                <!-- Hamburger menu for mobile -->
                <button onclick="toggleSidebar()" class="lg:hidden p-2 -ml-2 hover:bg-surface-border rounded-lg">
                    <span class="material-symbols-outlined text-text-main">menu</span>
                </button>
                <span class="material-symbols-outlined text-primary hidden lg:block">eco</span>
                <h2 class="text-text-main text-base lg:text-lg font-bold leading-tight tracking-[-0.015em]">{{ $pageTitle ?? 'Dashboard' }}</h2>
            </div>
            <div class="flex items-center gap-2 lg:gap-6">
                <!-- Search (Optional) - Hidden on mobile -->
                <div class="relative hidden lg:block">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-secondary text-[20px]">search</span>
                    <input type="text" 
                           placeholder="Cari data..." 
                           class="h-10 pl-10 pr-4 rounded-lg bg-white border border-surface-border text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary w-64 placeholder:text-text-secondary/60">
                </div>
                
                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 h-9 px-3 lg:px-4 bg-primary hover:bg-primary/90 text-white rounded-lg text-sm font-semibold transition-colors shadow-sm shadow-primary/30">
                        <span class="material-symbols-outlined text-[18px]">logout</span>
                        <span class="hidden sm:inline">Keluar</span>
                    </button>
                </form>
            </div>
        </header>
        
        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto p-4 lg:p-8">
            <div class="max-w-[1400px] mx-auto flex flex-col gap-4 lg:gap-6 pb-12">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center gap-2 text-sm">
                        <span class="material-symbols-outlined text-green-600 text-[20px]">check_circle</span>
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center gap-2 text-sm">
                        <span class="material-symbols-outlined text-red-600 text-[20px]">error</span>
                        {{ session('error') }}
                    </div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </main>
    
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('mobile-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.toggle('sidebar-closed');
            overlay.classList.toggle('hidden');
            
            // Prevent body scroll when sidebar is open
            if (!sidebar.classList.contains('sidebar-closed')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }
        
        // Close sidebar on resize to desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                document.getElementById('mobile-sidebar').classList.remove('sidebar-closed');
                document.getElementById('sidebar-overlay').classList.add('hidden');
                document.body.style.overflow = '';
            } else {
                document.getElementById('mobile-sidebar').classList.add('sidebar-closed');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>
