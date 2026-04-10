<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FertilizerSpotcheck;
use App\Models\Division;
use App\Models\Fertilizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FertilizerSpotcheckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = FertilizerSpotcheck::with(['division', 'block', 'fertilizer']);

        // Filters
        if ($request->filled('division_id')) {
            $query->where('division_id', $request->division_id);
        }
        if ($request->filled('block_id')) {
            $query->where('block_id', $request->block_id);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('inspection_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('inspection_date', '<=', $request->date_to);
        }

        $spotchecks = $query->latest('inspection_date')->paginate(15)->withQueryString();
        $divisions = Division::active()->with(['blocks' => function ($query) {
            $query->where('status', 'active')->orderBy('code');
        }])->orderBy('name')->get();

        return view('admin.fertilizer-spotchecks.index', compact('spotchecks', 'divisions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisions = Division::active()->with(['blocks' => function ($query) {
            $query->where('status', 'active')->orderBy('code');
        }])->orderBy('name')->get();
        
        $fertilizers = Fertilizer::active()->orderBy('name')->get();

        return view('admin.fertilizer-spotchecks.create', compact('divisions', 'fertilizers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'block_id' => 'required|exists:blocks,id',
            'inspection_date' => 'required|date',
            'worker_name' => 'nullable|string|max:255',
            'fertilizer_id' => 'required|exists:fertilizers,id',
            'unapplied_kg' => 'required|numeric|min:0|max:99999.99',
            'findings' => 'nullable|string',
            'status' => 'required|in:pending,completed',
            'evidence_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $fertilizer = Fertilizer::findOrFail($validated['fertilizer_id']);
        
        // Calculate penalty
        $penalty_amount = $validated['unapplied_kg'] * $fertilizer->price_per_kg;

        $imagePath = null;
        if ($request->hasFile('evidence_path')) {
            $imagePath = $request->file('evidence_path')->store('fertilizer_spotchecks', 'public');
        }

        FertilizerSpotcheck::create([
            'qc_name' => auth()->user()->name,
            'division_id' => $validated['division_id'],
            'block_id' => $validated['block_id'],
            'inspection_date' => $validated['inspection_date'],
            'fertilizer_id' => $validated['fertilizer_id'],
            'worker_name' => $validated['worker_name'],
            'unapplied_kg' => $validated['unapplied_kg'],
            'penalty_amount' => $penalty_amount,
            'findings' => $validated['findings'],
            'evidence_path' => $imagePath,
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.fertilizer-spotchecks.index')
            ->with('success', 'Data Spotchek Pemupukan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FertilizerSpotcheck $fertilizer_spotcheck)
    {
        $fertilizer_spotcheck->load(['division', 'block', 'fertilizer']);
        return view('admin.fertilizer-spotchecks.show', compact('fertilizer_spotcheck'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FertilizerSpotcheck $fertilizer_spotcheck)
    {
        $divisions = Division::active()->with(['blocks' => function ($query) {
            $query->where('status', 'active')->orderBy('code');
        }])->orderBy('name')->get();
        
        $fertilizers = Fertilizer::active()->orderBy('name')->get();

        return view('admin.fertilizer-spotchecks.edit', compact('fertilizer_spotcheck', 'divisions', 'fertilizers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FertilizerSpotcheck $fertilizer_spotcheck)
    {
        $validated = $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'block_id' => 'required|exists:blocks,id',
            'inspection_date' => 'required|date',
            'worker_name' => 'nullable|string|max:255',
            'fertilizer_id' => 'required|exists:fertilizers,id',
            'unapplied_kg' => 'required|numeric|min:0|max:99999.99',
            'findings' => 'nullable|string',
            'status' => 'required|in:pending,completed',
            'evidence_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $fertilizer = Fertilizer::findOrFail($validated['fertilizer_id']);
        
        // Recalculate penalty
        $penalty_amount = $validated['unapplied_kg'] * $fertilizer->price_per_kg;

        $imagePath = $fertilizer_spotcheck->evidence_path;
        if ($request->hasFile('evidence_path')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('evidence_path')->store('fertilizer_spotchecks', 'public');
        }

        $fertilizer_spotcheck->update([
            'division_id' => $validated['division_id'],
            'block_id' => $validated['block_id'],
            'inspection_date' => $validated['inspection_date'],
            'fertilizer_id' => $validated['fertilizer_id'],
            'worker_name' => $validated['worker_name'],
            'unapplied_kg' => $validated['unapplied_kg'],
            'penalty_amount' => $penalty_amount,
            'findings' => $validated['findings'],
            'evidence_path' => $imagePath,
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.fertilizer-spotchecks.index')
            ->with('success', 'Data Spotchek Pemupukan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FertilizerSpotcheck $fertilizer_spotcheck)
    {
        if ($fertilizer_spotcheck->evidence_path && Storage::disk('public')->exists($fertilizer_spotcheck->evidence_path)) {
            Storage::disk('public')->delete($fertilizer_spotcheck->evidence_path);
        }

        $fertilizer_spotcheck->delete();

        return redirect()->route('admin.fertilizer-spotchecks.index')
            ->with('success', 'Data Spotchek Pemupukan berhasil dihapus.');
    }
}
