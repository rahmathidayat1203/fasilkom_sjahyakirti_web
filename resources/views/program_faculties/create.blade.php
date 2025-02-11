@extends('program_faculties.layout')
@section('content')
    <div class="container">
        <h1>Create Program Faculty</h1>
        <form action="{{ route('program_faculties.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="program_id">Program</label>
                <select name="program_id" id="program_id" class="form-control" required>
                    <option value="">Select Program</option>
                    @foreach ($programs as $program)
                        <option value="{{ $program->id }}">{{ $program->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="faculty_id">Faculty</label>
                <select name="faculty_id" id="faculty_id" class="form-control" required>
                    <option value="">Select Faculty</option>
                    @foreach ($faculties as $faculty)
                        <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </div>
@endsection
