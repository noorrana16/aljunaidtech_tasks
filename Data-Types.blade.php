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
    {!! '<br>' !!}

    <body style='background-color: #c5f9d7;background-image: linear-gradient(90deg, #ede342 0%, #f27a7d 100%);'>

        {!! '<h2 style="color:black; text-align:center;">Data Types:</h2><br>' !!}
        <div style="text-align:center;">
            {!! '<h5 style="color:teal";>Using gettype:</h5>' !!}

            @foreach ($data as $key => $value)
                <p><strong>{{ $key }}:</strong>
                    (Type: {{ gettype($value) }}) {!!'<br>'!!}
            @endforeach
        </div>

        <div style="text-align:center;">
            {!! '<h5 style="color:teal";>Using var_dump:</h5>' !!}
            @foreach ($data as $key => $value)
                <p><strong>{{ $key }}:</strong>
                   @php var_dump($value); @endphp</p>
            @endforeach
        </div>
    @endsection
</body>

</html>
