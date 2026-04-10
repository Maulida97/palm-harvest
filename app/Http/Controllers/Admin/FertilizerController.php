<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fertilizer;
use Illuminate\Http\Request;

class FertilizerController extends Controller
{
    /**
     * Display a listing of fertilizers.
     */
    public function index(Request $request)
    {
        $query = Fertilizer::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $fertilizers = $query->latest()->paginate(15)->withQueryString();

        return view('admin.fertilizers.index', compact('fertilizers'));
    }

    /**
     * Show the form for creating a new fertilizer.
     */
    public function create()
    {
        return view('admin.fertilizers.create');
    }

    /**
     * Store a newly created fertilizer in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:fertilizers,name',
            'price_per_kg' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        Fertilizer::create($validated);

        return redirect()->route('admin.fertilizers.index')
            ->with('success', 'Data pupuk berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified fertilizer.
     */
    public function edit(Fertilizer $fertilizer)
    {
        return view('admin.fertilizers.edit', compact('fertilizer'));
    }

    /**
     * Update the specified fertilizer in storage.
     */
    public function update(Request $request, Fertilizer $fertilizer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:fertilizers,name,' . $fertilizer->id,
            'price_per_kg' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        $fertilizer->update($validated);

        return redirect()->route('admin.fertilizers.index')
            ->with('success', 'Data pupuk berhasil diperbarui.');
    }

    /**
     * Remove the specified fertilizer from storage.
     */
    public function destroy(Fertilizer $fertilizer)
    {
        $fertilizer->delete();

        return redirect()->route('admin.fertilizers.index')
            ->with('success', 'Data pupuk berhasil dihapus.');
    }
}
