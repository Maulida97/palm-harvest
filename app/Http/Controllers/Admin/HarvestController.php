<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Harvest;
use Illuminate\Http\Request;

class HarvestController extends Controller
{
    /**
     * Display a listing of harvests.
     */
    public function index(Request $request)
    {
        $query = Harvest::with(['block', 'officer']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('verification_status', $request->status);
        }

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

        return view('admin.harvests.index', compact('harvests', 'blocks'));
    }

    /**
     * Display the specified harvest.
     */
    public function show(Harvest $harvest)
    {
        $harvest->load(['block', 'officer', 'verifier']);

        return view('admin.harvests.show', compact('harvest'));
    }

    /**
     * Verify a harvest entry.
     */
    public function verify(Request $request, Harvest $harvest)
    {
        $validated = $request->validate([
            'action' => 'required|in:verify,reject',
        ]);

        $harvest->verification_status = $validated['action'] === 'verify' ? 'verified' : 'rejected';
        $harvest->verified_by = auth()->id();
        $harvest->verified_at = now();
        $harvest->save();

        $message = $validated['action'] === 'verify' 
            ? 'Data panen berhasil diverifikasi.' 
            : 'Data panen ditolak.';

        return redirect()->back()->with('success', $message);
    }

    /**
     * Remove the specified harvest from storage.
     */
    public function destroy(Harvest $harvest)
    {
        $harvest->delete();

        return redirect()->route('admin.harvests.index')
            ->with('success', 'Data panen berhasil dihapus.');
    }
}
