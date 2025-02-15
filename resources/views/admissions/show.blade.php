@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Admission Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Student Name: {{ $admission->student_name }}</h5>
                <p class="card-text">Student Email: {{ $admission->student_email }}</p>
                <p class="card-text">Student Phone: {{ $admission->student_phone }}</p>
                <p class="card-text">Application Date: {{ $admission->application_date }}</p>
                <p class="card-text">Status: {{ $admission->status }}</p>
                <p class="card-text">Notes: {{ $admission->notes }}</p>
            </div>
        </div>

        <a href="{{ route('admissions.edit', $admission->id) }}" class="btn btn-warning mt-3">Edit</a>
        <a href="{{ route('admissions.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection
