@extends('bulletins.layout')
@section('content')
<div class="container">
    <h1>Edit Bulletin</h1>
    <form action="{{ route('bulletins.update', $bulletin->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" value="{{ $bulletin->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" required>{{ $bulletin->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="details">Details</label>
            <textarea class="form-control" name="details" required>{{ $bulletin->details }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
