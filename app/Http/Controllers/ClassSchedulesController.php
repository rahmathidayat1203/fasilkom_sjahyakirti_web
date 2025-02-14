<?php

namespace App\Http\Controllers;

use App\Models\ClassSchedules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ClassSchedulesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $classSchedules = ClassSchedules::select('*');
            return DataTables::of($classSchedules)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('class-schedules.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
                            <form action="' . route('class-schedules.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>';
                })
                ->editColumn('image', function ($row) {
                    return '<img src="' . Storage::url($row->image) . '" width="100" />';
                })->addIndexColumn()
                ->rawColumns(['action', 'image'])
                ->make(true);
        }

        return view('class_schedules.index');
    }

    public function create()
    {
        return view('class_schedules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'announcement' => 'nullable|string',
        ]);

        $imagePath = $request->file('image')->store('class_schedules', 'public');

        ClassSchedules::create([
            'image' => $imagePath,
            'description' => $request->description,
            'announcement' => $request->announcement,
        ]);

        return redirect()->route('class-schedules.index')->with('success', 'Class Schedule created successfully.');
    }

    public function edit(ClassSchedules $classSchedule)
    {
        return view('class_schedules.edit', compact('classSchedule'));
    }

    public function update(Request $request, ClassSchedules $classSchedule)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'announcement' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            Storage::disk('public')->delete($classSchedule->image);
            $imagePath = $request->file('image')->store('class_schedules', 'public');
            $classSchedule->image = $imagePath;
        }

        $classSchedule->description = $request->description;
        $classSchedule->announcement = $request->announcement;
        $classSchedule->save();

        return redirect()->route('class-schedules.index')->with('success', 'Class Schedule updated successfully.');
    }

    public function destroy(ClassSchedules $classSchedule)
    {
        // Hapus gambar dari storage
        Storage::disk('public')->delete($classSchedule->image);
        $classSchedule->delete();

        return redirect()->route('class-schedules.index')->with('success', 'Class Schedule deleted successfully.');
    }
}
