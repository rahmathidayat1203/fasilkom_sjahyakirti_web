@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Create Class Schedule</h1>

        <form action="{{ route('class-schedules.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="announcement">Announcement</label>
                <textarea class="form-control" name="announcement"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
