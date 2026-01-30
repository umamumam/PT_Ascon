<?php

namespace App\Http\Controllers;

use App\Models\Port;
use Illuminate\Http\Request;

class PortController extends Controller
{
    public function index()
    {
        $ports = Port::latest()->get();
        return view('ports.index', compact('ports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'port_code' => ['required', 'string', 'max:10', 'unique:ports'],
            'port_name' => ['required', 'string', 'max:100'],
        ]);

        Port::create([
            'port_code' => $request->port_code,
            'port_name' => $request->port_name,
        ]);

        return redirect()->route('ports.index')->with('success', 'Pelabuhan berhasil ditambahkan.');
    }

    public function update(Request $request, Port $port)
    {
        $request->validate([
            'port_code' => ['required', 'string', 'max:10', 'unique:ports,port_code,' . $port->id],
            'port_name' => ['required', 'string', 'max:100'],
        ]);

        $port->update([
            'port_code' => $request->port_code,
            'port_name' => $request->port_name,
        ]);

        return redirect()->route('ports.index')->with('success', 'Data pelabuhan berhasil diperbarui.');
    }

    public function destroy(Port $port)
    {
        $port->delete();
        return redirect()->route('ports.index')->with('success', 'Pelabuhan berhasil dihapus.');
    }
}
