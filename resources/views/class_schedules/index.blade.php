@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Class Schedules</h1>
        <a href="{{ route('class-schedules.create') }}" class="btn btn-primary mb-3">Create New Class Schedule</a>
        <table id="classSchedulesTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Course</th>
                    <th>Lecturer</th>
                    <th>Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Room</th>
                    <th>Class Type</th>
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
                        data: 'course.name',
                        name: 'course.name'
                    },
                    {
                        data: 'lecturer.user.name',
                        name: 'lecturer.user.name'
                    },
                    {
                        data: 'day',
                        name: 'day'
                    },
                    {
                        data: 'start_time',
                        name: 'start_time'
                    },
                    {
                        data: 'end_time',
                        name: 'end_time'
                    },
                    {
                        data: 'room',
                        name: 'room'
                    },
                    {
                        data: 'class_type',
                        name: 'class_type'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush
