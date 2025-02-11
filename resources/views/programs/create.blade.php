@extends('programs.layout')
@section('content')
<div class="container">
    <h1>Create Program</h1>

    <form action="{{ route('programs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="banner">Banner</label>
            <input type="file" class="form-control" name="banner" required>
        </div>
        <div class="form-group">
            <label for="current_info">Current Info</label>
            <input type="text" class="form-control" name="current_info" required>
        </div>
        <div class="form-group">
            <label for="vision">Vision</label>
            <input type="text" class="form-control" name="vision" required>
        </div>
        <div class="form-group">
            <label for="mission">Mission</label>
            <input type="text" class="form-control" name="mission" required>
        </div>
        <div class="form-group">
            <label for="goals">Goals</label>
            <input type="text" class="form-control" name="goals" required>
        </div>
        <div class="form-group">
            <label for="objectives">Objectives</label>
            <input type="text" class="form-control" name="objectives" required>
        </div>
        <div class="form-group">
            <label for="head_welcome_message">Head Welcome Message</label>
            <input type="text" class="form-control" name="head_welcome_message" required>
        </div>
        <div class="form-group">
            <label for="head_photo">Head Photo</label>
            <input type="file" class="form-control" name="head_photo" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Program</button>
    </form>
</div>
@endsection
