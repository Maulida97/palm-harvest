<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class OfficerController extends Controller
{
    /**
     * Display a listing of officers.
     */
    public function index()
    {
        $officers = User::where('role', 'officer')
            ->withCount('harvests')
            ->withSum('harvests', 'weight_kg')
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
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => 'officer',
        ]);

        return redirect()->route('admin.officers.index')
            ->with('success', 'Petugas berhasil ditambahkan.');
    }

    /**
     * Display the specified officer.
     */
    public function show(User $officer)
    {
        $officer->load(['harvests' => function ($query) {
            $query->with('block')->latest('harvest_date')->take(10);
        }]);

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
            'email' => 'required|string|email|max:255|unique:users,email,' . $officer->id,
            'phone' => 'nullable|string|max:20',
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $officer->name = $validated['name'];
        $officer->email = $validated['email'];
        $officer->phone = $validated['phone'] ?? null;

        if (!empty($validated['password'])) {
            $officer->password = Hash::make($validated['password']);
        }

        $officer->save();

        return redirect()->route('admin.officers.index')
            ->with('success', 'Data petugas berhasil diperbarui.');
    }

    /**
     * Remove the specified officer from storage.
     */
    public function destroy(User $officer)
    {
        $officer->delete();

        return redirect()->route('admin.officers.index')
            ->with('success', 'Petugas berhasil dihapus.');
    }
}
