@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Student Activity Units</h1>
        <a href="{{ route('student_activity_units.create') }}" class="btn btn-primary mb-3">Create New Unit</a>
        <table class="table" id="unitsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Procedure</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $('#unitsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('student_activity_units.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false, searchable: false
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'procedure',
                        name: 'procedure'
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
