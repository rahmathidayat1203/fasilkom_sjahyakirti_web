@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Lecturer</h1>

        <form action="{{ route('lecturers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}" required>
                @error('usnameer_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nidn">NIDN</label>
                <input type="text" class="form-control @error('nidn') is-invalid @enderror" id="nidn" name="nidn"
                    value="{{ old('nidn') }}" required>
                @error('nidn')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                    name="phone" value="{{ old('phone') }}">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address">{{ old('address') }}</textarea>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="birth_date">Birth Date</label>
                <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date"
                    name="birth_date" value="{{ old('birth_date') }}">
                @error('birth_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="birth_place">Birth Place</label>
                <input type="text" class="form-control @error('birth_place') is-invalid @enderror" id="birth_place"
                    name="birth_place" value="{{ old('birth_place') }}">
                @error('birth_place')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
                @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="expertise">Expertise</label>
                <input type="text" class="form-control @error('expertise') is-invalid @enderror" id="expertise"
                    name="expertise" value="{{ old('expertise') }}">
                @error('expertise')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="faculty_id">Faculty</label>
                <select class="form-control @error('faculty_id') is-invalid @enderror" id="faculty_id" name="faculty_id"
                    required>
                    <option value="">Select Faculty</option>
                    @foreach ($faculties as $faculty)
                        <option value="{{ $faculty->id }}" {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}>
                            {{ $faculty->name }}</option>
                    @endforeach
                </select>
                @error('faculty_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="program_id">Program</label>
                <select class="form-control @error('program_id') is-invalid @enderror" id="program_id" name="program_id"
                    required>
                    <option value="">Select Program</option>
                    @foreach ($programs as $program)
                        <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                            {{ $program->name }}</option>
                    @endforeach
                </select>
                @error('program_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="created_by">Author ID</label>
                <input type="number" class="form-control @error('created_by') is-invalid @enderror" id="created_by"
                    name="created_by" value="{{ old('created_by') }}" required>
                @error('created_by')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
