@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Proposal Exams</h1>
        <a href="{{ route('proposal-exams.create') }}" class="btn btn-primary mb-3">Create New Proposal Exam</a>
        <table class="table" id="proposalExamsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Document</th>
                    <th>Feedback</th>
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
            $('#proposalExamsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('proposal-exams.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
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
                        data: 'document_path',
                        name: 'document_path',
                        render: function(data) {
                            return '<a href="{{ asset('storage') }}/' + data +
                                '" target="_blank">View Document</a>';
                        }
                    },
                    {
                        data: 'feedback',
                        name: 'feedback'
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
