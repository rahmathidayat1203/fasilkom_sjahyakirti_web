@extends('faculties.layout')
@section('content')
    <div class="container">
        <h1>Edit Faculty</h1>

        <form action="{{ route('faculties.update', $faculty->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $faculty->name }}" required>
            </div>

            <div class="form-group">
                <label for="welcome_message">Welcome Message</label>
                <textarea class="form-control" id="welcome_message" name="welcome_message" required>{{ $faculty->welcome_message }}</textarea>
            </div>

            <div class="form-group">
                <label for="history">History</label>
                <textarea class="form-control" id="history" name="history" required>{{ $faculty->history }}</textarea>
            </div>

            <div class="form-group">
                <label for="structure_image">Structure Image</label>
                <input type="file" class="form-control" id="structure_image" name="structure_image">
                <small>Current Image: <img src="{{ asset('storage/' . $faculty->structure_image) }}" width="100"></small>
            </div>

            <div class="form-group">
                <label for="vision">Vision</label>
                <textarea class="form-control" id="vision" name="vision" required>{{ $faculty->vision }}</textarea>
            </div>

            <div class="form-group">
                <label for="mission">Mission</label>
                <textarea class="form-control" id="mission" name="mission" required>{{ $faculty->mission }}</textarea>
            </div>

            <div class="form-group">
                <label for="goals">Goals</label>
                <textarea class="form-control" id="goals" name="goals" required>{{ $faculty->goals }}</textarea>
            </div>

            <div class="form-group">
                <label for="objectives">Objectives</label>
                <textarea class="form-control" id="objectives" name="objectives" required>{{ $faculty->objectives }}</textarea>
            </div>

            <div class="form-group">
                <label for="dean_photo">Dean Photo</label>
                <input type="file" class="form-control" id="dean_photo" name="dean_photo">
                <small>Current Photo: <img src="{{ asset('storage/' . $faculty->dean_photo) }}" width="100"></small>
            </div>

            <div class="form-group">
                <label for="dean_message">Dean Message</label>
                <textarea class="form-control" id="dean_message" name="dean_message" required>{{ $faculty->dean_message }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Faculty</button>
            <a href="{{ route('faculties.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
