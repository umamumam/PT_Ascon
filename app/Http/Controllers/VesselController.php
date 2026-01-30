<?php

namespace App\Http\Controllers;

use App\Models\Vessel;
use Illuminate\Http\Request;

class VesselController extends Controller
{
    public function index()
    {
        $vessels = Vessel::latest()->get();
        return view('vessels.index', compact('vessels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vessel_name' => ['required', 'string', 'max:100'],
        ]);

        Vessel::create([
            'vessel_name' => $request->vessel_name,
        ]);

        return redirect()->route('vessels.index')->with('success', 'Kapal berhasil ditambahkan.');
    }

    public function update(Request $request, Vessel $vessel)
    {
        $request->validate([
            'vessel_name' => ['required', 'string', 'max:100'],
        ]);

        $vessel->update([
            'vessel_name' => $request->vessel_name,
        ]);

        return redirect()->route('vessels.index')->with('success', 'Data kapal berhasil diperbarui.');
    }

    public function destroy(Vessel $vessel)
    {
        $vessel->delete();
        return redirect()->route('vessels.index')->with('success', 'Kapal berhasil dihapus.');
    }
}
