@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lecturers</h1>
        <a href="{{ route('lecturers.create') }}" class="btn btn-primary mb-3">Create New Lecturer</a>
        <table id="lecturersTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NIDN</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Birth Date</th>
                    <th>Birth Place</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#lecturersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('lecturers.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nidn',
                        name: 'nidn'
                    },
                    {
                        data: 'user_name',
                        name: 'user_name'
                    }, // Assuming you have a relationship with User model
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'birth_date',
                        name: 'birth_date'
                    },
                    {
                        data: 'birth_place',
                        name: 'birth_place'
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
