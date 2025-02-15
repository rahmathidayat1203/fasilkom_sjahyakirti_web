<?php

namespace App\Http\Controllers;

use App\Models\Faculties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class FacultiesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $faculties = Faculties::select('*');
            return DataTables::of($faculties)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('faculties.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
                            <form action="' . route('faculties.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>';
                })->addIndexColumn()
                ->make(true);
        }

        return view('faculties.index');
    }

    public function create()
    {
        return view('faculties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:faculties',
            'welcome_message' => 'required|string',
            'history' => 'required|string',
            'structure_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'vision' => 'required|string',
            'mission' => 'required|string',
            'goals' => 'required|string',
            'objectives' => 'required|string',
            'dean_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dean_message' => 'required|string',
            'created_by' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('structure_image')) {
            $data['structure_image'] = $request->file('structure_image')->store('images', 'public');
        }

        if ($request->hasFile('dean_photo')) {
            $data['dean_photo'] = $request->file('dean_photo')->store('images', 'public');
        }

        Faculties::create($data);
        return redirect()->route('faculties.index')->with('success', 'Faculty created successfully.');
    }

    public function edit(Faculties $faculty)
    {
        return view('faculties.edit', compact('faculty'));
    }

    public function update(Request $request, Faculties $faculty)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:faculties,slug,' . $faculty->id,
            'welcome_message' => 'required|string',
            'history' => 'required|string',
            'structure_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'vision' => 'required|string',
            'mission' => 'required|string',
            'goals' => 'required|string',
            'objectives' => 'required|string',
            'dean_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dean_message' => 'required|string',
            'created_by' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('structure_image')) {
            if ($faculty->structure_image) {
                Storage::disk('public')->delete($faculty->structure_image);
            }
            $data['structure_image'] = $request->file('structure_image')->store('images', 'public');
        }

        if ($request->hasFile('dean_photo')) {
            if ($faculty->dean_photo) {
                Storage::disk('public')->delete($faculty->dean_photo);
            }
            $data['dean_photo'] = $request->file('dean_photo')->store('images', 'public');
        }

        $faculty->update($data);
        return redirect()->route('faculties.index')->with('success', 'Faculty updated successfully.');
    }

    public function destroy(Faculties $faculty)
    {
        if ($faculty->structure_image) {
            Storage::disk('public')->delete($faculty->structure_image);
        }
        if ($faculty->dean_photo) {
            Storage::disk('public')->delete($faculty->dean_photo);
        }
        $faculty->delete();
        return redirect()->route('faculties.index')->with('success', 'Faculty deleted successfully.');
    }
}
