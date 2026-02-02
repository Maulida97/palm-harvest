<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Harvest;
use Illuminate\Http\Request;

class HarvestController extends Controller
{
    /**
     * Display a listing of officer's harvests.
     */
    public function index(Request $request)
    {
        $query = auth()->user()->harvests()->with('block');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('verification_status', $request->status);
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

        return view('officer.harvests.index', compact('harvests'));
    }

    /**
     * Show the form for creating a new harvest entry.
     */
    public function create()
    {
        $blocks = Block::where('status', 'active')->get();

        return view('officer.harvests.create', compact('blocks'));
    }

    /**
     * Store a newly created harvest in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'block_id' => 'required|exists:blocks,id',
            'weight_kg' => 'required|numeric|min:0.01|max:99999.99',
            'harvest_date' => 'required|date|before_or_equal:today',
            'notes' => 'nullable|string|max:500',
        ]);

        auth()->user()->harvests()->create([
            'block_id' => $validated['block_id'],
            'weight_kg' => $validated['weight_kg'],
            'harvest_date' => $validated['harvest_date'],
            'notes' => $validated['notes'] ?? null,
            'verification_status' => 'pending',
        ]);

        return redirect()->route('officer.harvests.index')
            ->with('success', 'Data panen berhasil dicatat.');
    }
}
