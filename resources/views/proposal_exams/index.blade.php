@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Proposal Exams</h1>
        <a href="{{ route('proposal-exams.create') }}" class="btn btn-primary mb-3">Create New Proposal Exam</a>
        <table class="table" id="proposalExamsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student</th>
                    <th>Supervisor</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Scheduled Date</th>
                    <th>Scheduled Time</th>
                    <th>Room</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#proposalExamsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('proposal-exams.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'student.name',
                        name: 'student.name'
                    },
                    {
                        data: 'supervisor.name',
                        name: 'supervisor.name'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'scheduled_date',
                        name: 'scheduled_date'
                    },
                    {
                        data: 'scheduled_time',
                        name: 'scheduled_time'
                    },
                    {
                        data: 'room',
                        name: 'room'
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
