@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Lecturer</h1>

        <form action="{{ route('lecturers.update', $lecturer->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="user_id">User ID</label>
                <input type="number" class="form-control" id="user_id" name="user_id" value="{{ $lecturer->user_id }}"
                    required>
            </div>
            <div class="form-group">
                <label for="nidn">NIDN</label>
                <input type="text" class="form-control" id="nidn" name="nidn" value="{{ $lecturer->nidn }}"
                    required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $lecturer->phone }}">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address">{{ $lecturer->address }}</textarea>
            </div>
            <div class="form-group">
                <label for="birth_date">Birth Date</label>
                <input type="date" class="form-control" id="birth_date" name="birth_date"
                    value="{{ $lecturer->birth_date }}">
            </div>
            <div class="form-group">
                <label for="birth_place">Birth Place</label>
                <input type="text" class="form-control" id="birth_place" name="birth_place"
                    value="{{ $lecturer->birth_place }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
