<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Harvest;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display reports page.
     */
    public function index(Request $request)
    {
        $period = $request->get('period', 'month');
        $blockId = $request->get('block_id');

        // Get date range based on period
        switch ($period) {
            case 'week':
                $startDate = now()->startOfWeek();
                $endDate = now()->endOfWeek();
                break;
            case 'month':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                break;
            case 'year':
                $startDate = now()->startOfYear();
                $endDate = now()->endOfYear();
                break;
            case 'custom':
                $startDate = $request->get('start_date') ? now()->parse($request->start_date) : now()->startOfMonth();
                $endDate = $request->get('end_date') ? now()->parse($request->end_date) : now();
                break;
            default:
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
        }

        // Build query
        $query = Harvest::verified()
            ->whereBetween('harvest_date', [$startDate, $endDate]);

        if ($blockId) {
            $query->where('block_id', $blockId);
        }

        // Summary statistics
        $totalHarvest = $query->sum('weight_kg');
        $harvestCount = $query->count();
        $avgHarvest = $harvestCount > 0 ? $totalHarvest / $harvestCount : 0;

        // Group by block
        $harvestByBlock = Harvest::verified()
            ->whereBetween('harvest_date', [$startDate, $endDate])
            ->when($blockId, fn($q) => $q->where('block_id', $blockId))
            ->selectRaw('block_id, SUM(weight_kg) as total_kg, COUNT(*) as count')
            ->groupBy('block_id')
            ->with('block')
            ->get();

        // Group by date (for chart)
        $harvestByDate = Harvest::verified()
            ->whereBetween('harvest_date', [$startDate, $endDate])
            ->when($blockId, fn($q) => $q->where('block_id', $blockId))
            ->selectRaw('DATE(harvest_date) as date, SUM(weight_kg) as total_kg')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Get all blocks for filter
        $blocks = Block::where('status', 'active')->get();

        return view('admin.reports.index', compact(
            'period',
            'startDate',
            'endDate',
            'totalHarvest',
            'harvestCount',
            'avgHarvest',
            'harvestByBlock',
            'harvestByDate',
            'blocks',
            'blockId'
        ));
    }

    /**
     * Export report to CSV.
     */
    public function export(Request $request)
    {
        $startDate = $request->get('start_date', now()->startOfMonth());
        $endDate = $request->get('end_date', now());
        $blockId = $request->get('block_id');

        $harvests = Harvest::with(['block', 'officer'])
            ->verified()
            ->whereBetween('harvest_date', [$startDate, $endDate])
            ->when($blockId, fn($q) => $q->where('block_id', $blockId))
            ->orderBy('harvest_date')
            ->get();

        $filename = 'laporan_panen_' . now()->format('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($harvests) {
            $file = fopen('php://output', 'w');
            
            // Header
            fputcsv($file, ['Tanggal', 'Blok', 'Petugas', 'Berat (Kg)', 'Status', 'Catatan']);
            
            foreach ($harvests as $harvest) {
                fputcsv($file, [
                    $harvest->harvest_date->format('d/m/Y'),
                    $harvest->block->code . ' - ' . $harvest->block->name,
                    $harvest->officer->name,
                    $harvest->weight_kg,
                    $harvest->verification_status,
                    $harvest->notes ?? '-',
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
