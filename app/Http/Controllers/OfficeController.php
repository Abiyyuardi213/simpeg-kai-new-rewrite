<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Region;
use App\Models\OfficeType;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index()
    {
        $offices = Office::with(['region', 'officeType'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('office.index', compact('offices'));
    }

    public function create()
    {
        $regions = Region::orderBy('region_name', 'asc')->get();
        $officeTypes = OfficeType::orderBy('type_name', 'asc')->get();
        return view('office.create', compact('regions', 'officeTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'office_name' => 'required|string|max:255',
            'office_code' => 'required|string|max:50|unique:office,office_code',
            'office_address' => 'nullable|string|max:500',
            'region_id' => 'required|exists:regions,id',
            'office_type_id' => 'required|exists:office_types,id',
            'office_phone' => 'nullable|string|max:20',
            'office_email' => 'nullable|email|max:255',
            'office_head' => 'nullable|string|max:255',
            'office_status' => 'required|boolean',
        ]);

        Office::createOffice($request->all());

        return redirect()->route('office.index')
            ->with('success', 'Kantor baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $office = Office::findOrFail($id);
        $regions = Region::orderBy('region_name', 'asc')->get();
        $officeTypes = OfficeType::orderBy('type_name', 'asc')->get();

        return view('office.edit', compact('office', 'regions', 'officeTypes'));
    }

    public function update(Request $request, $id)
    {
        $office = Office::findOrFail($id);

        $request->validate([
            'office_name' => 'required|string|max:255',
            'office_code' => 'required|string|max:50|unique:office,office_code,' . $office->id . ',id',
            'office_address' => 'nullable|string|max:500',
            'region_id' => 'required|exists:region,id',
            'office_type_id' => 'required|exists:office_types,id',
            'office_phone' => 'nullable|string|max:20',
            'office_email' => 'nullable|email|max:255',
            'office_head' => 'nullable|string|max:255',
            'office_status' => 'required|boolean',
        ]);

        $office->updateOffice($request->all());

        return redirect()->route('office.index')
            ->with('success', 'Data kantor berhasil diperbarui.');
    }

    public function show($id)
    {
        $office = Office::with(['region', 'officeType'])->findOrFail($id);
        return view('office.show', compact('office'));
    }

    public function destroy($id)
    {
        $office = Office::findOrFail($id);
        $office->deleteOffice();

        return redirect()->route('office.index')
            ->with('success', 'Kantor berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        try {
            $office = Office::findOrFail($id);
            $office->toggleStatus();

            return response()->json([
                'success' => true,
                'message' => 'Status kantor berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status kantor.'
            ], 500);
        }
    }
}
