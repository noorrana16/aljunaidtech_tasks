<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @push('title')
        <title>Logical Operators</title>
    @endpush
</head>
@extends('layouts.main')
@section('section-page')
    {!! '<br>' !!}

    <body style='background-color: #FBDA61;background-image: linear-gradient(45deg, #FBDA61 0%, #FF5ACD 100%);'>

        {!!'<h2 style="color:black">Logical Operators</h2>' !!}
        {!!'<p><strong>Bool1:</strong>'!!} {{ $Bool1 ? 'True' : 'False' }}</p>
        {!!'<p><strong>Bool2:</strong>'!!}{{ $Bool2 ? 'True' : 'False' }}</p>
        {!!'<p><strong>Boolean AND:</strong>'!!} (true && false): {{ $ResultAND ? 'True' : 'False' }}</p>
        {!!'<p><strong>Boolean OR:</strong>'!!} (true || false): {{ $ResultOR ? 'True' : 'False' }}</p>
        {!!'<p><strong>Boolean NOT:</strong>'!!}(!true):{{ $notBool1 ? 'True' : 'False' }}</p>
        {!!'<p><strong>Boolean NOT:</strong>'!!}(!true):{{ $notBool2 ? 'True' : 'False' }}</p>
    @endsection
</body>

</html>
