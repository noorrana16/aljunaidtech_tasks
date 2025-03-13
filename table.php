<?php include 'header.php'; ?>
<?php include 'footer.php'; ?><br>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Multiplication Tables</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #D9AFD9;
            background-image: linear-gradient(0deg, #97D9E1 0%, #D9AFD9 100%);
            color: white;
            padding-left: 2%;
        }
    </style>
</head>
<body>

<form method="post">
    <labe><b>Enter a Number:</b></label>
    <input type="number" name="number" required>
    <input type="submit" name="submit" value="Generate Table" style='background-color:#97D9E1;'>
</form><br><br>

<?php
if (isset($_POST["submit"])) {
    $n = $_POST["number"]; // Get user input
    //Multiplication Table
    echo "<h4>Multiplication Table of $n</h4>";
    echo "<table border='1' cellpadding='20' style='background-color:#97D9E1;'>";
    
    $i = 1;
    while ($i <= 10) {
        echo "<tr><td>$n × $i = " . ($n * $i) . "</td></tr>";
        $i++;
    }

    echo "</table>";
}
?>

</body>
</html>