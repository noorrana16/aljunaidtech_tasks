<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Grade Result</title>
    @extends('layouts.main')
@section(section: 'section-page')
</head><br>
<body>
    <h1>Grade Result</h1>
    <p><strong>Marks:</strong> {{ $marks }}</p>
    <p><strong>Grade:</strong> {{ $grade }}</p>
    <a href="/grade-form">Go Back</a>
    @endsection
</body>
</html>
