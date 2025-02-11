@extends('activities.layout')
@section('content')
    <div class="container">
        <h1>Courses</h1>
        <a href="{{ route('courses.create') }}" class="btn btn-primary mb-3">Create New Course</a>
        <table id="coursesTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Semester</th>
                    <th>Group</th>
                    <th>Program</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $('#coursesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('courses.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'semester',
                        name: 'semester'
                    },
                    {
                        data: 'group',
                        name: 'group'
                    },
                    {
                        data: 'program',
                        name: 'program'
                    }, // Menampilkan nama program
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endpush
