<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Programs;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CoursesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $courses = Courses::select('*');
            return DataTables::of($courses)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('courses.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
                            <form action="' . route('courses.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>';
                })->addColumn('program_name',function($row){
                    return $row->program->name;
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('courses.index');
    }

    public function create()
    {
        $programs = Programs::all(); // Ambil semua program untuk dropdown
        return view('courses.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'program_id' => 'required|exists:programs,id',
            'semester' => 'required|in:Ganjil,Genap',
            'code' => 'required|string|max:255|unique:courses,code',
            'sks' => 'required|integer',
            'description' => 'nullable|string',
            'created_by' => 'required',
        ]);

        $data = $request->all();
        Courses::create($data);
        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    public function edit(Courses $course)
    {
        $programs = Programs::all(); // Ambil semua program untuk dropdown
        return view('courses.edit', compact('course', 'programs'));
    }

    public function update(Request $request, Courses $course)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'program_id' => 'required|exists:programs,id',
            'semester' => 'required|in:Ganjil,Genap',
            'code' => 'required|string|max:255|unique:courses,code,' . $course->id,
            'sks' => 'required|integer',
            'description' => 'nullable|string',
            'created_by' => 'required',
        ]);

        $data = $request->all();
        $course->update($data);
        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Courses $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
