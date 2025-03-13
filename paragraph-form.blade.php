<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paragraph</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body class="container mt-5">

    <h2 class="text-success">Enter a Paragraph (500+ Words)</h2>

    {{--@if (session('error'))
        <p style="color: red;"><strong>Error:</strong> {{ session('error') }}</p>
    @endif--}}

    <form action="{{ url('/paragraph') }}" method="POST">
        @csrf
        <div class="mb-2">
            <textarea class="form-control" name="paragraph" id="" rows="10" placeholder="Enter your paragraph here..." style="background-color: lightgray"
                required></textarea>
        </div><br>
        <button type="submit" class="btn btn-success mb-3"> Submit</button>
    </form>

</body>

</html>
