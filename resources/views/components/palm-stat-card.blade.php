@props(['title', 'value', 'unit' => '', 'icon', 'change' => null, 'changeLabel' => ''])

<div class="flex flex-col gap-2 rounded-xl p-5 bg-white border border-surface-border shadow-sm hover:shadow-md transition-shadow">
    <div class="flex justify-between items-start">
        <p class="text-text-secondary text-sm font-medium">{{ $title }}</p>
        <span class="material-symbols-outlined text-primary bg-primary/10 p-1 rounded-md text-[20px]">{{ $icon }}</span>
    </div>
    <p class="text-text-main tracking-tight text-3xl font-bold mt-1">
        {{ $value }}
        @if($unit)
            <span class="text-lg font-medium text-text-secondary">{{ $unit }}</span>
        @endif
    </p>
    @if($change !== null)
        <div class="flex items-center gap-1 mt-auto pt-2">
            @if($change > 0)
                <span class="material-symbols-outlined text-[#07881d] text-sm">trending_up</span>
                <p class="text-[#07881d] text-xs font-bold">+{{ $change }}%</p>
            @elseif($change < 0)
                <span class="material-symbols-outlined text-red-500 text-sm">trending_down</span>
                <p class="text-red-500 text-xs font-bold">{{ $change }}%</p>
            @else
                <span class="material-symbols-outlined text-text-secondary text-sm">remove</span>
                <p class="text-text-secondary text-xs font-bold">0%</p>
            @endif
            <p class="text-text-secondary text-xs ml-1">{{ $changeLabel }}</p>
        </div>
    @endif
</div>
