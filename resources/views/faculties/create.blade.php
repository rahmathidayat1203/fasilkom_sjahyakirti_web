@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Create Faculty</h1>
        <form action="{{ route('faculties.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label for="welcome_message">Welcome Message</label>
                <textarea class="form-control" name="welcome_message" required></textarea>
            </div>
            <div class="form-group">
                <label for="history">History</label>
                <textarea class="form-control" name="history" required></textarea>
            </div>
            <div class="form-group">
                <label for="structure_image">Structure Image</label>
                <input type="file" class="form-control" name="structure_image" required>
            </div>
            <div class="form-group">
                <label for="vision">Vision</label>
                <textarea class="form-control" name="vision" required></textarea>
            </div>
            <div class="form-group">
                <label for="mission">Mission</label>
                <textarea class="form-control" name="mission" required></textarea>
            </div>
            <div class="form-group">
                <label for="goals">Goals</label>
                <textarea class="form-control" name="goals" required></textarea>
            </div>
            <div class="form-group">
                <label for="objectives">Objectives</label>
                <textarea class="form-control" name="objectives" required></textarea>
            </div>
            <div class="form-group">
                <label for="dean_photo">Dean Photo</label>
                <input type="file" class="form-control" name="dean_photo" required>
            </div>
            <div class="form-group">
                <label for="dean_message">Dean Message</label>
                <textarea class="form-control" name="dean_message" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Faculty</button>
        </form>
    </div>
@endsection
