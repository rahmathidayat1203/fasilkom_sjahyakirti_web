<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use App\Models\Activity; // Pastikan nama model sesuai
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ActivitiesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $activities = Activities::select('*');
            return DataTables::of($activities)
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('activities.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a>';
                    $btn .= ' <form action="' . route('activities.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                              </form>';
                    return $btn;
                })->addIndexColumn()
                ->make(true);
        }

        return view('activities.index');
    }

    public function create()
    {
        return view('activities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|nullable|max:1999',
        ]);

        $activity = new Activities();
        $activity->title = $request->title;
        $activity->description = $request->description;

        if ($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
            $activity->image = $fileNameToStore;
        }

        $activity->save();
        return redirect()->route('activities.index')->with('success', 'Activity created successfully.');
    }

    public function edit($id)
    {
        $activity = Activities::findOrFail($id);
        return view('activities.edit', compact('activity'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|nullable|max:1999',
        ]);

        $activity = Activities::findOrFail($id);
        $activity->title = $request->title;
        $activity->description = $request->description;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($activity->image) {
                Storage::delete('public/images/' . $activity->image);
            }

            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
            $activity->image = $fileNameToStore;
        }

        $activity->save();
        return redirect()->route('activities.index')->with('success', 'Activity updated successfully.');
    }

    public function destroy($id)
    {
        $activity = Activities::findOrFail($id);
        if ($activity->image) {
            Storage::delete('public/images/' . $activity->image);
        }
        $activity->delete();
        return redirect()->route('activities.index')->with('success', 'Activity deleted successfully.');
    }
}
