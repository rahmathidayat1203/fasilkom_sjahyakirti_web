@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Edit Class Schedule</h1>

        <form action="{{ route('class-schedules.update', $classSchedule->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image">
                <img src="{{ Storage::url($classSchedule->image) }}" width="100" class="mt-2">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" required>{{ $classSchedule->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="announcement">Announcement</label>
                <textarea class="form-control" name="announcement">{{ $classSchedule->announcement }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
