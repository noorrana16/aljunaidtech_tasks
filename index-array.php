<?php include 'header.php'; ?>
<?php include 'footer.php'; ?><br>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Associative Array</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background: linear-gradient(140deg, rgba(3, 94, 139, .93), rgba(0, 203, 169, .73), rgba(0, 225, 80, .04)), linear-gradient(72deg, transparent, rgba(0, 225, 117, .64));

            color: white;
            padding-left: 2%;
            margin: auto;
        }
    </style>
</head><br>

<body>
    <?php
    //Indexed Array
    $array = [];
    for ($i = 0; $i < 10; $i++) {
        $array[] = rand(1, 100);
    }
    echo '<pre>';
    echo '<b>Orignal Array:</b><br>';
    print_r($array);

    $sum = array_sum($array);
    echo '<b>Sum of all numbers:' . $sum . '</b><br>';

    $array = array_unique($array);
    echo '<b>Array after removing duplicates:</b><br>';
    print_r($array);

    $max = max($array);
    $min = min($array);
    echo '<b>Maximum Value:' . $max . '</b><br>';
    echo '<b>Minimum Value:' . $min . '</b><br>';

    sort($array);
    echo '<b>Sorted Array:</b><br>';
    print_r($array);
    echo '</pre>';
    ?>
</body>

</html>