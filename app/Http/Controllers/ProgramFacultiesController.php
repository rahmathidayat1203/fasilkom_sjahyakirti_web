<?php

namespace App\Http\Controllers;

use App\Models\Faculties;
use App\Models\ProgramFaculties;
use App\Models\Programs;
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
                })
                ->addColumn('program', function ($row) {
                    return $row->program->name; // Menampilkan nama program
                })
                ->addColumn('faculty', function ($row) {
                    return $row->faculty->name; // Menampilkan nama fakultas
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $programs = Programs::all();
        $faculties = Faculties::all();
        return view('program_faculties.index', compact('programs', 'faculties'));
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
        ]);

        ProgramFaculties::create($request->all());
        return redirect()->route('program_faculties.index')->with('success', 'Program Faculty created successfully.');
    }

    public function edit($id)
    {
        $programFaculty = ProgramFaculties::findOrFail($id);
        $programs = Programs::all();
        $faculties = Faculties::all();
        return view('program_faculties.edit', compact('programFaculty', 'programs', 'faculties'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'program_id' => 'required|exists:programs,id',
            'faculty_id' => 'required|exists:faculties,id',
        ]);

        $programFaculty = ProgramFaculties::findOrFail($id);
        $programFaculty->update($request->all());
        return redirect()->route('program_faculties.index')->with('success', 'Program Faculty updated successfully.');
    }

    public function destroy($id)
    {
        $programFaculty = ProgramFaculties::findOrFail($id);
        $programFaculty->delete();
        return redirect()->route('program_faculties.index')->with('success', 'Program Faculty deleted successfully.');
    }
}
