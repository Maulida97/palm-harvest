<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InternalMemo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class InternalMemoController extends Controller
{
    /**
     * Display a listing of memos by type.
     */
    public function index(string $type)
    {
        $this->validateType($type);

        $memos = InternalMemo::where('type', $type)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.memo.index', compact('memos', 'type'));
    }

    /**
     * Show the form for creating a new memo.
     */
    public function create(string $type)
    {
        $this->validateType($type);

        return view('admin.memo.create', compact('type'));
    }

    /**
     * Store a newly created memo in storage.
     */
    public function store(Request $request, string $type)
    {
        $this->validateType($type);

        $validated = $request->validate([
            'no_item' => 'required|string|max:255',
            'berlaku' => 'required|date',
            'tidak_berlaku' => 'nullable|date|after_or_equal:berlaku',
            'tanggal_revisi' => 'nullable|date',
            'file' => 'required|file|mimes:pdf|max:5120', // max 5MB
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('memos', 'public');
        }

        InternalMemo::create([
            'type' => $type,
            'no_item' => $validated['no_item'],
            'berlaku' => $validated['berlaku'],
            'tidak_berlaku' => $validated['tidak_berlaku'] ?? null,
            'tanggal_revisi' => $validated['tanggal_revisi'] ?? null,
            'file_path' => $filePath,
            'created_by' => auth()->id(),
        ]);

        $typeName = $type === 'agronomi' ? 'Agronomi' : 'Pabrik';
        return redirect()
            ->route('admin.memo.index', $type)
            ->with('success', "Internal Memo {$typeName} berhasil ditambahkan.");
    }

    /**
     * Display the specified memo.
     */
    public function show(string $type, InternalMemo $memo)
    {
        $this->validateType($type);
        
        // Ensure memo matches the type
        if ($memo->type !== $type) {
            abort(404);
        }

        return view('admin.memo.show', compact('memo', 'type'));
    }

    /**
     * Show the form for editing the specified memo.
     */
    public function edit(string $type, InternalMemo $memo)
    {
        $this->validateType($type);

        if ($memo->type !== $type) {
            abort(404);
        }

        return view('admin.memo.edit', compact('memo', 'type'));
    }

    /**
     * Update the specified memo in storage.
     */
    public function update(Request $request, string $type, InternalMemo $memo)
    {
        $this->validateType($type);

        if ($memo->type !== $type) {
            abort(404);
        }

        $validated = $request->validate([
            'no_item' => 'required|string|max:255',
            'berlaku' => 'required|date',
            'tidak_berlaku' => 'nullable|date|after_or_equal:berlaku',
            'tanggal_revisi' => 'nullable|date',
            'file' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $memo->no_item = $validated['no_item'];
        $memo->berlaku = $validated['berlaku'];
        $memo->tidak_berlaku = $validated['tidak_berlaku'] ?? null;
        $memo->tanggal_revisi = $validated['tanggal_revisi'] ?? null;

        if ($request->hasFile('file')) {
            // Delete old file
            if ($memo->file_path) {
                Storage::disk('public')->delete($memo->file_path);
            }
            $memo->file_path = $request->file('file')->store('memos', 'public');
        }

        $memo->save();

        $typeName = $type === 'agronomi' ? 'Agronomi' : 'Pabrik';
        return redirect()
            ->route('admin.memo.index', $type)
            ->with('success', "Internal Memo {$typeName} berhasil diperbarui.");
    }

    /**
     * Remove the specified memo from storage.
     */
    public function destroy(string $type, InternalMemo $memo)
    {
        $this->validateType($type);
        
        if ($memo->type !== $type) {
            abort(404);
        }

        if ($memo->file_path) {
            Storage::disk('public')->delete($memo->file_path);
        }

        $memo->delete();

        $typeName = $type === 'agronomi' ? 'Agronomi' : 'Pabrik';
        return redirect()
            ->route('admin.memo.index', $type)
            ->with('success', "Internal Memo {$typeName} berhasil dihapus.");
    }

    /**
     * Validate memo type.
     */
    private function validateType(string $type): void
    {
        if (!in_array($type, ['agronomi', 'pabrik'])) {
            abort(404, 'Tipe memo tidak valid.');
        }
    }
}
