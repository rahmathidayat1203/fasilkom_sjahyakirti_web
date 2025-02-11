@extends('faculties.layout')

@section('content')
    <div class="container">
        <h1>Faculties</h1>
        <a href="{{ route('faculties.create') }}" class="btn btn-primary mb-3">Create New Faculty</a>
        <table id="facultiesTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Welcome Message</th>
                    <th>History</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>

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
                            data: 'welcome_message',
                            name: 'welcome_message'
                        },
                        {
                            data: 'history',
                            name: 'history'
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
@endsection
