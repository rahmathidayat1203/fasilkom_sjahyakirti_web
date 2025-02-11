<?php

namespace App\Http\Controllers;

use App\Models\StudentActivityUnits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class StudentActivityUnitsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $units = StudentActivityUnits::select('*');
            return DataTables::of($units)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('student_activity_units.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
                            <form action="' . route('student_activity_units.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>';
                })
                ->editColumn('image', function ($row) {
                    return '<img src="' . Storage::url($row->image) . '" width="100" />';
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }

        return view('student_activity_units.index');
    }

    public function create()
    {
        return view('student_activity_units.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'procedure' => 'required|string',
        ]);

        $path = $request->file('image')->store('images', 'public');

        StudentActivityUnits::create([
            'image' => $path,
            'procedure' => $request->procedure,
        ]);

        return redirect()->route('student_activity_units.index')->with('success', 'Student Activity Unit created successfully.');
    }

    public function edit($id)
    {
        $unit = StudentActivityUnits::findOrFail($id);
        return view('student_activity_units.edit', compact('unit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'procedure' => 'required|string',
        ]);

        $unit = StudentActivityUnits::findOrFail($id);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            Storage::delete($unit->image);
            $path = $request->file('image')->store('images', 'public');
            $unit->image = $path;
        }

        $unit->procedure = $request->procedure;
        $unit->save();

        return redirect()->route('student_activity_units.index')->with('success', 'Student Activity Unit updated successfully.');
    }

    public function destroy($id)
    {
        $unit = StudentActivityUnits::findOrFail($id);
        Storage::delete($unit->image);
        $unit->delete();

        return redirect()->route('student_activity_units.index')->with('success', 'Student Activity Unit deleted successfully.');
    }
}
