<?php

namespace App\Http\Controllers;

use App\Models\OfficeType;
use Illuminate\Http\Request;

class OfficeTypeController extends Controller
{
    public function index()
    {
        $officeTypes = OfficeType::orderBy('created_at', 'asc')->get();
        return view('office_types.index', compact('officeTypes'));
    }

    public function create()
    {
        return view('office_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_name'   => 'required|string|max:255|unique:office_types,type_name',
            'description' => 'nullable|string',
            'status'      => 'required|boolean',
        ]);

        OfficeType::create([
            'type_name'   => $request->type_name,
            'description' => $request->description,
            'status'      => $request->status,
        ]);

        return redirect()->route('office_types.index')->with('success', 'Jenis kantor berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $officeType = OfficeType::findOrFail($id);
        return view('office_types.edit', compact('officeType'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type_name'   => 'required|string|max:255|unique:office_types,type_name,' . $id . ',id',
            'description' => 'nullable|string',
            'status'      => 'required|boolean',
        ]);

        $officeType = OfficeType::findOrFail($id);
        $officeType->update([
            'type_name'   => $request->type_name,
            'description' => $request->description,
            'status'      => $request->status,
        ]);

        return redirect()->route('office_types.index')->with('success', 'Jenis kantor berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $officeType = OfficeType::findOrFail($id);
        $officeType->delete();

        return redirect()->route('office_types.index')->with('success', 'Jenis kantor berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        try {
            $officeType = OfficeType::findOrFail($id);
            $officeType->toggleStatus();

            return response()->json([
                'success' => true,
                'message' => 'Status jenis kantor berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status jenis kantor.'
            ], 500);
        }
    }
}
