<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @push('title')
        <title>Arithmetic Operators</title>
    @endpush
</head>
@extends('layouts.main')
@section('section-page'){!! '<br>' !!}

    <body style='background-color: #FBDA61;background-image: linear-gradient(45deg, #a9ff68 0%, #432371 100%);'>
       {!! ' <h2 style="color:black">Arithmetic Operations</h2>' !!}
        @foreach ($results as $result => $value)
            <p><strong>{{ ucfirst($result) }}:</strong> {{ $value }}</p>
        @endforeach
    @endsection
</body>

</html>
