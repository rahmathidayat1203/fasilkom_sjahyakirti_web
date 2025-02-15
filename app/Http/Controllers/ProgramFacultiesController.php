<?php

namespace App\Http\Controllers;

use App\Models\ProgramFaculties;
use App\Models\Programs;
use App\Models\Faculties;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProgramFacultiesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $programFaculties = ProgramFaculties::with(['program', 'faculty'])->select('*');
            return DataTables::of($programFaculties)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('program_faculties.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
                            <form action="' . route('program_faculties.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>';
                })->addIndexColumn()
                ->make(true);
        }

        return view('program_faculties.index');
    }

    public function create()
    {
        $programs = Programs::all();
        $faculties = Faculties::all();
        return view('program_faculties.create', compact('programs', 'faculties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:programs,id',
            'faculty_id' => 'required|exists:faculties,id',
            'created_by' => 'required',
        ]);

        ProgramFaculties::create($request->all());
        return redirect()->route('program_faculties.index')->with('success', 'Program Faculty created successfully.');
    }

    public function edit(ProgramFaculties $programFaculty)
    {
        $programs = Programs::all();
        $faculties = Faculties::all();
        return view('program_faculties.edit', compact('programFaculty', 'programs', 'faculties'));
    }

    public function update(Request $request, ProgramFaculties $programFaculty)
    {
        $request->validate([
            'program_id' => 'required|exists:programs,id',
            'faculty_id' => 'required|exists:faculties,id',
            'created_by' => 'required',
        ]);

        $programFaculty->update($request->all());
        return redirect()->route('program_faculties.index')->with('success', 'Program Faculty updated successfully.');
    }

    public function destroy(ProgramFaculties $programFaculty)
    {
        $programFaculty->delete();
        return redirect()->route('program_faculties.index')->with('success', 'Program Faculty deleted successfully.');
    }
}
