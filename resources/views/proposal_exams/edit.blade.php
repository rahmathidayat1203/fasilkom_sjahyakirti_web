@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Edit Proposal Exam</h1>
        <form action="{{ route('proposal-exams.update', $proposalExam->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="student_id">Student</label>
                <select class="form-control @error('student_id') is-invalid @enderror" id="student_id" name="student_id" required>
                    <option value="">Select Student</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}" {{ $proposalExam->student_id == $student->id ? 'selected' : '' }}>{{ $student->name }}</option>
                    @endforeach
                </select>
                @error('student_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="supervisor_id">Supervisor</label>
                <select class="form-control @error('supervisor_id') is-invalid @enderror" id="supervisor_id" name="supervisor_id" required>
                    <option value="">Select Supervisor</option>
                    @foreach ($supervisors as $supervisor)
                        <option value="{{ $supervisor->id }}" {{ $proposalExam->supervisor_id == $supervisor->id ? 'selected' : '' }}>{{ $supervisor->name }}</option>
                    @endforeach
                </select>
                @error('supervisor_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $proposalExam->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $proposalExam->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="document_path">Document (PDF)</label>
                <input type="file" class="form-control @error('document_path') is-invalid @enderror" id="document_path" name="document_path">
                @error('document_path')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if ($proposalExam->document_path)
                    <a href="{{ asset('storage/' . $proposalExam->document_path) }}" target="_blank" class="d-block mt-2">View Current Document</a>
                @endif
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="pending" {{ old('status', $proposalExam->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ old('status', $proposalExam->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ old('status', $proposalExam->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="revised" {{ old('status', $proposalExam->status) == 'revised' ? 'selected' : '' }}>Revised</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="feedback">Feedback</label>
                <textarea class="form-control @error('feedback') is-invalid @enderror" id="feedback" name="feedback">{{ old('feedback', $proposalExam->feedback) }}</textarea>
                @error('feedback')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="scheduled_date">Scheduled Date</label>
                <input type="date" class="form-control @error('scheduled_date') is-invalid @enderror" id="scheduled_date" name="scheduled_date" value="{{ old('scheduled_date', $proposalExam->scheduled_date) }}">
                @error('scheduled_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="scheduled_time">Scheduled Time</label>
                <input type="time" class="form-control @error('scheduled_time') is-invalid @enderror" id="scheduled_time" name="scheduled_time" value="{{ old('scheduled_time', $proposalExam->scheduled_time) }}">
                @error('scheduled_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="room">Room</label>
                <input type="text" class="form-control @error('room') is-invalid @enderror" id="room" name="room" value="{{ old('room', $proposalExam->room) }}">
                @error('room')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="created_by">Author ID</label>
                <input type="number" class="form-control @error('created_by') is-invalid @enderror" id="created_by" name="created_by" value="{{ old('created_by', $proposalExam->created_by) }}" required>
                @error('created_by')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
