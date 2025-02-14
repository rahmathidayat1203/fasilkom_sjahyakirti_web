@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Edit Student Activity Unit</h1>
        <form action="{{ route('student_activity_units.update', $unit->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image">
                <img src="{{ Storage::url($unit->image) }}" width="100" class="mt-2">
            </div>
            <div class="form-group">
                <label for="procedure">Procedure</label>
                <textarea class="form-control" name="procedure" required>{{ $unit->procedure }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
