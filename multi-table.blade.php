<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Multiplication Tables</title>

        <style>
            body {
                font-family: 'Times New Roman', Times, serif;
                margin: 20px;
                padding: 20px;
                text-align: left;
            }

            input[type="number"] {
                padding: 8px;
                width: 200px;
            }

            button {
                padding: 10px 20px;
                background: green;
                color: white;
                border: none;
                cursor: pointer;
            }

            button:hover {
                background: darkgreen;
            }
        </style>
        @extends('layouts.main')
        @section(section: 'section-page')
    </head><br>

    <body>
       {{--  @if (session('error'))
            <p style="color: red;"><strong>Error:</strong> {{ session('error') }}</p>
        @endif--}}

        <form action="{{ url('/table') }}" method="POST">
            @csrf
            <input type="number" name="number" min="1" required placeholder="Enter a number">
            <button type="submit">Generate Table</button>
        </form><br>

        @if (isset($table))
        <h3>Multiplication Table of : {{ session($number) }} {{ $number  = $_POST["number"];}}</h3>
            <table border="1" cellpadding='15' style='background-color:#D9AFD9;'>
                <tr>
                    <th>Multiplication</th>
                </tr>
                @foreach ($table as $row)
                    <tr>
                        <td>{{ $row }}</td>
                    </tr>
                @endforeach
            </table>
        @endif

    </body>

    </html>
    @endsection
