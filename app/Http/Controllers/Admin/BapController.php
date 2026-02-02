<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Division;
use App\Models\Harvest;
use Illuminate\Http\Request;

class BapController extends Controller
{
    /**
     * Display a listing of BAP/QC data.
     */
    public function index(Request $request)
    {
        $query = Harvest::with(['block.division', 'officer']);

        // Filter by division
        if ($request->filled('division_id')) {
            $query->whereHas('block', function($q) use ($request) {
                $q->where('division_id', $request->division_id);
            });
        }

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

        $harvests = $query->latest('created_at')
            ->paginate(15);

        $divisions = Division::active()->with(['blocks' => function($query) {
            $query->where('status', 'active')->orderBy('code');
        }])->orderBy('name')->get();

        return view('admin.bap.index', compact('harvests', 'divisions'));
    }

    /**
     * Show the form for creating a new BAP entry.
     */
    public function create()
    {
        $divisions = Division::active()->with(['blocks' => function($query) {
            $query->where('status', 'active')->orderBy('code');
        }])->orderBy('name')->get();

        return view('admin.bap.create', compact('divisions'));
    }

    /**
     * Store a newly created BAP entry in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'block_id' => 'required|exists:blocks,id',
            'weight_kg' => 'required|numeric|min:0.01|max:99999.99',
            'harvest_date' => 'nullable|date',
            'notes' => 'nullable|string|max:500',
            'status' => 'nullable|in:verified,pending',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'no_spk' => 'nullable|string|max:100',
        ]);

        $status = $request->input('status', 'verified');
        $isVerified = $status === 'verified';

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('harvests', 'public');
        }

        Harvest::create([
            'block_id' => $validated['block_id'],
            'officer_id' => auth()->id(),
            'weight_kg' => $validated['weight_kg'],
            'harvest_date' => $validated['harvest_date'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'verification_status' => $status,
            'verified_by' => $isVerified ? auth()->id() : null,
            'verified_at' => $isVerified ? now() : null,
            'image' => $imagePath,
            'no_spk' => $validated['no_spk'] ?? null,
        ]);

        // Redirect based on status
        if ($status === 'pending') {
            return redirect()->route('admin.holdqc.index')
                ->with('success', 'Data QC ditambahkan dengan status HOLD.');
        }

        return redirect()->route('admin.bap.index')
            ->with('success', 'Data QC berhasil ditambahkan.');
    }

    /**
     * Display the specified BAP entry.
     */
    public function show(Harvest $bap)
    {
        $bap->load(['block', 'officer', 'verifier']);
        
        return view('admin.bap.show', compact('bap'));
    }

    /**
     * Show the form for editing the specified BAP entry.
     */
    public function edit(Harvest $bap)
    {
        $divisions = Division::active()->with(['blocks' => function($query) {
            $query->where('status', 'active')->orderBy('code');
        }])->orderBy('name')->get();
        
        return view('admin.bap.edit', compact('bap', 'divisions'));
    }

    /**
     * Update the specified BAP entry in storage.
     */
    public function update(Request $request, Harvest $bap)
    {
        $validated = $request->validate([
            'block_id' => 'required|exists:blocks,id',
            'weight_kg' => 'required|numeric|min:0.01|max:99999.99',
            'harvest_date' => 'nullable|date',
            'notes' => 'nullable|string|max:500',
            'status' => 'nullable|in:verified,pending',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'no_spk' => 'nullable|string|max:100',
        ]);

        $status = $request->input('status', $bap->verification_status);
        $isVerified = $status === 'verified';

        // Handle image upload
        $imagePath = $bap->image; // Keep existing image by default
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($bap->image && \Storage::disk('public')->exists($bap->image)) {
                \Storage::disk('public')->delete($bap->image);
            }
            $imagePath = $request->file('image')->store('harvests', 'public');
        }

        $bap->update([
            'block_id' => $validated['block_id'],
            'weight_kg' => $validated['weight_kg'],
            'harvest_date' => $validated['harvest_date'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'verification_status' => $status,
            'verified_by' => $isVerified ? auth()->id() : null,
            'verified_at' => $isVerified ? now() : null,
            'image' => $imagePath,
            'no_spk' => $validated['no_spk'] ?? null,
        ]);

        if ($status === 'pending') {
            return redirect()->route('admin.holdqc.index')
                ->with('success', 'Data QC diupdate dengan status HOLD.');
        }

        return redirect()->route('admin.bap.index')
            ->with('success', 'Data QC berhasil diupdate.');
    }

    /**
     * Remove the specified BAP entry from storage.
     */
    public function destroy(Harvest $bap)
    {
        $bap->delete();

        return redirect()->route('admin.bap.index')
            ->with('success', 'Data QC berhasil dihapus.');
    }
}
