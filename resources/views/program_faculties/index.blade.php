@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Program Faculties</h1>
    <a href="{{ route('program_faculties.create') }}" class="btn btn-primary mb-3">Create New Program Faculty</a>
    <table id="programFacultiesTable" class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Program</th>
                <th>Faculty</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
@endsection
@push('scripts')
<script>
    $(function() {
        $('#programFacultiesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('program_faculties.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
                { data: 'program', name: 'program.name' },
                { data: 'faculty', name: 'faculty.name' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endpush