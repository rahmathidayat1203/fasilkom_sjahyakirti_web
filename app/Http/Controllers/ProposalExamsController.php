<?php

namespace App\Http\Controllers;

use App\Models\ProposalExams;
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
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('proposal_exams.index');
    }

    public function create()
    {
        return view('proposal_exams.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'text' => 'required|string',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        ProposalExams::create([
            'image' => $imagePath,
            'text' => $request->text,
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
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'text' => 'required|string',
        ]);

        $proposalExam = ProposalExams::findOrFail($id);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            Storage::disk('public')->delete($proposalExam->image);
            $imagePath = $request->file('image')->store('images', 'public');
            $proposalExam->image = $imagePath;
        }

        $proposalExam->text = $request->text;
        $proposalExam->save();

        return redirect()->route('proposal-exams.index')->with('success', 'Proposal Exam updated successfully.');
    }

    public function destroy($id)
    {
        $proposalExam = ProposalExams::findOrFail($id);
        Storage::disk('public')->delete($proposalExam->image);
        $proposalExam->delete();

        return redirect()->route('proposal-exams.index')->with('success', 'Proposal Exam deleted successfully.');
    }
}
