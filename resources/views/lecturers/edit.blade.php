@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Lecturer</h1>

        <form action="{{ route('lecturers.update', $lecturer->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="user_id">User ID</label>
                <input type="number" class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" value="{{ old('user_id', $lecturer->user_id) }}" required>
                @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nidn">NIDN</label>
                <input type="text" class="form-control @error('nidn') is-invalid @enderror" id="nidn" name="nidn" value="{{ old('nidn', $lecturer->nidn) }}" required>
                @error('nidn')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $lecturer->phone) }}">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address">{{ old('address', $lecturer->address) }}</textarea>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="birth_date">Birth Date</label>
                <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date', $lecturer->birth_date) }}">
                @error('birth_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="birth_place">Birth Place</label>
                <input type="text" class="form-control @error('birth_place') is-invalid @enderror" id="birth_place" name="birth_place" value="{{ old('birth_place', $lecturer->birth_place) }}">
                @error('birth_place')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender', $lecturer->gender) == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $lecturer->gender) == 'female' ? 'selected' : '' }}>Female</option>
                </select>
                @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="expertise">Expertise</label>
                <input type="text" class="form-control @error('expertise') is-invalid @enderror" id="expertise" name="expertise" value="{{ old('expertise', $lecturer->expertise) }}">
                @error('expertise')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="faculty_id">Faculty</label>
                <input type="number" class="form-control @error('faculty_id') is-invalid @enderror" id="faculty_id" name="faculty_id" value="{{ old('faculty_id', $lecturer->faculty_id) }}" required>
                @error('faculty_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="program_id">Program</label>
                <input type="number" class="form-control @error('program_id') is-invalid @enderror" id="program_id" name="program_id" value="{{ old('program_id', $lecturer->program_id) }}" required>
                @error('program_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="created_by">Author ID</label>
                <input type="number" class="form-control @error('created_by') is-invalid @enderror" id="created_by" name="created_by" value="{{ old('created_by', $lecturer->created_by) }}" required>
                @error('created_by')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
