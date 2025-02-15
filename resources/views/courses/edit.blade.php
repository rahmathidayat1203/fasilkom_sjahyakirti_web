@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Course</h1>

        <form action="{{ route('courses.update', $course->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Course Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $course->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="program_id">Program</label>
                <select class="form-control @error('program_id') is-invalid @enderror" id="program_id" name="program_id"
                    required>
                    <option value="">Select Program</option>
                    @foreach ($programs as $program)
                        <option value="{{ $program->id }}" {{ $program->id == $course->program_id ? 'selected' : '' }}>
                            {{ $program->name }}</option>
                    @endforeach
                </select>
                @error('program_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="semester">Semester</label>
                <select class="form-control @error('semester') is-invalid @enderror" id="semester" name="semester"
                    required>
                    <option value="">Select Semester</option>
                    <option value="Ganjil" {{ old('semester', $course->semester) == 'Ganjil' ? 'selected' : '' }}>Ganjil
                    </option>
                    <option value="Genap" {{ old('semester', $course->semester) == 'Genap' ? 'selected' : '' }}>Genap
                    </option>
                </select>
                @error('semester')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="code">Course Code</label>
                <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code"
                    value="{{ old('code', $course->code) }}" required>
                @error('code')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="sks">SKS</label>
                <input type="number" class="form-control @error('sks') is-invalid @enderror" id="sks" name="sks"
                    value="{{ old('sks', $course->sks) }}" required>
                @error('sks')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $course->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="created_by">Author ID</label>
                <input type="number" class="form-control @error('created_by') is-invalid @enderror" id="created_by"
                    name="created_by" value="{{ old('created_by', $course->created_by) }}" required>
                @error('created_by')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
