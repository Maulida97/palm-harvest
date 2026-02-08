<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Harvest;
use App\Models\AncakInspection;
use App\Models\BapMaterial;
use Illuminate\Http\Request;

class PublicRekapController extends Controller
{
    /**
     * Display Harvest recap (public view).
     */
    public function bap(Request $request)
    {
        $query = Harvest::with(['block', 'officer']);
        
        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('harvest_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('harvest_date', '<=', $request->end_date);
        }
        
        // Filter by status
        if ($request->filled('status') && in_array($request->status, ['pending', 'verified', 'rejected'])) {
            $query->where('verification_status', $request->status);
        }
        
        $harvests = $query->latest('harvest_date')->paginate(15);
        
        return view('public.rekap.bap', compact('harvests'));
    }

    /**
     * Display Kebersihan Ancak recap (public view).
     */
    public function ancak(Request $request)
    {
        $query = AncakInspection::with(['division', 'block', 'rows']);
        
        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('inspection_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('inspection_date', '<=', $request->end_date);
        }
        
        $inspections = $query->latest('inspection_date')->paginate(15);
        
        return view('public.rekap.ancak', compact('inspections'));
    }

    /**
     * Show detail of Kebersihan Ancak (public view).
     */
    public function showAncak(AncakInspection $ancak)
    {
        $ancak->load(['division', 'block', 'rows']);
        return view('public.rekap.ancak-show', compact('ancak'));
    }

    /**
     * Display BAP Material recap (public view).
     */
    public function bapMaterial(Request $request)
    {
        $query = BapMaterial::with(['photos']);
        
        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('inspection_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('inspection_date', '<=', $request->end_date);
        }
        
        $materials = $query->latest('inspection_date')->paginate(15);
        
        return view('public.rekap.bap-material', compact('materials'));
    }

    /**
     * Show detail of BAP Material (public view).
     */
    public function showBapMaterial(BapMaterial $bapMaterial)
    {
        $bapMaterial->load(['photos', 'dokumentasiPhotos', 'suratJalanPhotos']);
        return view('public.rekap.bap-material-show', compact('bapMaterial'));
    }
}
