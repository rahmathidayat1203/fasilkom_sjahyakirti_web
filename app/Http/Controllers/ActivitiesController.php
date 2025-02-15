<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $activities = Activities::select('*');
            return DataTables::of($activities)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('activities.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
                            <form action="' . route('activities.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>';
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('activities.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('activities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:activities',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required|in:Event,Berita,Pengumuman,Wisuda',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'created_by' => 'required', // Ensure the user exists
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('activities', 'public');
        }

        // Create the activity with the image path
        Activities::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'image' => $imagePath,
            'category' => $request->category,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'created_by' => $request->created_by,
        ]);

        return redirect()->route('activities.index')->with('success', 'Activity created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activities $activity)
    {
        return view('activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activities $activity)
    {
        return view('activities.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activities $activity)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:activities,slug,' . $activity->id,
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required|in:Event,Berita,Pengumuman,Wisuda',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'created_by' => 'required', // Ensure the user exists
        ]);

        // Handle image upload
        $imagePath = $activity->image; // Keep the current image path if no new image is uploaded
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Delete the old image if it exists
            if ($activity->image && Storage::disk('public')->exists($activity->image)) {
                Storage::disk('public')->delete($activity->image);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('activities', 'public');
        }

        // Update the activity with the new image path
        $activity->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'image' => $imagePath,
            'category' => $request->category,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'created_by' => $request->created_by,
        ]);

        return redirect()->route('activities.index')->with('success', 'Activity updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activities $activity)
    {
        $activity->delete();

        return redirect()->route('activities.index')->with('success', 'Activity deleted successfully.');
    }
}
