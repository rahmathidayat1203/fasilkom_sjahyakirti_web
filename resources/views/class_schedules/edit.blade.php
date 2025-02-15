@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Edit Class Schedule</h1>

        <form action="{{ route('class_schedules.update', $classSchedule->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="course_id">Course</label>
                <select class="form-control @error('course_id') is-invalid @enderror" id="course_id" name="course_id" required>
                    <option value="">Select Course</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id', $classSchedule->course_id) == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                    @endforeach
                </select>
                @error('course_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="lecturer_id">Lecturer</label>
                <select class="form-control @error('lecturer_id') is-invalid @enderror" id="lecturer_id" name="lecturer_id" required>
                    <option value="">Select Lecturer</option>
                    @foreach($lecturers as $lecturer)
                        <option value="{{ $lecturer->id }}" {{ old('lecturer_id', $classSchedule->lecturer_id) == $lecturer->id ? 'selected' : '' }}>{{ $lecturer->user->name }}</option>
                    @endforeach
                </select>
                @error('lecturer_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="day">Day</label>
                <select class="form-control @error('day') is-invalid @enderror" id="day" name="day" required>
                    <option value="">Select Day</option>
                    <option value="Senin" {{ old('day', $classSchedule->day) == 'Senin' ? 'selected' : '' }}>Senin</option>
                    <option value="Selasa" {{ old('day', $classSchedule->day) == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                    <option value="Rabu" {{ old('day', $classSchedule->day) == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                    <option value="Kamis" {{ old('day', $classSchedule->day) == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                    <option value="Jumat" {{ old('day', $classSchedule->day) == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                    <option value="Sabtu" {{ old('day', $classSchedule->day) == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                </select>
                @error('day')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="start_time">Start Time</label>
                <input type="time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" value="{{ old('start_time', $classSchedule->start_time) }}" required>
                @error('start_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="end_time">End Time</label>
                <input type="time" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" value="{{ old('end_time', $classSchedule->end_time) }}" required>
                @error('end_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="room">Room</label>
                <input type="text" class="form-control @error('room') is-invalid @enderror" id="room" name="room" value="{{ old('room', $classSchedule->room) }}" required>
                @error('room')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="class_type">Class Type</label>
                <select class="form-control @error('class_type') is-invalid @enderror" id="class_type" name="class_type" required>
                    <option value="theory" {{ old('class_type', $classSchedule->class_type) == 'theory' ? 'selected' : '' }}>Theory</option>
                    <option value="practice" {{ old('class_type', $classSchedule->class_type) == 'practice' ? 'selected' : '' }}>Practice</option>
                </select>
                @error('class_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
