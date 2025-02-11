@extends('class_schedules.layout')

@section('content')
    <div class="container">
        <h1>Class Schedules</h1>
        <a href="{{ route('class-schedules.create') }}" class="btn btn-primary mb-3">Create New Class Schedule</a>
        <table id="classSchedulesTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Announcement</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $('#classSchedulesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('class-schedules.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'announcement',
                        name: 'announcement'
                    },
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
