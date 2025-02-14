<?php

namespace App\Http\Controllers;

use App\Models\Faculties;
use Illuminate\Http\Request;
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
            'name' => 'required',
            'welcome_message' => 'required',
            'history' => 'required',
            'structure_image' => 'required|image',
            'vision' => 'required',
            'mission' => 'required',
            'goals' => 'required',
            'objectives' => 'required',
            'dean_photo' => 'required|image',
            'dean_message' => 'required',
        ]);

        $data = $request->all();
        $data['structure_image'] = $request->file('structure_image')->store('images', 'public');
        $data['dean_photo'] = $request->file('dean_photo')->store('images', 'public');

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
            'name' => 'required',
            'welcome_message' => 'required',
            'history' => 'required',
            'structure_image' => 'image',
            'vision' => 'required',
            'mission' => 'required',
            'goals' => 'required',
            'objectives' => 'required',
            'dean_photo' => 'image',
            'dean_message' => 'required',
        ]);

        $data = $request->all();
        if ($request->hasFile('structure_image')) {
            $data['structure_image'] = $request->file('structure_image')->store('images', 'public');
        }
        if ($request->hasFile('dean_photo')) {
            $data['dean_photo'] = $request->file('dean_photo')->store('images', 'public');
        }

        $faculty->update($data);

        return redirect()->route('faculties.index')->with('success', 'Faculty updated successfully.');
    }

    public function destroy(Faculties $faculty)
    {
        $faculty->delete();
        return redirect()->route('faculties.index')->with('success', 'Faculty deleted successfully.');
    }
}
