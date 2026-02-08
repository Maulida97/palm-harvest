<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InternalMemo;
use Illuminate\Http\Request;

class PublicMemoController extends Controller
{
    /**
     * Display a listing of all published memos (public view).
     */
    public function index(Request $request)
    {
        $query = InternalMemo::query();
        
        // Filter by type if provided
        if ($request->filled('type') && in_array($request->type, ['agronomi', 'pabrik'])) {
            $query->where('type', $request->type);
        }
        
        // Search by no_item
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('no_item', 'like', "%{$search}%");
        }
        
        $memos = $query->latest('berlaku')->paginate(12);
        
        return view('public.memo.index', compact('memos'));
    }

    /**
     * Display the specified memo (public view).
     */
    public function show(InternalMemo $memo)
    {
        return view('public.memo.show', compact('memo'));
    }
}
