<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class OfficerController extends Controller
{
    /**
     * Display a listing of officers.
     */
    public function index()
    {
        $officers = User::where('role', 'officer')
            ->latest()
            ->paginate(10);

        return view('admin.officers.index', compact('officers'));
    }

    /**
     * Show the form for creating a new officer.
     */
    public function create()
    {
        return view('admin.officers.create');
    }

    /**
     * Store a newly created officer in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username|alpha_dash',
            'jabatan' => 'nullable|string|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'name' => $validated['name'],
            'username' => $validated['username'],
            'jabatan' => $validated['jabatan'] ?? null,
            'email' => $validated['username'] . '@palmharvest.local',
            'password' => Hash::make($validated['password']),
            'role' => 'officer',
        ];

        if ($request->hasFile('profile_photo')) {
            $data['profile_photo'] = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        User::create($data);

        return redirect()->route('admin.officers.index')
            ->with('success', 'Anggota QC berhasil ditambahkan.');
    }

    /**
     * Display the specified officer.
     */
    public function show(User $officer)
    {
        return view('admin.officers.show', compact('officer'));
    }

    /**
     * Show the form for editing the specified officer.
     */
    public function edit(User $officer)
    {
        return view('admin.officers.edit', compact('officer'));
    }

    /**
     * Update the specified officer in storage.
     */
    public function update(Request $request, User $officer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|alpha_dash|unique:users,username,' . $officer->id,
            'jabatan' => 'nullable|string|max:255',
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $officer->name = $validated['name'];
        $officer->username = $validated['username'];
        $officer->jabatan = $validated['jabatan'] ?? null;

        if (!empty($validated['password'])) {
            $officer->password = Hash::make($validated['password']);
        }

        if ($request->hasFile('profile_photo')) {
            if ($officer->profile_photo) {
                Storage::disk('public')->delete($officer->profile_photo);
            }
            $officer->profile_photo = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        if ($request->has('remove_photo') && $request->remove_photo == '1') {
            if ($officer->profile_photo) {
                Storage::disk('public')->delete($officer->profile_photo);
            }
            $officer->profile_photo = null;
        }

        $officer->save();

        return redirect()->route('admin.officers.index')
            ->with('success', 'Data anggota QC berhasil diperbarui.');
    }

    /**
     * Remove the specified officer from storage.
     */
    public function destroy(User $officer)
    {
        if ($officer->profile_photo) {
            Storage::disk('public')->delete($officer->profile_photo);
        }

        $officer->delete();

        return redirect()->route('admin.officers.index')
            ->with('success', 'Anggota QC berhasil dihapus.');
    }
}
