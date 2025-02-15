@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Faculty</h1>

        <form action="{{ route('faculties.update', $faculty->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $faculty->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                    value="{{ old('slug', $faculty->slug) }}" required readonly>
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="welcome_message">Welcome Message</label>
                <textarea class="form-control @error('welcome_message') is-invalid @enderror" id="welcome_message"
                    name="welcome_message" required>{{ old('welcome_message', $faculty->welcome_message) }}</textarea>
                @error('welcome_message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="history">History</label>
                <textarea class="form-control @error('history') is-invalid @enderror" id="history" name="history" required>{{ old('history', $faculty->history) }}</textarea>
                @error('history')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="structure_image">Structure Image</label>
                <input type="file" class="form-control @error('structure_image') is-invalid @enderror"
                    id="structure_image" name="structure_image">
                @error('structure_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if ($faculty->structure_image)
                    <img src="{{ asset('storage/' . $faculty->structure_image) }}" alt="Current Structure Image"
                        style="max-width: 200px; height: auto; margin-top: 10px;">
                @endif
            </div>
            <div class="form-group">
                <label for="vision">Vision</label>
                <textarea class="form-control @error('vision') is-invalid @enderror" id="vision" name="vision" required>{{ old('vision', $faculty->vision) }}</textarea>
                @error('vision')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="mission">Mission</label>
                <textarea class="form-control @error('mission') is-invalid @enderror" id="mission" name="mission" required>{{ old('mission', $faculty->mission) }}</textarea>
                @error('mission')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="goals">Goals</label>
                <textarea class="form-control @error('goals') is-invalid @enderror" id="goals" name="goals" required>{{ old('goals', $faculty->goals) }}</textarea>
                @error('goals')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="objectives">Objectives</label>
                <textarea class="form-control @error('objectives') is-invalid @enderror" id="objectives" name="objectives" required>{{ old('objectives', $faculty->objectives) }}</textarea>
                @error('objectives')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="dean_photo">Dean Photo</label>
                <input type="file" class="form-control @error('dean_photo') is-invalid @enderror" id="dean_photo"
                    name="dean_photo">
                @error('dean_photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if ($faculty->dean_photo)
                    <img src="{{ asset('storage/' . $faculty->dean_photo) }}" alt="Current Dean Photo"
                        style="max-width: 200px; height: auto; margin-top: 10px;">
                @endif
            </div>
            <div class="form-group">
                <label for="dean_message">Dean Message</label>
                <textarea class="form-control @error('dean_message') is-invalid @enderror" id="dean_message" name="dean_message"
                    required>{{ old('dean_message', $faculty->dean_message) }}</textarea>
                @error('dean_message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="created_by">Author ID</label>
                <input type="number" class="form-control @error('created_by') is-invalid @enderror" id="created_by"
                    name="created_by" value="{{ old('created_by', $faculty->created_by) }}" required>
                @error('created_by')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
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
