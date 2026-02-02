<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Harvest;
use Illuminate\Http\Request;

class HoldQcController extends Controller
{
    /**
     * Display a listing of HOLD/Pending QC data.
     */
    public function index(Request $request)
    {
        $query = Harvest::with(['block', 'officer'])
            ->where('verification_status', 'pending'); // Only pending/hold items

        // Filter by block
        if ($request->filled('block_id')) {
            $query->where('block_id', $request->block_id);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('harvest_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('harvest_date', '<=', $request->date_to);
        }

        $harvests = $query->latest('harvest_date')
            ->latest('created_at')
            ->paginate(15);

        $blocks = Block::where('status', 'active')->get();

        return view('admin.holdqc.index', compact('harvests', 'blocks'));
    }

    /**
     * Approve/Verify a hold QC entry.
     */
    public function approve(Request $request, Harvest $holdqc)
    {
        $holdqc->update([
            'verification_status' => 'verified',
            'verified_by' => auth()->id(),
            'verified_at' => now(),
        ]);

        return redirect()->route('admin.holdqc.index')
            ->with('success', 'Data QC berhasil diverifikasi.');
    }

    /**
     * Reject a hold QC entry.
     */
    public function reject(Request $request, Harvest $holdqc)
    {
        $request->validate([
            'notes' => 'nullable|string|max:500',
        ]);

        $holdqc->update([
            'verification_status' => 'rejected',
            'verified_by' => auth()->id(),
            'verified_at' => now(),
            'notes' => $request->notes ?? $holdqc->notes,
        ]);

        return redirect()->route('admin.holdqc.index')
            ->with('success', 'Data QC ditolak.');
    }

    /**
     * Remove the specified hold QC entry from storage.
     */
    public function destroy(Harvest $holdqc)
    {
        $holdqc->delete();

        return redirect()->route('admin.holdqc.index')
            ->with('success', 'Data QC berhasil dihapus.');
    }
}
