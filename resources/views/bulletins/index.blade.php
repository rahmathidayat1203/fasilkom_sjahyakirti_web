@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Bulletins</h1>
        <a href="{{ route('bulletins.create') }}" class="btn btn-primary mb-3">Create New Bulletin</a>
        <table id="bulletinsTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Excerpt</th>
                    <th>Priority</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $('#bulletinsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('bulletins.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'excerpt',
                        name: 'excerpt'
                    },
                    {
                        data: 'priority',
                        name: 'priority'
                    },
                    {
                        data: 'created_by',
                        name: 'created_by'
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
