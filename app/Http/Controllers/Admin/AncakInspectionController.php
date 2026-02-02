<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AncakInspection;
use App\Models\AncakInspectionRow;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AncakInspectionController extends Controller
{
    /**
     * Display a listing of inspections.
     */
    public function index(Request $request)
    {
        $query = AncakInspection::with(['division', 'block']);

        // Filter by division
        if ($request->filled('division_id')) {
            $query->where('division_id', $request->division_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('inspection_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('inspection_date', '<=', $request->date_to);
        }

        $inspections = $query->latest('inspection_date')
            ->paginate(15)
            ->withQueryString();

        $divisions = Division::active()->orderBy('name')->get();

        return view('admin.ancak.index', compact('inspections', 'divisions'));
    }

    /**
     * Show the form for creating a new inspection.
     */
    public function create()
    {
        $divisions = Division::active()->with(['blocks' => function($query) {
            $query->where('status', 'active')->orderBy('code');
        }])->orderBy('name')->get();

        return view('admin.ancak.create', compact('divisions'));
    }

    /**
     * Store a newly created inspection in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'qc_name' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
            'block_id' => 'required|exists:blocks,id',
            'inspection_date' => 'required|date',
            'planting_year' => 'nullable|integer|min:1900|max:2100',
            'seed_type' => 'nullable|string|max:255',
            'sph' => 'nullable|integer|min:0',
            'foreman_name' => 'nullable|string|max:255',
            'clerk_name' => 'nullable|string|max:255',
            'findings' => 'nullable|string',
            'response' => 'nullable|string',
            'target_completion' => 'nullable|date',
            'evidence' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'rows' => 'required|array|min:1',
            'rows.*.harvester_name' => 'nullable|string|max:255',
            'rows.*.ancak_location' => 'nullable|string|max:255',
            'rows.*.bunch_count' => 'nullable|integer|min:0',
            'rows.*.bt_pkk' => 'nullable|integer|min:0',
            'rows.*.tph_number' => 'nullable|string|max:255',
            'rows.*.apd_status' => 'required|in:lengkap,tidak',
            'rows.*.fine_amount' => 'nullable|integer|min:0',
        ]);

        DB::beginTransaction();
        try {
            // Handle file upload
            $evidencePath = null;
            if ($request->hasFile('evidence')) {
                $evidencePath = $request->file('evidence')->store('ancak-evidence', 'public');
            }

            // Create inspection
            $inspection = AncakInspection::create([
                'qc_name' => $validated['qc_name'],
                'division_id' => $validated['division_id'],
                'block_id' => $validated['block_id'],
                'inspection_date' => $validated['inspection_date'],
                'planting_year' => $validated['planting_year'] ?? null,
                'seed_type' => $validated['seed_type'] ?? null,
                'sph' => $validated['sph'] ?? null,
                'foreman_name' => $validated['foreman_name'] ?? null,
                'clerk_name' => $validated['clerk_name'] ?? null,
                'findings' => $validated['findings'] ?? null,
                'response' => $validated['response'] ?? null,
                'target_completion' => $validated['target_completion'] ?? null,
                'evidence_path' => $evidencePath,
                'status' => 'pending',
            ]);

            // Create rows
            foreach ($validated['rows'] as $index => $rowData) {
                $inspection->rows()->create([
                    'row_number' => $index + 1,
                    'harvester_name' => $rowData['harvester_name'] ?? null,
                    'ancak_location' => $rowData['ancak_location'] ?? null,
                    'bunch_count' => $rowData['bunch_count'] ?? 0,
                    'bt_pkk' => $rowData['bt_pkk'] ?? 0,
                    'tph_number' => $rowData['tph_number'] ?? null,
                    'apd_status' => $rowData['apd_status'],
                    'fine_amount' => $rowData['fine_amount'] ?? 0,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.ancak.index')
                ->with('success', 'Data inspeksi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified inspection.
     */
    public function show(AncakInspection $ancak)
    {
        $ancak->load(['division', 'block', 'rows']);
        return view('admin.ancak.show', compact('ancak'));
    }

    /**
     * Show the form for editing the specified inspection.
     */
    public function edit(AncakInspection $ancak)
    {
        $ancak->load('rows');
        
        $divisions = Division::active()->with(['blocks' => function($query) {
            $query->where('status', 'active')->orderBy('code');
        }])->orderBy('name')->get();

        return view('admin.ancak.edit', compact('ancak', 'divisions'));
    }

    /**
     * Update the specified inspection in storage.
     */
    public function update(Request $request, AncakInspection $ancak)
    {
        $validated = $request->validate([
            'qc_name' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
            'block_id' => 'required|exists:blocks,id',
            'inspection_date' => 'required|date',
            'planting_year' => 'nullable|integer|min:1900|max:2100',
            'seed_type' => 'nullable|string|max:255',
            'sph' => 'nullable|integer|min:0',
            'foreman_name' => 'nullable|string|max:255',
            'clerk_name' => 'nullable|string|max:255',
            'findings' => 'nullable|string',
            'response' => 'nullable|string',
            'target_completion' => 'nullable|date',
            'status' => 'required|in:pending,completed',
            'evidence' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'rows' => 'required|array|min:1',
            'rows.*.harvester_name' => 'nullable|string|max:255',
            'rows.*.ancak_location' => 'nullable|string|max:255',
            'rows.*.bunch_count' => 'nullable|integer|min:0',
            'rows.*.bt_pkk' => 'nullable|integer|min:0',
            'rows.*.tph_number' => 'nullable|string|max:255',
            'rows.*.apd_status' => 'required|in:lengkap,tidak',
            'rows.*.fine_amount' => 'nullable|integer|min:0',
        ]);

        DB::beginTransaction();
        try {
            // Handle file upload
            $evidencePath = $ancak->evidence_path;
            if ($request->hasFile('evidence')) {
                // Delete old file
                if ($ancak->evidence_path) {
                    Storage::disk('public')->delete($ancak->evidence_path);
                }
                $evidencePath = $request->file('evidence')->store('ancak-evidence', 'public');
            }

            // Update inspection
            $ancak->update([
                'qc_name' => $validated['qc_name'],
                'division_id' => $validated['division_id'],
                'block_id' => $validated['block_id'],
                'inspection_date' => $validated['inspection_date'],
                'planting_year' => $validated['planting_year'] ?? null,
                'seed_type' => $validated['seed_type'] ?? null,
                'sph' => $validated['sph'] ?? null,
                'foreman_name' => $validated['foreman_name'] ?? null,
                'clerk_name' => $validated['clerk_name'] ?? null,
                'findings' => $validated['findings'] ?? null,
                'response' => $validated['response'] ?? null,
                'target_completion' => $validated['target_completion'] ?? null,
                'evidence_path' => $evidencePath,
                'status' => $validated['status'],
            ]);

            // Delete old rows and create new ones
            $ancak->rows()->delete();
            foreach ($validated['rows'] as $index => $rowData) {
                $ancak->rows()->create([
                    'row_number' => $index + 1,
                    'harvester_name' => $rowData['harvester_name'] ?? null,
                    'ancak_location' => $rowData['ancak_location'] ?? null,
                    'bunch_count' => $rowData['bunch_count'] ?? 0,
                    'bt_pkk' => $rowData['bt_pkk'] ?? 0,
                    'tph_number' => $rowData['tph_number'] ?? null,
                    'apd_status' => $rowData['apd_status'],
                    'fine_amount' => $rowData['fine_amount'] ?? 0,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.ancak.index')
                ->with('success', 'Data inspeksi berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified inspection from storage.
     */
    public function destroy(AncakInspection $ancak)
    {
        // Delete evidence file
        if ($ancak->evidence_path) {
            Storage::disk('public')->delete($ancak->evidence_path);
        }

        $ancak->delete();

        return redirect()->route('admin.ancak.index')
            ->with('success', 'Data inspeksi berhasil dihapus.');
    }
}
