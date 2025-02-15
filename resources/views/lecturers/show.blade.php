@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lecturer Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">NIDN: {{ $lecturer->nidn }}</h5>
                <p class="card-text">User ID: {{ $lecturer->user_id }}</p>
                <p class="card-text">Phone: {{ $lecturer->phone }}</p>
                <p class="card-text">Address: {{ $lecturer->address }}</p>
                <p class="card-text">Birth Date: {{ $lecturer->birth_date }}</p>
                <p class="card-text">Birth Place: {{ $lecturer->birth_place }}</p>
            </div>
        </div>

        <a href="{{ route('lecturers.edit', $lecturer->id) }}" class="btn btn-warning mt-3">Edit</a>
        <a href="{{ route('lecturers.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection
