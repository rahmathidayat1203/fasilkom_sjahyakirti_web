@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Activities</h1>
        <a href="{{ route('activities.create') }}" class="btn btn-primary mb-3">Create New Activity</a>
        <table id="activitiesTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#activitiesTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('activities.index') }}",
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
                            data: 'image',
                            name: 'image',
                            render: function(data) {
                                return '<img src="/storage/images/' + data + '" width="100" />';
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
@endsection
