@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Admissions</h1>
        <a href="{{ route('admissions.create') }}" class="btn btn-primary mb-3">Create New Admission</a>
        <table id="admissionsTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Program ID</th>
                    <th>Registration Number</th>
                    <th>Status</th>
                    <th>Application Date</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $('#admissionsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admissions.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'user_id',
                        name: 'user_id'
                    },
                    {
                        data: 'program_id',
                        name: 'program_id'
                    },
                    {
                        data: 'registration_number',
                        name: 'registration_number'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
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
