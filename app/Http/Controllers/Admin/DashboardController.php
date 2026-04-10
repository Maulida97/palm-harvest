<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Division;
use App\Models\Fertilizer;
use App\Models\User;
use App\Models\AncakInspection;
use App\Models\BapMaterial;
use App\Models\InternalMemo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Master Data counts
        $totalDivisions = Division::count();
        $totalBlocks = Block::count();
        $activeBlocks = Block::where('status', 'active')->count();
        $totalFertilizers = Fertilizer::count();
        $totalOfficers = User::where('role', 'officer')->count();

        // Activity counts
        $totalAncak = AncakInspection::count();
        $totalBapMaterial = BapMaterial::count();
        $totalMemos = InternalMemo::count();

        return view('admin.dashboard', compact(
            'totalDivisions',
            'totalBlocks',
            'activeBlocks',
            'totalFertilizers',
            'totalOfficers',
            'totalAncak',
            'totalBapMaterial',
            'totalMemos'
        ));
    }
}
