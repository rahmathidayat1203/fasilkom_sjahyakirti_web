<?php

namespace App\Http\Controllers;

use App\Models\Faculties;
use App\Models\Lecturer;
use App\Models\Programs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $lecturers = Lecturer::with(['user', 'faculty', 'program'])->select('*');
            return DataTables::of($lecturers)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('lecturers.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
                            <form action="' . route('lecturers.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>';
                })->addColumn('user_name',function($row){
                    return $row->user->name ?? 'name';
                })->addIndexColumn()
                ->make(true);
        }

        return view('lecturers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programs = Programs::all();
        $faculties = Faculties::all();
        return view('lecturers.create', compact('programs', 'faculties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nidn' => 'required|string|unique:lecturers,nidn',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string',
            'gender' => 'nullable|in:male,female',
            'expertise' => 'nullable|string',
            'faculty_id' => 'required|exists:faculties,id',
            'program_id' => 'required|exists:programs,id',
            'created_by' => 'required',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email'=> "null",
            'password'=> Hash::make('12341234'),
        ]);
        if($user){
            $request['user_id'] = $user->id;
            Lecturer::create($request->all());
        }
        return redirect()->route('lecturers.index')->with('success', 'Lecturer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lecturer $lecturer)
    {
        return view('lecturers.show', compact('lecturer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lecturer $lecturer)
    {
        return view('lecturers.edit', compact('lecturer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lecturer $lecturer)
    {
        $request->validate([
            'user_id' => 'required',
            'nidn' => 'required|string|unique:lecturers,nidn,' . $lecturer->id,
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string',
            'gender' => 'nullable|in:male,female',
            'expertise' => 'nullable|string',
            'faculty_id' => 'required|exists:faculties,id',
            'program_id' => 'required|exists:programs,id',
            'created_by' => 'require',
        ]);

        $lecturer->update($request->all());
        return redirect()->route('lecturers.index')->with('success', 'Lecturer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lecturer $lecturer)
    {
        $lecturer->delete();
        return redirect()->route('lecturers.index')->with('success', 'Lecturer deleted successfully.');
    }
}
