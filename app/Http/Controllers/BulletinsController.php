<?php

namespace App\Http\Controllers;

use App\Models\Bulletins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class BulletinsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $bulletins = Bulletins::select('*');
            return DataTables::of($bulletins)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('bulletins.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
                            <form action="' . route('bulletins.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>';
                })->addIndexColumn()
                ->make(true);
        }

        return view('bulletins.index');
    }

    public function create()
    {
        return view('bulletins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:bulletins',
            'excerpt' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required|string',
            'priority' => 'required|in:normal,important,urgent',
            'created_by' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('bulletins', 'public');
        }

        Bulletins::create($data);
        return redirect()->route('bulletins.index')->with('success', 'Bulletin created successfully.');
    }

    public function edit(Bulletins $bulletin)
    {
        return view('bulletins.edit', compact('bulletin'));
    }

    public function update(Request $request, Bulletins $bulletin)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:bulletins,slug,' . $bulletin->id,
            'excerpt' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required|string',
            'priority' => 'required|in:normal,important,urgent',
            'created_by' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($bulletin->image) {
                Storage::disk('public')->delete($bulletin->image);
            }
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $bulletin->update($data);
        return redirect()->route('bulletins.index')->with('success', 'Bulletin updated successfully.');
    }

    public function destroy(Bulletins $bulletin)
    {
        if ($bulletin->image) {
            Storage::disk('public')->delete($bulletin->image);
        }
        $bulletin->delete();
        return redirect()->route('bulletins.index')->with('success', 'Bulletin deleted successfully.');
    }
}
