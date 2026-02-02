@php
    $isAdmin = auth()->user()->isAdmin();
    $currentRoute = Route::currentRouteName();
@endphp

<nav class="flex flex-col gap-2">
    @if($isAdmin)
        <!-- Admin Navigation -->
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ str_starts_with($currentRoute, 'admin.dashboard') ? 'bg-[#edf3e7]' : 'hover:bg-white hover:shadow-sm' }} transition-all group">
            <span class="material-symbols-outlined {{ str_starts_with($currentRoute, 'admin.dashboard') ? 'filled text-primary' : 'text-[#739a4c] group-hover:text-primary' }}">grid_view</span>
            <p class="text-text-main text-sm {{ str_starts_with($currentRoute, 'admin.dashboard') ? 'font-semibold' : 'font-medium' }} leading-normal">Dashboard</p>
        </a>
        
        <a href="{{ route('admin.bap.index') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ str_starts_with($currentRoute, 'admin.bap') ? 'bg-[#edf3e7]' : 'hover:bg-white hover:shadow-sm' }} transition-all group">
            <span class="material-symbols-outlined {{ str_starts_with($currentRoute, 'admin.bap') ? 'filled text-primary' : 'text-[#739a4c] group-hover:text-primary' }}">fact_check</span>
            <p class="text-text-main text-sm {{ str_starts_with($currentRoute, 'admin.bap') ? 'font-semibold' : 'font-medium' }} leading-normal">Input BAP</p>
        </a>
        
        <a href="{{ route('admin.holdqc.index') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ str_starts_with($currentRoute, 'admin.holdqc') ? 'bg-[#edf3e7]' : 'hover:bg-white hover:shadow-sm' }} transition-all group">
            <span class="material-symbols-outlined {{ str_starts_with($currentRoute, 'admin.holdqc') ? 'filled text-primary' : 'text-[#739a4c] group-hover:text-primary' }}">pending_actions</span>
            <p class="text-text-main text-sm {{ str_starts_with($currentRoute, 'admin.holdqc') ? 'font-semibold' : 'font-medium' }} leading-normal">Hold QC</p>
        </a>
        
        <a href="{{ route('admin.blocks.index') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ str_starts_with($currentRoute, 'admin.blocks') ? 'bg-[#edf3e7]' : 'hover:bg-white hover:shadow-sm' }} transition-all group">
            <span class="material-symbols-outlined {{ str_starts_with($currentRoute, 'admin.blocks') ? 'filled text-primary' : 'text-[#739a4c] group-hover:text-primary' }}">map</span>
            <p class="text-text-main text-sm {{ str_starts_with($currentRoute, 'admin.blocks') ? 'font-semibold' : 'font-medium' }} leading-normal">Blok</p>
        </a>
        
        <a href="{{ route('admin.officers.index') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ str_starts_with($currentRoute, 'admin.officers') ? 'bg-[#edf3e7]' : 'hover:bg-white hover:shadow-sm' }} transition-all group">
            <span class="material-symbols-outlined {{ str_starts_with($currentRoute, 'admin.officers') ? 'filled text-primary' : 'text-[#739a4c] group-hover:text-primary' }}">group</span>
            <p class="text-text-main text-sm {{ str_starts_with($currentRoute, 'admin.officers') ? 'font-semibold' : 'font-medium' }} leading-normal">Petugas</p>
        </a>
        
        <a href="{{ route('admin.harvests.index') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ str_starts_with($currentRoute, 'admin.harvests') ? 'bg-[#edf3e7]' : 'hover:bg-white hover:shadow-sm' }} transition-all group">
            <span class="material-symbols-outlined {{ str_starts_with($currentRoute, 'admin.harvests') ? 'filled text-primary' : 'text-[#739a4c] group-hover:text-primary' }}">inventory_2</span>
            <p class="text-text-main text-sm {{ str_starts_with($currentRoute, 'admin.harvests') ? 'font-semibold' : 'font-medium' }} leading-normal">Panen</p>
        </a>
        
        <a href="{{ route('admin.reports.index') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ str_starts_with($currentRoute, 'admin.reports') ? 'bg-[#edf3e7]' : 'hover:bg-white hover:shadow-sm' }} transition-all group">
            <span class="material-symbols-outlined {{ str_starts_with($currentRoute, 'admin.reports') ? 'filled text-primary' : 'text-[#739a4c] group-hover:text-primary' }}">description</span>
            <p class="text-text-main text-sm {{ str_starts_with($currentRoute, 'admin.reports') ? 'font-semibold' : 'font-medium' }} leading-normal">Laporan</p>
        </a>
        
        <a href="{{ route('admin.ancak.index') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ str_starts_with($currentRoute, 'admin.ancak') ? 'bg-[#edf3e7]' : 'hover:bg-white hover:shadow-sm' }} transition-all group">
            <span class="material-symbols-outlined {{ str_starts_with($currentRoute, 'admin.ancak') ? 'filled text-primary' : 'text-[#739a4c] group-hover:text-primary' }}">cleaning_services</span>
            <p class="text-text-main text-sm {{ str_starts_with($currentRoute, 'admin.ancak') ? 'font-semibold' : 'font-medium' }} leading-normal">Kebersihan Ancak</p>
        </a>
        
        <!-- Internal Memo with Submenu -->
        <div x-data="{ open: {{ str_starts_with($currentRoute, 'admin.memo') ? 'true' : 'false' }} }">
            <button @click="open = !open" 
                    class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-lg {{ str_starts_with($currentRoute, 'admin.memo') ? 'bg-[#edf3e7]' : 'hover:bg-white hover:shadow-sm' }} transition-all group">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined {{ str_starts_with($currentRoute, 'admin.memo') ? 'filled text-primary' : 'text-[#739a4c] group-hover:text-primary' }}">mail</span>
                    <p class="text-text-main text-sm {{ str_starts_with($currentRoute, 'admin.memo') ? 'font-semibold' : 'font-medium' }} leading-normal">Internal Memo</p>
                </div>
                <span class="material-symbols-outlined text-[18px] text-text-secondary transition-transform duration-200" :class="open ? 'rotate-180' : ''">expand_more</span>
            </button>
            
            <!-- Submenu -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="ml-9 mt-1 flex flex-col gap-1">
                <a href="{{ route('admin.memo.index', 'agronomi') }}" 
                   class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm {{ $currentRoute === 'admin.memo.index' && request()->route('type') === 'agronomi' ? 'bg-[#edf3e7] font-semibold text-text-main' : 'text-text-secondary hover:bg-white hover:text-text-main hover:shadow-sm' }} transition-all">
                    <span class="w-1.5 h-1.5 rounded-full {{ $currentRoute === 'admin.memo.index' && request()->route('type') === 'agronomi' ? 'bg-primary' : 'bg-text-secondary/40' }}"></span>
                    Agronomi
                </a>
                <a href="{{ route('admin.memo.index', 'pabrik') }}" 
                   class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm {{ $currentRoute === 'admin.memo.index' && request()->route('type') === 'pabrik' ? 'bg-[#edf3e7] font-semibold text-text-main' : 'text-text-secondary hover:bg-white hover:text-text-main hover:shadow-sm' }} transition-all">
                    <span class="w-1.5 h-1.5 rounded-full {{ $currentRoute === 'admin.memo.index' && request()->route('type') === 'pabrik' ? 'bg-primary' : 'bg-text-secondary/40' }}"></span>
                    Pabrik
                </a>
            </div>
        </div>
    @else
        <!-- Officer Navigation -->
        <a href="{{ route('officer.dashboard') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ str_starts_with($currentRoute, 'officer.dashboard') ? 'bg-[#edf3e7]' : 'hover:bg-white hover:shadow-sm' }} transition-all group">
            <span class="material-symbols-outlined {{ str_starts_with($currentRoute, 'officer.dashboard') ? 'filled text-primary' : 'text-[#739a4c] group-hover:text-primary' }}">grid_view</span>
            <p class="text-text-main text-sm {{ str_starts_with($currentRoute, 'officer.dashboard') ? 'font-semibold' : 'font-medium' }} leading-normal">Dashboard</p>
        </a>
        
        <a href="{{ route('officer.harvests.create') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $currentRoute === 'officer.harvests.create' ? 'bg-[#edf3e7]' : 'hover:bg-white hover:shadow-sm' }} transition-all group">
            <span class="material-symbols-outlined {{ $currentRoute === 'officer.harvests.create' ? 'filled text-primary' : 'text-[#739a4c] group-hover:text-primary' }}">add_circle</span>
            <p class="text-text-main text-sm {{ $currentRoute === 'officer.harvests.create' ? 'font-semibold' : 'font-medium' }} leading-normal">Input Panen</p>
        </a>
        
        <a href="{{ route('officer.harvests.index') }}" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $currentRoute === 'officer.harvests.index' ? 'bg-[#edf3e7]' : 'hover:bg-white hover:shadow-sm' }} transition-all group">
            <span class="material-symbols-outlined {{ $currentRoute === 'officer.harvests.index' ? 'filled text-primary' : 'text-[#739a4c] group-hover:text-primary' }}">history</span>
            <p class="text-text-main text-sm {{ $currentRoute === 'officer.harvests.index' ? 'font-semibold' : 'font-medium' }} leading-normal">Riwayat</p>
        </a>
    @endif
</nav>
