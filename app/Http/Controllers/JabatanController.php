<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatans = Jabatan::orderBy('created_at', 'desc')->get();
        return view('jabatan.index', compact('jabatans'));
    }

    public function create()
    {
        return view('jabatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jabatan_name' => 'required|string|max:255',
            'jabatan_code' => 'required|string|max:50|unique:jabatan,jabatan_code',
            'jabatan_description' => 'nullable|string',
            'jabatan_sallary' => 'required|numeric|min:0', // ✅ validasi gaji
            'jabatan_status' => 'nullable|boolean',
        ]);

        Jabatan::create([
            'id' => Str::uuid(),
            'jabatan_name' => $request->jabatan_name,
            'jabatan_code' => strtoupper($request->jabatan_code),
            'jabatan_description' => $request->jabatan_description,
            'jabatan_sallary' => $request->jabatan_sallary,
            'jabatan_status' => $request->jabatan_status ?? true,
        ]);

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        return view('jabatan.show', compact('jabatan'));
    }

    public function edit($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        return view('jabatan.edit', compact('jabatan'));
    }

    public function update(Request $request, $id)
    {
        $jabatan = Jabatan::findOrFail($id);

        $request->validate([
            'jabatan_name' => 'required|string|max:255',
            'jabatan_code' => 'required|string|max:50|unique:jabatan,jabatan_code,' . $jabatan->id . ',id',
            'jabatan_description' => 'nullable|string',
            'jabatan_sallary' => 'required|numeric|min:0', // ✅ validasi gaji
            'jabatan_status' => 'nullable|boolean',
        ]);

        $jabatan->update([
            'jabatan_name' => $request->jabatan_name,
            'jabatan_code' => strtoupper($request->jabatan_code),
            'jabatan_description' => $request->jabatan_description,
            'jabatan_sallary' => $request->jabatan_sallary,
            'jabatan_status' => $request->jabatan_status ?? true,
        ]);

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->delete();

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->toggleStatus();

        return redirect()->route('jabatan.index')->with('success', 'Status jabatan berhasil diperbarui.');
    }
}
