<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BapMaterial;
use App\Models\BapMaterialPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BapMaterialController extends Controller
{
    public function index(Request $request)
    {
        $query = BapMaterial::with(['dokumentasiPhotos', 'suratJalanPhotos']);

        if ($request->filled('jenis_material')) {
            $query->where('jenis_material', 'like', '%' . $request->jenis_material . '%');
        }

        if ($request->filled('date_from')) {
            $query->whereDate('inspection_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('inspection_date', '<=', $request->date_to);
        }

        $materials = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.bap-material.index', compact('materials'));
    }

    public function create()
    {
        return view('admin.bap-material.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'qc_name' => 'required|string|max:255',
            'jenis_material' => 'required|string|max:255',
            'panjang' => 'nullable|numeric|min:0',
            'lebar' => 'nullable|numeric|min:0',
            'tinggi' => 'nullable|numeric|min:0',
            'keterangan' => 'nullable|string',
            'inspection_date' => 'required|date',
            'photos_dokumentasi.*' => 'image|mimes:jpeg,png,jpg|max:5120',
            'photos_surat_jalan.*' => 'image|mimes:jpeg,png,jpg|max:5120',
        ]);

        DB::beginTransaction();

        try {
            $material = BapMaterial::create($validated);

            // Upload foto dokumentasi
            if ($request->hasFile('photos_dokumentasi')) {
                foreach ($request->file('photos_dokumentasi') as $photo) {
                    $path = $photo->store('bap-materials/dokumentasi', 'public');
                    $material->photos()->create([
                        'type' => 'dokumentasi',
                        'photo_path' => $path
                    ]);
                }
            }

            // Upload foto surat jalan
            if ($request->hasFile('photos_surat_jalan')) {
                foreach ($request->file('photos_surat_jalan') as $photo) {
                    $path = $photo->store('bap-materials/surat-jalan', 'public');
                    $material->photos()->create([
                        'type' => 'surat_jalan',
                        'photo_path' => $path
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.bap-material.index')
                ->with('success', 'Data BAP Material berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function show(BapMaterial $bapMaterial)
    {
        $bapMaterial->load(['dokumentasiPhotos', 'suratJalanPhotos']);
        return view('admin.bap-material.show', compact('bapMaterial'));
    }

    public function edit(BapMaterial $bapMaterial)
    {
        $bapMaterial->load(['dokumentasiPhotos', 'suratJalanPhotos']);
        return view('admin.bap-material.edit', compact('bapMaterial'));
    }

    public function update(Request $request, BapMaterial $bapMaterial)
    {
        $validated = $request->validate([
            'qc_name' => 'required|string|max:255',
            'jenis_material' => 'required|string|max:255',
            'panjang' => 'nullable|numeric|min:0',
            'lebar' => 'nullable|numeric|min:0',
            'tinggi' => 'nullable|numeric|min:0',
            'keterangan' => 'nullable|string',
            'inspection_date' => 'required|date',
            'photos_dokumentasi.*' => 'image|mimes:jpeg,png,jpg|max:5120',
            'photos_surat_jalan.*' => 'image|mimes:jpeg,png,jpg|max:5120',
        ]);

        DB::beginTransaction();

        try {
            $bapMaterial->update($validated);

            // Handle photo deletions
            if ($request->filled('delete_photos')) {
                $deleteIds = explode(',', $request->delete_photos);
                $photosToDelete = BapMaterialPhoto::whereIn('id', $deleteIds)
                    ->where('bap_material_id', $bapMaterial->id)
                    ->get();

                foreach ($photosToDelete as $photo) {
                    Storage::disk('public')->delete($photo->photo_path);
                    $photo->delete();
                }
            }

            // Add new dokumentasi photos
            if ($request->hasFile('photos_dokumentasi')) {
                foreach ($request->file('photos_dokumentasi') as $photo) {
                    $path = $photo->store('bap-materials/dokumentasi', 'public');
                    $bapMaterial->photos()->create([
                        'type' => 'dokumentasi',
                        'photo_path' => $path
                    ]);
                }
            }

            // Add new surat jalan photos
            if ($request->hasFile('photos_surat_jalan')) {
                foreach ($request->file('photos_surat_jalan') as $photo) {
                    $path = $photo->store('bap-materials/surat-jalan', 'public');
                    $bapMaterial->photos()->create([
                        'type' => 'surat_jalan',
                        'photo_path' => $path
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.bap-material.index')
                ->with('success', 'Data BAP Material berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy(BapMaterial $bapMaterial)
    {
        foreach ($bapMaterial->photos as $photo) {
            Storage::disk('public')->delete($photo->photo_path);
        }

        $bapMaterial->delete();

        return redirect()->route('admin.bap-material.index')
            ->with('success', 'Data BAP Material berhasil dihapus.');
    }
}
