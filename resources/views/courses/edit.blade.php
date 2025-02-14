@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Edit Course</h1>
        <form action="{{ route('courses.update', $course->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="programs_id">Program</label>
                <select name="programs_id" id="programs_id" class="form-control" required>
                    <option value="">Select Program</option>
                    @foreach ($programs as $program)
                        <option value="{{ $program->id }}" {{ $program->id == $course->programs_id ? 'selected' : '' }}>
                            {{ $program->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="semester">Semester</label>
                <input type="text" name="semester" class="form-control" value="{{ $course->semester }}" required>
            </div>
            <div class="form-group">
                <label for="group">Group</label>
                <input type="text" name="group" class="form-control" value="{{ $course->group }}" required>
            </div>
            <div class="form-group">
                <label for="name">Course Name</label>
                <input type="text" name="name" class="form-control" value="{{ $course->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Course</button>
        </form>
    </div>
@endsection
