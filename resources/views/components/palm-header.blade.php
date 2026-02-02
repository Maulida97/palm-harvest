@props(['title' => 'Dashboard'])

<header class="h-16 flex items-center justify-between px-8 border-b border-surface-border bg-surface-light shrink-0 z-10">
    <div class="flex items-center gap-3">
        <span class="material-symbols-outlined text-primary">eco</span>
        <h2 class="text-text-main text-lg font-bold leading-tight tracking-[-0.015em]">{{ $title }}</h2>
    </div>
    <div class="flex items-center gap-6">
        <!-- Search (Optional) -->
        <div class="relative hidden md:block">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-secondary text-[20px]">search</span>
            <input type="text" 
                   placeholder="Cari data..." 
                   class="h-10 pl-10 pr-4 rounded-lg bg-white border border-surface-border text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary w-64 placeholder:text-text-secondary/60">
        </div>
        
        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="flex items-center gap-2 h-9 px-4 bg-primary hover:bg-primary/90 text-white rounded-lg text-sm font-semibold transition-colors shadow-sm shadow-primary/30">
                <span class="material-symbols-outlined text-[18px]">logout</span>
                <span>Keluar</span>
            </button>
        </form>
    </div>
</header>
