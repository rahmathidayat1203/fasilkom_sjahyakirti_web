<?php

namespace App\Http\Controllers;

use App\Models\ProposalExams;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ProposalExamsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $proposalExams = ProposalExams::select('*');
            return DataTables::of($proposalExams)
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('proposal-exams.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <form action="' . route('proposal-exams.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                              </form>';
                    return $btn;
                })->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('proposal_exams.index');
    }

    public function create()
    {
        $students = Student::all();
        $supervisors = User::get();
        return view('proposal_exams.create', compact('students', 'supervisors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'document_path' => 'required|image|mimes:png,jpeg,jpg|max:2048',
            'feedback' => 'nullable|string',
            'created_by' => 'required',
        ]);

        $documentPath = $request->file('document_path')->store('documents', 'public');

        ProposalExams::create([
            'title' => $request->title,
            'description' => $request->description,
            'document_path' => $documentPath,
            'feedback' => $request->feedback,
            'created_by' => $request->created_by,
        ]);

        return redirect()->route('proposal-exams.index')->with('success', 'Proposal Exam created successfully.');
    }

    public function edit($id)
    {
        $proposalExam = ProposalExams::findOrFail($id);
        return view('proposal_exams.edit', compact('proposalExam'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'document_path' => 'image|mimes:jpg,png,jpeg|max:2048',
            'feedback' => 'nullable|string',
            'created_by' => 'required',
        ]);

        $proposalExam = ProposalExams::findOrFail($id);

        if ($request->hasFile('document_path')) {
            // Hapus dokumen lama jika ada
            Storage::disk('public')->delete($proposalExam->document_path);
            $documentPath = $request->file('document_path')->store('documents', 'public');
            $proposalExam->document_path = $documentPath;
        }

        $proposalExam->update([
            'title' => $request->title,
            'description' => $request->description,
            'feedback' => $request->feedback,
            'created_by' => $request->created_by,
        ]);

        return redirect()->route('proposal-exams.index')->with('success', 'Proposal Exam updated successfully.');
    }

    public function destroy($id)
    {
        $proposalExam = ProposalExams::findOrFail($id);
        Storage::disk('public')->delete($proposalExam->document_path);
        $proposalExam->delete();

        return redirect()->route('proposal-exams.index')->with('success', 'Proposal Exam deleted successfully.');
    }
}
