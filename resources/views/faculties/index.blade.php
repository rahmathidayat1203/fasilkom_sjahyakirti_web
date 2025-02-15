@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Faculties</h1>
        <a href="{{ route('faculties.create') }}" class="btn btn-primary mb-3">Create New Faculty</a>
        <table id="facultiesTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Welcome Message</th>
                    <th>History</th>
                    <th>Vision</th>
                    <th>Mission</th>
                    <th>Goals</th>
                    <th>Objectives</th>
                    <th>Dean Message</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#facultiesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('faculties.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'slug',
                        name: 'slug'
                    },
                    {
                        data: 'welcome_message',
                        name: 'welcome_message'
                    },
                    {
                        data: 'history',
                        name: 'history'
                    },
                    {
                        data: 'vision',
                        name: 'vision'
                    },
                    {
                        data: 'mission',
                        name: 'mission'
                    },
                    {
                        data: 'goals',
                        name: 'goals'
                    },
                    {
                        data: 'objectives',
                        name: 'objectives'
                    },
                    {
                        data: 'dean_message',
                        name: 'dean_message'
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
