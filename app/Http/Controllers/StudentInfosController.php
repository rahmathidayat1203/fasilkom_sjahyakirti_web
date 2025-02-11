<?php

namespace App\Http\Controllers;

use App\Models\StudentInfos;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StudentInfosController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $studentInfos = StudentInfos::select('*');
            return DataTables::of($studentInfos)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('student-infos.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
                            <form action="' . route('student-infos.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>';
                })
                ->make(true);
        }

        return view('student_infos.index');
    }

    public function create()
    {
        return view('student_infos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        StudentInfos::create($request->all());
        return redirect()->route('student-infos.index')->with('success', 'Student Info created successfully.');
    }

    public function edit(StudentInfos $studentInfo)
    {
        return view('student_infos.edit', compact('studentInfo'));
    }

    public function update(Request $request, StudentInfos $studentInfo)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $studentInfo->update($request->all());
        return redirect()->route('student-infos.index')->with('success', 'Student Info updated successfully.');
    }

    public function destroy(StudentInfos $studentInfo)
    {
        $studentInfo->delete();
        return redirect()->route('student-infos.index')->with('success', 'Student Info deleted successfully.');
    }
}
