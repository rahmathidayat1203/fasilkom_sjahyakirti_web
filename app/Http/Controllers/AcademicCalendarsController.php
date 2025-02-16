<?php

namespace App\Http\Controllers;

use App\Models\AcademicCalendars;
use App\Models\Semester; // Jika Anda memiliki model Semester
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AcademicCalendarsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $calendars = AcademicCalendars::select('*');
            return DataTables::of($calendars)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('academic_calendars.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
                            <form action="' . route('academic_calendars.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>';
                })
                ->addColumn('semester', function ($row) {
                    return $row->semester->name; // Mengasumsikan ada relasi ke model Semester
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('academic_calendars.index');
    }

    public function create()
    {
        $semesters = Semester::all(); // Mengambil semua semester untuk dropdown
        return view('academic_calendars.create', compact('semesters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'semester_id' => 'required|exists:semesters,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'title' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|in:Akademik,Non-Akademik,Wisuda',
        ]);
        $input = $request->all();
        $input['created_by'] = 1;

        AcademicCalendars::create($input);
        return redirect()->route('academic_calendars.index')->with('success', 'Academic Calendar created successfully.');
    }

    public function edit(AcademicCalendars $academicCalendar)
    {
        $semesters = Semester::all(); // Mengambil semua semester untuk dropdown
        return view('academic_calendars.edit', compact('academicCalendar', 'semesters'));
    }

    public function update(Request $request, AcademicCalendars $academicCalendar)
    {
        $request->validate([
            'semester_id' => 'required|exists:semesters,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'title' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|in:Akademik,Non-Akademik,Wisuda',
        ]);

        $academicCalendar->update($request->all());
        return redirect()->route('academic_calendars.index')->with('success', 'Academic Calendar updated successfully.');
    }

    public function destroy(AcademicCalendars $academicCalendar)
    {
        $academicCalendar->delete();
        return redirect()->route('academic_calendars.index')->with('success', 'Academic Calendar deleted successfully.');
    }
}
