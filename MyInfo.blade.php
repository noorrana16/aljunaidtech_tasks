<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @push('title')
        <title>Personal Info</title>
    @endpush
</head>
@extends('layouts.main')
@section('section-page')

    <body style='background-color: #FBAB7E;background-image: linear-gradient(62deg, #FBAB7E 0%, #F7CE68 100%);'>

        {!! '<h1 style="color:teal"> Personal Info</h1>' !!}
        {!! '<p><strong>Name:</strong>' !!}
        {{ $personalInfo['Name'] }}</p>
        {!! '<p><strong>Gender:</strong>' !!}
        {{ $personalInfo['Gender'] }}</p>
        {!! '<p><strong>Age:</strong>' !!}
        {{ $personalInfo['Age'] }}</p>
        {!! '<p><strong>Date of Birth:</strong>' !!}
        {{ $personalInfo['DOB'] }}</p>
        {!! '<p><strong>Degree:</strong>' !!}
        {{ $personalInfo['Degree'] }}</p>
        {!! '<p><strong>Address:</strong>' !!}
        {{ $personalInfo['Address'] }}</p>
    @endsection
</body>

</html>
