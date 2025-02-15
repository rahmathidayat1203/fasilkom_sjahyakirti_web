<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\Admissions;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $admissions = Admissions::select('*');
            return DataTables::of($admissions)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admissions.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
                            <form action="' . route('admissions.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>';
                })->addIndexColumn()
                ->make(true);
        }

        return view('admissions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'program_id' => 'required|exists:programs,id',
            'registration_number' => 'required|string|max:255|unique:admissions',
            'status' => 'required|in:pending,approved,rejected',
            'documents' => 'required|json',
            'notes' => 'nullable|string',
        ]);

        Admissions::create($request->all());

        return redirect()->route('admissions.index')->with('success', 'Admission created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admissions $admission)
    {
        return view('admissions.show', compact('admission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admissions $admission)
    {
        return view('admissions.edit', compact('admission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admissions $admission)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'program_id' => 'required|exists:programs,id',
            'registration_number' => 'required|string|max:255|unique:admissions,registration_number,' . $admission->id,
            'status' => 'required|in:pending,approved,rejected',
            'documents' => 'required|json',
            'notes' => 'nullable|string',
        ]);

        $admission->update($request->all());

        return redirect()->route('admissions.index')->with('success', 'Admission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admissions $admission)
    {
        $admission->delete();

        return redirect()->route('admissions.index')->with('success', 'Admission deleted successfully.');
    }
}
