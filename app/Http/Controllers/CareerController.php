<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::latest()->get();
        return view('careers.admin', compact('careers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        Career::create($request->all());

        return redirect()->route('cms.careers.index')->with('success', 'Career vacancy created successfully.');
    }

    public function update(Request $request, $id)
    {
        $career = Career::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $career->update($request->all());

        return redirect()->route('cms.careers.index')->with('success', 'Career vacancy updated successfully.');
    }

    public function destroy($id)
    {
        $career = Career::findOrFail($id);
        $career->delete();

        return redirect()->route('cms.careers.index')->with('success', 'Career vacancy deleted successfully.');
    }
}
