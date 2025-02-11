<?php

namespace App\Http\Controllers;

use App\Models\Bulletins;
use Illuminate\Http\Request;
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
                })
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
            'title' => 'required',
            'description' => 'required',
            'details' => 'required',
        ]);

        Bulletins::create($request->all());
        return redirect()->route('bulletins.index')->with('success', 'Bulletin created successfully.');
    }

    public function edit(Bulletins $bulletin)
    {
        return view('bulletins.edit', compact('bulletin'));
    }

    public function update(Request $request, Bulletins $bulletin)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'details' => 'required',
        ]);

        $bulletin->update($request->all());
        return redirect()->route('bulletins.index')->with('success', 'Bulletin updated successfully.');
    }

    public function destroy(Bulletins $bulletin)
    {
        $bulletin->delete();
        return redirect()->route('bulletins.index')->with('success', 'Bulletin deleted successfully.');
    }
}
