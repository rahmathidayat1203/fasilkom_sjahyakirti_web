<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fakultas Ilmu Komputer</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('activities.index') }}">Fakultas Ilmu Komputer</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('activities.index') }}">Activities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bulletins.index') }}">Bulletins</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('faculties.index') }}">Faculties</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('programs.index') }}">Programs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('courses.index') }}">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('program_faculties.index') }}">Program Faculties</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('academic_calendars.index') }}">Academic Calendars</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('class-schedules.index') }}">Class Schedules</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('proposal-exams.index') }}">Proposal Exams</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('student_activity_units.index') }}">Student Activity Units</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('student-infos.index') }}">Student Infos</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

    @stack('scripts')
</body>

</html>
