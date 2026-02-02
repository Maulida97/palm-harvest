@php
    $isAdmin = auth()->user()->isAdmin();
    $currentRoute = Route::currentRouteName();
@endphp

<aside class="w-64 bg-surface-light border-r border-surface-border flex-shrink-0 flex flex-col justify-between h-full p-4">
    <div class="flex flex-col gap-8">
        <!-- Brand -->
        <div class="flex gap-3 px-2 pt-2">
            <div class="bg-primary/20 rounded-full size-10 flex items-center justify-center">
                <span class="material-symbols-outlined text-primary">eco</span>
            </div>
            <div class="flex flex-col justify-center">
                <h1 class="text-text-main text-base font-bold leading-none">PalmHarvest</h1>
                <p class="text-text-secondary text-xs font-normal mt-1">{{ $isAdmin ? 'Admin Console' : 'Officer Panel' }}</p>
            </div>
        </div>
        
        <!-- Navigation -->
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
