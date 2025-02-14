@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Create Course</h1>
        <form action="{{ route('courses.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="programs_id">Program</label>
                <select name="programs_id" id="programs_id" class="form-control" required>
                    <option value="">Select Program</option>
                    @foreach ($programs as $program)
                        <option value="{{ $program->id }}">{{ $program->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="semester">Semester</label>
                <input type="text" name="semester" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="group">Group</label>
                <input type="text" name="group" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="name">Course Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Course</button>
        </form>
    </div>
@endsection
