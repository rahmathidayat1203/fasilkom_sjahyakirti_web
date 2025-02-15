<?php

namespace App\Http\Controllers;

use App\Models\Faculties;
use App\Models\Programs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ProgramsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $programs = Programs::with('faculty')->select('*');
            return DataTables::of($programs)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('programs.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
                            <form action="' . route('programs.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>';
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('programs.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculties = Faculties::all();
        return view('programs.create',compact('faculties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'faculty_id' => 'required|exists:faculties,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:programs,slug',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'current_info' => 'required|string',
            'vision' => 'required|string',
            'mission' => 'required|string',
            'goals' => 'required|string',
            'objectives' => 'required|string',
            'head_welcome_message' => 'required|string',
            'head_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'created_by' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('banner')) {
            $data['banner'] = $request->file('banner')->store('images', 'public');
        }

        if ($request->hasFile('head_photo')) {
            $data['head_photo'] = $request->file('head_photo')->store('images', 'public');
        }

        Programs::create($data);
        return redirect()->route('programs.index')->with('success', 'Program created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Programs $program)
    {
        return view('programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Programs $program)
    {
        $faculties = Faculties::all();
        return view('programs.edit', compact('program','faculties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Programs $program)
    {
        $request->validate([
            'faculty_id' => 'required|exists:faculties,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:programs,slug,' . $program->id,
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'current_info' => 'required|string',
            'vision' => 'required|string',
            'mission' => 'required|string',
            'goals' => 'required|string',
            'objectives' => 'required|string',
            'head_welcome_message' => 'required|string',
            'head_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'created_by' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('banner')) {
            if ($program->banner) {
                Storage::disk('public')->delete($program->banner);
            }
            $data['banner'] = $request->file('banner')->store('images', 'public');
        }

        if ($request->hasFile('head_photo')) {
            if ($program->head_photo) {
                Storage::disk('public')->delete($program->head_photo);
            }
            $data['head_photo'] = $request->file('head_photo')->store('images', 'public');
        }

        $program->update($data);
        return redirect()->route('programs.index')->with('success', 'Program updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Programs $program)
    {
        if ($program->banner) {
            Storage::disk('public')->delete($program->banner);
        }
        if ($program->head_photo) {
            Storage::disk('public')->delete($program->head_photo);
        }
        $program->delete();
        return redirect()->route('programs.index')->with('success', 'Program deleted successfully.');
    }
}
