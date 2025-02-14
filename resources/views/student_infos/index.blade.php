@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Student Infos</h1>
        <a href="{{ route('student-infos.create') }}" class="btn btn-primary mb-3">Create New Student Info</a>
        <table id="studentInfosTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
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
            $('#studentInfosTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('student-infos.index') }}",
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
