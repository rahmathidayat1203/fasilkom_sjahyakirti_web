@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Edit Program</h1>

    <form action="{{ route('programs.update', $program->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $program->name }}" required>
        </div>
        <div class="form-group">
            <label for="banner">Banner</label>
            <input type="file" class="form-control" name="banner">
            <img src="/storage/{{ $program->banner }}" width="100" class="mt-2">
        </div>
        <div class="form-group">
            <label for="current_info">Current Info</label>
            <input type="text" class="form-control" name="current_info" value="{{ $program->current_info }}" required>
        </div>
        <div class="form-group">
            <label for="vision">Vision</label>
            <input type="text" class="form-control" name="vision" value="{{ $program->vision }}" required>
        </div>
        <div class="form-group">
            <label for="mission">Mission</label>
            <input type="text" class="form-control" name="mission" value="{{ $program->mission }}" required>
        </div>
        <div class="form-group">
            <label for="goals">Goals</label>
            <input type="text" class="form-control" name="goals" value="{{ $program->goals }}" required>
        </div>
        <div class="form-group">
            <label for="objectives">Objectives</label>
            <input type="text" class="form-control" name="objectives" value="{{ $program->objectives }}" required>
        </div>
        <div class="form-group">
            <label for="head_welcome_message">Head Welcome Message</label>
            <input type="text" class="form-control" name="head_welcome_message" value="{{ $program->head_welcome_message }}" required>
        </div>
        <div class="form-group">
            <label for="head_photo">Head Photo</label>
            <input type="file" class="form-control" name="head_photo">
            <img src="/storage/{{ $program->head_photo }}" width="100" class="mt-2">
        </div>
        <button type="submit" class="btn btn-primary">Update Program</button>
    </form>
</div>
@endsection
