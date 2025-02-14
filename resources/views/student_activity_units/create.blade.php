@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Create Student Activity Unit</h1>
        <form action="{{ route('student_activity_units.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image" required>
            </div>
            <div class="form-group">
                <label for="procedure">Procedure</label>
                <textarea class="form-control" name="procedure" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </div>
@endsection
