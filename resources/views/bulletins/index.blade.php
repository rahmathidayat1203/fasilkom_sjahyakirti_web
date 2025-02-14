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
                    <th>Description</th>
                    <th>Details</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    @push('scripts')
        <script>
            $(function() {
                $('#bulletinsTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('bulletins.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false, searchable: false
                        },
                        {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'description',
                            name: 'description'
                        },
                        {
                            data: 'details',
                            name: 'details'
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
@endsection
