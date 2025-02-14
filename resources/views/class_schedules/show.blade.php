@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ $activity->title }}</h1>
        <p>{{ $activity->description }}</p>
        @if ($activity->image)
            <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->title }}" width="300">
        @endif
        <a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        <a href="{{ route('activities.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection
