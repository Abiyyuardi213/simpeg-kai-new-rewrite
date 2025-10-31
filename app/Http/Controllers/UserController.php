<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Region;
use App\Models\Office;
use App\Models\Division;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['role', 'region', 'office', 'division', 'jabatan'])->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $regions = Region::all();
        $offices = Office::all();
        $divisions = Division::all();
        $jabatans = Jabatan::all();

        return view('users.create', compact('roles', 'regions', 'offices', 'divisions', 'jabatans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|string|unique:users,nip|max:50',
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username|max:100',
            'email' => 'required|email|unique:users,email',
            'no_telepon' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|uuid|exists:role,id',
            'region_id' => 'nullable|uuid|exists:regions,id',
            'office_id' => 'nullable|uuid|exists:office,id',
            'division_id' => 'nullable|uuid|exists:divisions,id',
            'jabatan_id' => 'nullable|uuid|exists:jabatan,id',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $user = User::with(['role', 'region', 'office', 'division', 'jabatan'])->findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $regions = Region::all();
        $offices = Office::all();
        $divisions = Division::all();
        $jabatans = Jabatan::all();

        return view('users.edit', compact('user', 'roles', 'regions', 'offices', 'divisions', 'jabatans'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'nip' => 'required|string|max:50|unique:users,nip,' . $user->id,
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:100|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_telepon' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => 'required|uuid|exists:role,id',
            'region_id' => 'nullable|uuid|exists:regions,id',
            'office_id' => 'nullable|uuid|exists:office,id',
            'division_id' => 'nullable|uuid|exists:divisions,id',
            'jabatan_id' => 'nullable|uuid|exists:jabatan,id',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $validated['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
