<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Task 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-success-subtle ">
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="#">PHP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="#">HTML</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light " href="#">CSS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light " href="#">Bootstrap</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Laravel</a></li>
                            <li><a class="dropdown-item" href="#">PHP</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-warning" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav><br>

    <body style="background-image: radial-gradient( circle farthest-corner at 10% 20%,  rgba(21,186,196,1)  0%, #e2db1f 54.2%, #ae10f9 100.3% );;">
        <?php

        //Task 2 OPERATORS
        echo "<h2 style='color: #c81d77; text-align:center'><i>
        <span style='font-size: 50px; color: #e2db1f;'>O</span>PERATORS</i></h2><br>";
        /*1. Arithmetic Operators*/
        $a = 10;
        $b = 5;
        echo "<div style='text-align:center'>";
        echo "<h3 style='color: #35518a'>Arithmetic Operators</h3><br>";
        echo "<pre>";
        echo "<b> Addition:</b> For a + b  The result is :" . ($a + $b) . "<br><br>";
        echo "<b> Subtraction:</b> For a - b The result is : " . ($a - $b) . "<br><br>";
        echo "<b> Multiplication:</b> For a * b The result is : " . ($a * $b) . "<br><br>";
        echo "<b> Exponentiation:</b> For a ** b The result is : " . ($a ** $b) . "<br><br>";
        echo "<b> Division:</b> For a / b The result is :" . ($a / $b) . "<br><br>";
        echo "<b> Modulus</b> For a % b The result is :" . ($a % $b) . "<br><hr>";
        echo "</pre></div>";

        /*2.Comparison Operators */
        $x = 10;
        $y = "10";
        echo "<div style='text-align:center'>";
        echo "<h3 style='color: #ed711e'>Comparison Operators</h3>";
        echo "<pre>";
        echo "<b> Equal:</b>";
        var_dump($x == $y);
        echo "<b> Not Equal:</b>";
        var_dump($x != $y);
        echo "<b> Not Equal:</b>";
        var_dump($x <> $y);
        echo "<b> Identical:</b>";
        var_dump($x === $y);
        echo "<b> Not Identical:</b>";
        var_dump($x !== $y);
        echo "<b> Greater than:</b>";
        var_dump($x > $y);
        echo "<b> Less than:</b>";
        var_dump($x < $y);
        echo "<b> Greater than or equal to:</b>";
        var_dump($x >= $y);
        echo "<b> Less than or equal to:</b>";
        var_dump($x <= $y);
        echo "<b> Spaceship:</b>";
        var_dump($x <=> $y);
        echo "</pre><hr></div>";
        /*3.Assignment Operators */
        $x = 10;
        $y = 20;
        echo "<div style='text-align:center'>";
        echo "<h3 style='color: #1c90bf'>Assigment Operators</h3>";
        echo "<pre>";
        $x += 9;
        echo 'The Value is += : ' . $x . "<br>";
        $y -= 8;
        echo 'The Value is -= : ' . $y . "<br>";
        $x *= 7;
        echo 'The Value is *= : ' . $x . "<br>";
        $y /= 5;
        echo 'The Value is /= : ' . $y . "<br>";
        $x %= 4;
        echo 'The Value is %= : ' . $x . "<br><hr>";
        echo "</pre></div>";

        /*4. Logocal Operators*/
        $Boolean1 = true;
        $Boolean2 = false;
        echo "<div style='text-align:center'>";
        echo "<h3 style='color:#091970'>Logical Operators</h3><br>";
        echo "<pre>";
        echo "<b>Boolean AND</b> (true && false): ";
        var_dump($Boolean1 && $Boolean2);
        echo "<b>Boolean OR</b>  (true || false): ";
        var_dump($Boolean1 || $Boolean2);
        echo "<b> Boolean NOT</b> (!true): ";
        var_dump(!$Boolean1) . "<br>";
        echo "<b> Boolean XOR</b> (true XOR false): ";
        var_dump($Boolean1 xor $Boolean2) . "<br><hr>";
        echo "</pre></div>";
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>

</html>