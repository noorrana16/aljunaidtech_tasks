<?php include 'header.php'; ?>
<?php include 'footer.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Books List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: teal;
            color: white;
            padding-left: 2.5%;
            margin: auto;
        }
    </style>
</head><br>

<body>

    <div class="container mt-4">
        <h2 class="text-center mb-4">Details of Books</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-success">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Price (PKR)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Multidimensional array: Each book has title, author, and price
                //Multidimensional Array
                $books = [
                    [
                        'Title' => 'The Alchemist',
                        'Author' => 'Paulo Coelho',
                        'Price' => 599
                    ],
                    [
                        'Title' => 'The Power of Now',
                        'Author' => 'Eckhart Tolle',
                        'Price' => 500,
                    ],
                    [
                        'Title' => 'Harry Potter',
                        'Author' => 'J.K.Rowling',
                        'Price' => 3800
                    ],
                ];
                // Update the price of the Second Book
                $books[1]['Price'] = 600;
                foreach ($books as $index => $book) {
                    echo '<tr>';
                    echo '<td>' . $book['Title'] . '</td>';
                    echo '<td>' . $book['Author'] . '</td>';
                    if ($index == 1) {
                        echo '<td><b>Rs.' . number_format($book['Price'], 2) . ' (Updated)</b></td>';
                    } else {
                        echo '<td>Rs.' . number_format($book['Price'], 2) . '</td>';
                    }
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>