@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Edit Program Faculty</h1>
        <form action="{{ route('program_faculties.update', $programFaculty->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="program_id">Program</label>
                <select name="program_id" id="program_id" class="form-control" required>
                    @foreach ($programs as $program)
                        <option value="{{ $program->id }}"
                            {{ $programFaculty->program_id == $program->id ? 'selected' : '' }}>{{ $program->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="faculty_id">Faculty</label>
                <select name="faculty_id" id="faculty_id" class="form-control" required>
                    @foreach ($faculties as $faculty)
                        <option value="{{ $faculty->id }}"
                            {{ $programFaculty->faculty_id == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
