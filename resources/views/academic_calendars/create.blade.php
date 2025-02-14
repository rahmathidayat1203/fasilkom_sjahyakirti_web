@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Academic Calendar</h1>

        <form action="{{ route('academic_calendars.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="semester">Semester</label>
                <input type="text" class="form-control" id="semester" name="semester" required>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>
            <div class="form-group mb-3"> <!-- Menambahkan margin-bottom 3 unit -->
                <!-- Kosongkan jika tidak ada input tambahan -->
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
