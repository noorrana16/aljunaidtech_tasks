<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Grade</title>
    @extends('layouts.main')
@section(section: 'section-page')
</head><br>

<body>
    <form action="/grade" method="post">
        @csrf
        <label for="marks">Enter Marks (out of 100):</label>
        <input type="number" id="marks" name="marks" max="100" min="0" required>
        <input type="submit" value="Assign Grade" style="background-color: lightblue; color: black;">
    </form>
@endsection
</body>
</html>
