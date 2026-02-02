<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Division;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    /**
     * Display a listing of the blocks.
     */
    public function index(Request $request)
    {
        $query = Block::with('division');

        // Filter by division
        if ($request->filled('division_id')) {
            $query->where('division_id', $request->division_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by code or name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%");
            });
        }

        $blocks = $query->orderBy('division_id')
            ->orderBy('code')
            ->paginate(20)
            ->withQueryString();

        $divisions = Division::active()->orderBy('name')->get();

        return view('admin.blocks.index', compact('blocks', 'divisions'));
    }

    /**
     * Show the form for creating a new block.
     */
    public function create()
    {
        $divisions = Division::active()->orderBy('name')->get();
        return view('admin.blocks.create', compact('divisions'));
    }

    /**
     * Store a newly created block in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'code' => 'required|string|max:20|unique:blocks',
            'name' => 'required|string|max:255',
            'area_hectares' => 'nullable|numeric|min:0',
            'tree_count' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
        ]);

        Block::create($validated);

        return redirect()->route('admin.blocks.index')
            ->with('success', 'Blok berhasil ditambahkan.');
    }

    /**
     * Display the specified block.
     */
    public function show(Block $block)
    {
        $block->load(['division', 'harvests' => function ($query) {
            $query->with('officer')->latest('harvest_date')->take(10);
        }]);

        return view('admin.blocks.show', compact('block'));
    }

    /**
     * Show the form for editing the specified block.
     */
    public function edit(Block $block)
    {
        $divisions = Division::active()->orderBy('name')->get();
        return view('admin.blocks.edit', compact('block', 'divisions'));
    }

    /**
     * Update the specified block in storage.
     */
    public function update(Request $request, Block $block)
    {
        $validated = $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'code' => 'required|string|max:20|unique:blocks,code,' . $block->id,
            'name' => 'required|string|max:255',
            'area_hectares' => 'nullable|numeric|min:0',
            'tree_count' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
        ]);

        $block->update($validated);

        return redirect()->route('admin.blocks.index')
            ->with('success', 'Blok berhasil diperbarui.');
    }

    /**
     * Remove the specified block from storage.
     */
    public function destroy(Block $block)
    {
        $block->delete();

        return redirect()->route('admin.blocks.index')
            ->with('success', 'Blok berhasil dihapus.');
    }
}
