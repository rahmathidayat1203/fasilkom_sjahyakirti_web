@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Create Proposal Exam</h1>
        <form action="{{ route('proposal-exams.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                    name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="document_path">Document (PDF)</label>
                <input type="file" class="form-control @error('document_path') is-invalid @enderror" id="document_path"
                    name="document_path" required>
                @error('document_path')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="feedback">Feedback</label>
                <textarea class="form-control @error('feedback') is-invalid @enderror" id="feedback" name="feedback">{{ old('feedback') }}</textarea>
                @error('feedback')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="created_by">Author ID</label>
                <input type="number" class="form-control @error('created_by') is-invalid @enderror" id="created_by"
                    name="created_by" value="{{ old('created_by') }}" required>
                @error('created_by')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
