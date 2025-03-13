<?php include 'header.php'; ?>
<?php include 'footer.php'; ?><br>
<!DOCTYPE html>
<html>
<head>    
    <meta charset="UTF-8">
    <title>Grade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #D9AFD9;
            background-image: linear-gradient(0deg, #97D9E1 0%,);
            color: white;
            padding-left: 1%;
            margin: auto;
        }
    </style>
</head>
<body>

<form method="post">
    <label><b>Enter Marks (Out of 100):</b></label>
    <input type="number" name="marks" min="0" max="100" required>
    <input type="submit" name="submit" value="Check Grade" style='background-color:#97D9E1;'>
</form>

<?php
if (isset($_POST["submit"])) {
    $marks = $_POST["marks"]; // Get user input

    if ($marks >= 90 && $marks <= 100) {
        $grade = "A+";
    } elseif ($marks >= 80 && $marks <= 89) {
        $grade = "A";
    } elseif ($marks >= 70 && $marks <= 79) {
        $grade = "B";
    } elseif ($marks >= 60 && $marks <= 69) {
        $grade = "C";
    } else {
        $grade = "FAIL";
    }

    echo "<h4>Your Grade: $grade</h4>";
}
?>

</body>
</html>