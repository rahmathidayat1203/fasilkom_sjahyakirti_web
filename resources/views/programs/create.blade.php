@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Program</h1>

        <form action="{{ route('programs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="faculty_id">Faculty</label>
                <select class="form-control @error('faculty_id') is-invalid @enderror" id="faculty_id" name="faculty_id"
                    required>
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
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                    value="{{ old('slug') }}" required readonly>
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="banner">Banner</label>
                <input type="file" class="form-control @error('banner') is-invalid @enderror" id="banner"
                    name="banner">
                @error('banner')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="current_info">Current Info</label>
                <textarea class="form-control @error('current_info') is-invalid @enderror" id="current_info" name="current_info"
                    required>{{ old('current_info') }}</textarea>
                @error('current_info')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="vision">Vision</label>
                <textarea class="form-control @error('vision') is-invalid @enderror" id="vision" name="vision" required>{{ old('vision') }}</textarea>
                @error('vision')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="mission">Mission</label>
                <textarea class="form-control @error('mission') is-invalid @enderror" id="mission" name="mission" required>{{ old('mission') }}</textarea>
                @error('mission')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="goals">Goals</label>
                <textarea class="form-control @error('goals') is-invalid @enderror" id="goals" name="goals" required>{{ old('goals') }}</textarea>
                @error('goals')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="objectives">Objectives</label>
                <textarea class="form-control @error('objectives') is-invalid @enderror" id="objectives" name="objectives" required>{{ old('objectives') }}</textarea>
                @error('objectives')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="head_welcome_message">Head Welcome Message</label>
                <textarea class="form-control @error('head_welcome_message') is-invalid @enderror" id="head_welcome_message"
                    name="head_welcome_message" required>{{ old('head_welcome_message') }}</textarea>
                @error('head_welcome_message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="head_photo">Head Photo</label>
                <input type="file" class="form-control @error('head_photo') is-invalid @enderror" id="head_photo"
                    name="head_photo">
                @error('head_photo')
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
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#name').on('change', function() {
                const title = $(this).val();
                const slug = generateSlug(title);
                $('#slug').val(slug);
            });

            function generateSlug(title) {
                if (!title) return '';
                let slug = title.toLowerCase();
                slug = slug.replace(/[\s\W-]+/g, '-');
                slug = slug.replace(/^-+|-+$/g, '');
                slug = slug.replace(/-+/g, '-');
                return slug;
            }
        });
    </script>
@endpush
