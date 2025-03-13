<?php include 'header.php'; ?>
<?php include 'footer.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Associative Array</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #3EECAC;
            background-image: linear-gradient(19deg, #3EECAC 0%, #EE74E1 100%);

            color: white;
            padding-left: 2%;
            margin: auto;
        }
    </style>
</head><br>

<body>
    <?php
    //Associative Array
    $employees = [
        'Ahmed' => 90000,
        'Osama' => 80000,
        'Hamza' => 70000,
        'Talha' => 60000,
        'Bilal' => 50000,
    ];
    echo '<pre>';
    echo '<b>Orignal Employees Array:</b><br>';
    print_r($employees);
    //Ascending Order
    asort($employees);
    echo '<b>Employees sorted by Salary Ascending Order:</b><br>';
    print_r($employees);
    //Descending Order
    krsort($employees);
    echo '<b>Employees sorted by Name Descending Order:</b><br>';
    print_r($employees);
    //Highest Salary
    $highestEmployee = array_keys($employees, max($employees))[0];
    $highestSalary = max($employees);
    echo '<b>Employee with the Highest Salary </b>';
    echo'<b Style="color:teal";>'. $highestEmployee .':'. $highestSalary . '</b>';
    echo '</pre>';
    ?>
    
</body>

</html>