@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Admissions</h1>
        <a href="{{ route('admissions.create') }}" class="btn btn-primary mb-3">Create New Admission</a>
        <table id="admissionsTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Mahasiswa</th>
                    <th>Email</th>
                    <th>Status Pendaftaran</th>
                    <th>Tanggal Pendaftaran</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $('#admissionsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admissions.index') }}",
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama_mhs',
                        name: 'nama_mhs'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'status_pendaftaran',
                        name: 'status_pendaftaran'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
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