<?php

namespace App\Http\Controllers;

use App\Models\AcademicCalendars;
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
                })->addIndexColumn()
                ->make(true);
        }

        return view('academic_calendars.index');
    }

    public function create()
    {
        return view('academic_calendars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'semester' => 'required',
            'date' => 'required',
            'description' => 'required',
        ]);

        AcademicCalendars::create($request->all());
        return redirect()->route('academic_calendars.index')->with('success', 'Academic Calendar created successfully.');
    }

    public function edit(AcademicCalendars $academicCalendar)
    {
        return view('academic_calendars.edit', compact('academicCalendar'));
    }

    public function update(Request $request, AcademicCalendars $academicCalendar)
    {
        $request->validate([
            'semester' => 'required',
            'date' => 'required',
            'description' => 'required',
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
