<?php

namespace App\Http\Controllers;

use App\Models\ClassSchedule; // Model ClassSchedule
use App\Models\ClassSchedules;
use App\Models\Course; // Model Course (mata kuliah)
use App\Models\Courses;
use App\Models\Lecturer; // Model Lecturer (dosen)
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClassSchedulesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Ambil data class schedules dengan relasi course dan lecturer
            $classSchedules = ClassSchedules::with(['course', 'lecturer.user'])->select('*');

            return DataTables::of($classSchedules)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('class-schedules.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
                            <form action="' . route('class-schedules.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>';
                })
                ->addColumn('lecturer_name', function ($row) {
                    return $row->lecturer->user->name; // Nama dosen
                })
                ->addColumn('course_name', function ($row) {
                    return $row->course->name; // Nama mata kuliah
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('class_schedules.index');
    }

    public function create()
    {
        // Ambil semua mata kuliah dan dosen
        $courses = Courses::all();
        $lecturers = Lecturer::with('user')->get(); // Ambil dosen beserta data user

        return view('class_schedules.create', compact('courses', 'lecturers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id', // Relasi ke mata kuliah
            'lecturer_id' => 'required|exists:lecturers,id', // Relasi ke dosen
            'day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu', // Hari
            'start_time' => 'required|date_format:H:i', // Waktu mulai
            'end_time' => 'required|date_format:H:i|after:start_time', // Waktu selesai
            'room' => 'required|string|max:255', // Ruang kelas
            'class_type' => 'required|in:theory,practice', // Tipe kelas
        ]);

        // Tambahkan created_by (user yang sedang login)
        $request->merge(['created_by' => 1]);

        // Simpan data
        ClassSchedules::create($request->all());

        return redirect()->route('class-schedules.index')->with('success', 'Jadwal kelas berhasil ditambahkan.');
    }

    public function edit(ClassSchedules $classSchedule)
    {
        // Ambil semua mata kuliah dan dosen
        $courses = Courses::all();
        $lecturers = Lecturer::with('user')->get();

        return view('class_schedules.edit', compact('classSchedule', 'courses', 'lecturers'));
    }

    public function update(Request $request, ClassSchedules $classSchedule)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id', // Relasi ke mata kuliah
            'lecturer_id' => 'required|exists:lecturers,id', // Relasi ke dosen
            'day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu', // Hari
            'start_time' => 'required|date_format:H:i', // Waktu mulai
            'end_time' => 'required|date_format:H:i|after:start_time', // Waktu selesai
            'room' => 'required|string|max:255', // Ruang kelas
            'class_type' => 'required|in:theory,practice', // Tipe kelas
        ]);

        // Update data
        $classSchedule->update($request->all());

        return redirect()->route('class-schedules.index')->with('success', 'Jadwal kelas berhasil diperbarui.');
    }

    public function destroy(ClassSchedules $classSchedule)
    {
        // Hapus data
        $classSchedule->delete();

        return redirect()->route('class-schedules.index')->with('success', 'Jadwal kelas berhasil dihapus.');
    }
}