<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InternalMemo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
     * Remove the specified memo from storage.
     */
    public function destroy(string $type, InternalMemo $memo)
    {
        $this->validateType($type);
        
        // Ensure memo matches the type
        if ($memo->type !== $type) {
            abort(404);
        }

        // Delete file if exists
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
