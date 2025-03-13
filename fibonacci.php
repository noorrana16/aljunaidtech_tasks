<?php include 'header.php'; ?>
<?php include 'footer.php'; ?><br><br>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Fibonacci Numbers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #02a388;
            color: white;
            padding-left: 2%;
            margin: auto;
        }
    </style>
</head>
<?php
//Fibonacci numbers to generate
$n = 10;

// Initialize the first two Fibonacci numbers
$fib1 = 0;
$fib2 = 1;
echo "<h2>Fibonacci Series:</h2>";

echo "First $n Fibonacci Numbers: ";

echo "$fib1, $fib2";

for ($i = 2; $i < 10; $i++) {
    $fib_next = $fib1 + $fib2; // Next Fibonacci number
    echo ", $fib_next";

    $fib1 = $fib2;
    $fib2 = $fib_next;
}
?>
</body>
</html>