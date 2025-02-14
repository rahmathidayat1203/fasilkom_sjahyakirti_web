@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Create Bulletin</h1>
    <form action="{{ route('bulletins.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="details">Details</label>
            <textarea class="form-control" name="details" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection
