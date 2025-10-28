<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::orderBy('created_at', 'asc')->get();
        return view('region.index', compact('regions'));
    }

    public function create()
    {
        return view('region.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'region_name' => 'required|string|max:255',
            'region_description' => 'nullable|string',
            'region_status' => 'required|boolean',
        ]);

        Region::createRegion($request->all());

        return redirect()->route('region.index')->with('success', 'Region berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $region = Region::findOrFail($id);
        return view('region.edit', compact('region'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'region_name' => 'required|string|max:255',
            'region_description' => 'nullable|string',
            'region_status' => 'required|boolean',
        ]);

        $region = Region::findOrFail($id);
        $region->updateRegion($request->all());

        return redirect()->route('region.index')->with('success', 'Region berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $region = Region::findOrFail($id);
        $region->deleteRegion();

        return redirect()->route('region.index')->with('success', 'Region berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        try {
            $region = Region::findOrFail($id);
            $region->toggleStatus();

            return response()->json([
                'success' => true,
                'message' => 'Status region berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status.'
            ], 500);
        }
    }
}
