<?php

namespace App\Http\Controllers;

use App\Models\Programs;
use Illuminate\Http\Request;
use App\Models\ProgramFaculties;
use Yajra\DataTables\DataTables;

class ProgramsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $programs = Programs::select('*');
            return DataTables::of($programs)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('programs.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
                            <form action="' . route('programs.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>';
                })
                ->make(true);
        }

        return view('programs.index');
    }

    public function create()
    {
        return view('programs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_info' => 'required',
            'vision' => 'required',
            'mission' => 'required',
            'goals' => 'required',
            'objectives' => 'required',
            'head_welcome_message' => 'required',
            'head_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $bannerPath = $request->file('banner')->store('banners', 'public');
        $headPhotoPath = $request->file('head_photo')->store('head_photos', 'public');

        Programs::create([
            'name' => $request->name,
            'banner' => $bannerPath,
            'current_info' => $request->current_info,
            'vision' => $request->vision,
            'mission' => $request->mission,
            'goals' => $request->goals,
            'objectives' => $request->objectives,
            'head_welcome_message' => $request->head_welcome_message,
            'head_photo' => $headPhotoPath,
        ]);

        return redirect()->route('programs.index')->with('success', 'Program created successfully.');
    }

    public function edit($id)
    {
        $program = Programs::findOrFail($id);
        return view('programs.edit', compact('program'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'banner' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_info' => 'required',
            'vision' => 'required',
            'mission' => 'required',
            'goals' => 'required',
            'objectives' => 'required',
            'head_welcome_message' => 'required',
            'head_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $program = Programs::findOrFail($id);

        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('banners', 'public');
            $program->banner = $bannerPath;
        }

        if ($request->hasFile('head_photo')) {
            $headPhotoPath = $request->file('head_photo')->store('head_photos', 'public');
            $program->head_photo = $headPhotoPath;
        }

        $program->name = $request->name;
        $program->current_info = $request->current_info;
        $program->vision = $request->vision;
        $program->mission = $request->mission;
        $program->goals = $request->goals;
        $program->objectives = $request->objectives;
        $program->head_welcome_message = $request->head_welcome_message;

        $program->save();

        return redirect()->route('programs.index')->with('success', 'Program updated successfully.');
    }

    public function destroy($id)
    {
        $program = Programs::findOrFail($id);
        $program->delete();
        return redirect()->route('programs.index')->with('success', 'Program deleted successfully.');
    }
}
