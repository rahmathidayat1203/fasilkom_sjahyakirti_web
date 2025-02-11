@extends('proposal_exams.layout')
@section('content')
    <div class="container">
        <h1>Edit Proposal Exam</h1>
        <form action="{{ route('proposal-exams.update', $proposalExam->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image">
                <img src="{{ asset('storage/' . $proposalExam->image) }}" width="100" class="mt-2">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="text">Text</label>
                <textarea class="form-control" name="text" required>{{ $proposalExam->text }}</textarea>
                @error('text')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
