@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Academic Calendars</h1>
        <a href="{{ route('academic_calendars.create') }}" class="btn btn-primary mb-3">Create New Calendar</a>
        <table id="academicCalendarsTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Semester</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $('#academicCalendarsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('academic_calendars.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false, searchable: false
                    },
                    {
                        data: 'semester',
                        name: 'semester'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'description',
                        name: 'description'
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
