<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Harvest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Today's harvest by this officer
        $todayHarvest = $user->harvests()
            ->whereDate('harvest_date', today())
            ->sum('weight_kg');

        // This month's harvest
        $monthHarvest = $user->harvests()
            ->whereMonth('harvest_date', now()->month)
            ->whereYear('harvest_date', now()->year)
            ->sum('weight_kg');

        // Total harvests recorded
        $totalEntries = $user->harvests()->count();

        // Pending verification count
        $pendingCount = $user->harvests()
            ->where('verification_status', 'pending')
            ->count();

        // Recent harvests
        $recentHarvests = $user->harvests()
            ->with('block')
            ->latest('harvest_date')
            ->take(5)
            ->get();

        // Active blocks for quick entry
        $activeBlocks = Block::where('status', 'active')->get();

        return view('officer.dashboard', compact(
            'todayHarvest',
            'monthHarvest',
            'totalEntries',
            'pendingCount',
            'recentHarvests',
            'activeBlocks'
        ));
    }
}
