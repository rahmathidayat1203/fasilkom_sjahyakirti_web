@extends('proposal_exams.layout')

@section('content')
    <div class="container">
        <h1>Proposal Exams</h1>
        <a href="{{ route('proposal-exams.create') }}" class="btn btn-primary mb-3">Create New Proposal Exam</a>
        <table class="table" id="proposalExamsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Text</th>
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
                        data: 'image',
                        name: 'image',
                        render: function(data) {
                            return '<img src="/storage/' + data + '" width="100" />';
                        }
                    },
                    {
                        data: 'text',
                        name: 'text'
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
