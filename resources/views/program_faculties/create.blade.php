@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Program Faculty</h1>

        <form action="{{ route('program_faculties.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="program_id">Program</label>
                <select class="form-control @error('program_id') is-invalid @enderror" id="program_id" name="program_id" required>
                    <option value="">Select Program</option>
                    @foreach ($programs as $program)
                        <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>{{ $program->name }}</option>
                    @endforeach
                </select>
                @error('program_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="faculty_id">Faculty</label>
                <select class="form-control @error('faculty_id') is-invalid @enderror" id="faculty_id" name="faculty_id" required>
                    <option value="">Select Faculty</option>
                    @foreach ($faculties as $faculty)
                        <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                    @endforeach
                </select>
                @error('faculty_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="created_by">Author ID</label>
                <input type="number" class="form-control @error('created_by') is-invalid @enderror" id="created_by" name="created_by" value="{{ old('created_by') }}" required>
                @error('created_by')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
