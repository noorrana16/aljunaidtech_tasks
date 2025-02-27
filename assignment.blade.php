<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @push('title')
        <title>Assignment Operators</title>
    @endpush
</head>
@extends('layouts.main')
@section('section-page'){!! '<br>' !!}

    <body style='background-color: #eca9bb;
background-image: linear-gradient(45deg, #83f5e5 0%, #e49e71 100%);
'>

        {!! '<h2 style="color:black">Assignment Operators:</h2>' !!}
        {!! '<p><strong>Before Value:</strong>' !!}{{ $before }}</p>
        @foreach ($operations as $operation => $value)
            <p><strong>After Values: {{ $operation }}:</strong> {{ $value }}</p>
        @endforeach
    @endsection
</body>

</html>
