<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Office;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::with('office')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('divisi.index', compact('divisions'));
    }

    public function create()
    {
        $offices = Office::orderBy('office_name', 'asc')->get();
        return view('divisi.create', compact('offices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'division_name' => 'required|string|max:255',
            'division_code' => 'required|string|max:50|unique:divisions,division_code',
            'division_description' => 'nullable|string|max:500',
            'office_id' => 'required|exists:office,id',
            'division_head' => 'nullable|string|max:255',
            'division_status' => 'required|boolean',
        ]);

        Division::createDivision($request->all());

        return redirect()->route('divisi.index')
            ->with('success', 'Divisi baru berhasil ditambahkan.');
    }

    public function show($id)
    {
        $division = Division::with('office')->findOrFail($id);
        return view('divisi.show', compact('division'));
    }

    public function edit($id)
    {
        $division = Division::findOrFail($id);
        $offices = Office::orderBy('office_name', 'asc')->get();

        return view('divisi.edit', compact('division', 'offices'));
    }

    public function update(Request $request, $id)
    {
        $division = Division::findOrFail($id);

        $request->validate([
            'division_name' => 'required|string|max:255',
            'division_code' => 'required|string|max:50|unique:divisions,division_code,' . $division->id . ',id',
            'division_description' => 'nullable|string|max:500',
            'office_id' => 'required|exists:office,id',
            'division_head' => 'nullable|string|max:255',
            'division_status' => 'required|boolean',
        ]);

        $division->updateDivision($request->all());

        return redirect()->route('divisi.index')
            ->with('success', 'Data divisi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $division = Division::findOrFail($id);
        $division->deleteDivision();

        return redirect()->route('divisi.index')
            ->with('success', 'Divisi berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        try {
            $division = Division::findOrFail($id);
            $division->toggleStatus();

            return response()->json([
                'success' => true,
                'message' => 'Status divisi berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status divisi.'
            ], 500);
        }
    }
}
