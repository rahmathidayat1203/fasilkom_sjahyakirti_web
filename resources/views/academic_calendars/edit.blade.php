@extends('academic_calendars.layout')
@section('content')
<div class="container">
    <h1>Edit Academic Calendar</h1>

    <form action="{{ route('academic_calendars.update', $academicCalendar->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="semester">Semester</label>
            <input type="text" class="form-control" id="semester" name="semester" value="{{ $academicCalendar->semester }}" required>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="text" class="form-control" id="date" name="date" value="{{ $academicCalendar->date }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ $academicCalendar->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
