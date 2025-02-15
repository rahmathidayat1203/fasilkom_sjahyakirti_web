@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Edit Academic Calendar</h1>

        <form action="{{ route('academic_calendars.update', $academicCalendar->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="semester_id">Semester</label>
                <select class="form-control" id="semester_id" name="semester_id" required>
                    @foreach ($semesters as $semester)
                        <option value="{{ $semester->id }}"
                            {{ $academicCalendar->semester_id == $semester->id ? 'selected' : '' }}>
                            {{ $semester->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date"
                    value="{{ $academicCalendar->start_date }}" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date"
                    value="{{ $academicCalendar->end_date }}" required>
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ $academicCalendar->title }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required>{{ $academicCalendar->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="Akademik" {{ $academicCalendar->type == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                    <option value="Non-Akademik" {{ $academicCalendar->type == 'Non-Akademik' ? 'selected' : '' }}>
                        Non-Akademik</option>
                    <option value="Wisuda" {{ $academicCalendar->type == 'Wisuda' ? 'selected' : '' }}>Wisuda</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
