@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Semester Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Name: {{ $semester->name }}</h5>
                <p class="card-text">Start Date: {{ $semester->start_date }}</p>
                <p class="card-text">End Date: {{ $semester->end_date }}</p>
                <p class="card-text">Is Active: {{ $semester->is_active ? 'Yes' : 'No' }}</p>
            </div>
        </div>

        <a href="{{ route('semesters.edit', $semester->id) }}" class="btn btn-warning mt-3">Edit</a>
        <a href="{{ route('semesters.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection
