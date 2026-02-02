<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Harvest;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Today's statistics
        $todayHarvest = Harvest::whereDate('harvest_date', today())
            ->verified()
            ->sum('weight_kg');
        
        $todayHarvestChange = $this->calculateChange(
            $todayHarvest,
            Harvest::whereDate('harvest_date', today()->subDay())
                ->verified()
                ->sum('weight_kg')
        );

        // This month's statistics
        $monthHarvest = Harvest::thisMonth()->verified()->sum('weight_kg');
        $lastMonthHarvest = Harvest::whereMonth('harvest_date', now()->subMonth()->month)
            ->whereYear('harvest_date', now()->subMonth()->year)
            ->verified()
            ->sum('weight_kg');
        $monthHarvestChange = $this->calculateChange($monthHarvest, $lastMonthHarvest);

        // Active blocks
        $activeBlocks = Block::where('status', 'active')->count();
        $totalBlocks = Block::count();
        $totalDivisions = Block::distinct('name')->count('name');

        // Average daily harvest (last 30 days)
        $avgDailyHarvest = Harvest::where('harvest_date', '>=', now()->subDays(30))
            ->verified()
            ->avg('weight_kg') ?? 0;

        // Harvest by block (for bar chart)
        $harvestByBlock = Block::with(['harvests' => function ($query) {
            $query->thisMonth()->verified();
        }])->get()->map(function ($block) {
            return [
                'code' => $block->code,
                'name' => $block->name,
                'total_kg' => $block->harvests->sum('weight_kg'),
            ];
        });

        // Recent harvest entries
        $recentHarvests = Harvest::with(['block', 'officer'])
            ->latest('harvest_date')
            ->latest('created_at')
            ->take(10)
            ->get();

        // Daily harvest trend (last 30 days)
        $harvestTrend = Harvest::selectRaw('DATE(harvest_date) as date, SUM(weight_kg) as total')
            ->where('harvest_date', '>=', now()->subDays(30))
            ->verified()
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Counts for new dashboard
        $verifiedCount = Harvest::verified()->count();
        $pendingCount = Harvest::pending()->count();

        return view('admin.dashboard', compact(
            'todayHarvest',
            'todayHarvestChange',
            'monthHarvest',
            'monthHarvestChange',
            'activeBlocks',
            'totalBlocks',
            'totalDivisions',
            'avgDailyHarvest',
            'harvestByBlock',
            'recentHarvests',
            'harvestTrend',
            'verifiedCount',
            'pendingCount'
        ));
    }

    private function calculateChange($current, $previous): float
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        return round((($current - $previous) / $previous) * 100, 1);
    }
}
