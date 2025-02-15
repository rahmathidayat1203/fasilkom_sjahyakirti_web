@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Activity</h1>
        <form action="{{ route('activities.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror"
                    value="{{ old('slug') }}" required readonly>
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Image (optional)</label>
                <input type="file" name="image" id="image"
                    class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control @error('category') is-invalid @enderror"
                    required>
                    <option value="">Select Category</option>
                    <option value="Event" {{ old('category') == 'Event' ? 'selected' : '' }}>Event</option>
                    <option value="Berita" {{ old('category') == 'Berita' ? 'selected' : '' }}>Berita</option>
                    <option value="Pengumuman" {{ old('category') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                    <option value="Wisuda" {{ old('category') == 'Wisuda' ? 'selected' : '' }}>Wisuda</option>
                </select>
                @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="datetime-local" name="start_date" id="start_date"
                    class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}"
                    required>
                @error('start_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="end_date">End Date (optional)</label>
                <input type="datetime-local" name="end_date" id="end_date"
                    class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}">
                @error('end_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="created_by">Created By</label>
                <input type="number" name="created_by" id="created_by"
                    class="form-control @error('created_by') is-invalid @enderror" value="{{ old('created_by') }}"
                    required>
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
            $('#title').on('change', function() {
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
