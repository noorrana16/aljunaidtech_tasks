<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @push('title')
        <title>Data Types</title>
    @endpush
</head>
@extends('layouts.main')
@section(section: 'section-page')
<body style='background-color: #f8dadc;background-image: linear-gradient(62deg, #dcf180 0%, #99aceb 100%);'>

        {!! '<h2 style="color:teal">Swapped Values</h2>' !!}
        {!! '<p><strong>Before Swapping:</strong>' !!}
        A = {{ $before['a'] }}, B = {{ $before['b'] }}</p>
        {!! '<p><strong>After Swapping:</strong>' !!}
        A = {{ $after['a'] }}, B = {{ $after['b'] }}</p>
    @endsection
</body>

</html>
