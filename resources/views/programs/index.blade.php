@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Programs</h1>
        <a href="{{ route('programs.create') }}" class="btn btn-primary mb-3">Create New Program</a>
        <table id="programsTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Faculty</th>
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
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'faculty.name',
                        name: 'faculty.name'
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
