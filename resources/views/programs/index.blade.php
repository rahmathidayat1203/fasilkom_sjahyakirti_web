@extends('programs.layout')

@section('content')
    <div class="container">
        <h1>Programs</h1>
        <a href="{{ route('programs.create') }}" class="btn btn-primary mb-3">Create New Program</a>
        <table id="programsTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Banner</th>
                    <th>Current Info</th>
                    <th>Vision</th>
                    <th>Mission</th>
                    <th>Goals</th>
                    <th>Objectives</th>
                    <th>Head Welcome Message</th>
                    <th>Head Photo</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $('#programsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('programs.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'banner',
                        name: 'banner',
                        render: function(data) {
                            return '<img src="/storage/' + data + '" width="100" />';
                        }
                    },
                    {
                        data: 'current_info',
                        name: 'current_info'
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
                        data: 'head_welcome_message',
                        name: 'head_welcome_message'
                    },
                    {
                        data: 'head_photo',
                        name: 'head_photo',
                        render: function(data) {
                            return '<img src="/storage/' + data + '" width="100" />';
                        }
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
