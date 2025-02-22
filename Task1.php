<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Task 1</title>
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
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav><br>

    <body style="background-image: radial-gradient( circle farthest-corner at 10% 20%,  rgba(253,239,132,1) 0%, rgba(247,198,169,1) 54.2%, rgba(21,186,196,1) 100.3% );;">
        <?php
        //Task1:
        //Personal Information
        $name = "My name is Noreen";
        $gender = "My gender is Female";
        $age = "My age is 23";
        $degree = "My Degree is BSSE";
        $address = "Green Town, Pakpattan";
        $DOB = "16/08/2025";

        echo "<div style='text-align:center'>";
        echo "<h3 style='color:#F6358A'>Personal Info</h3>";
        echo "<b>Name:</b> $name<br>";
        echo "<b>Gender:</b> $gender<br>";
        echo "<b>Age:</b>$age<br>";
        echo "<b>Degree:</b>$degree<br>";
        echo "<b>Address:</b> $address<br>";
        echo "<b>DOB:</b> $DOB<br>";
        echo "<hr></div>";

        //2.Variable Juggling - Swapping two numbers 
        //swapping logic
        $num1 = 10;
        $num2 = 15;
        echo "<div style='text-align:center'>";
        echo "<h3 style='color:#F6358A'>Variable Juggling</h3>";
        echo "<b>Before Swapping:</b>";
        echo " a =" . $num1 . " b = " . $num2 . " <br>";
        $temp = $num1;
        $num1 = $num2;
        $num2 = $temp;
        echo "<b>After Swapping:</b>";
        echo " a =" . $num1 . " b = " . $num2 . " ";
        echo "<hr></div>";
        //3.Data Types
        echo "<div style='text-align:center'>";
        echo "<h3 style='color:#F6358A'>Data Types</h3>";
        $strVar = "Al-Junaid Tech";
        $intVar = 60;
        $floatVar = 3.14;
        $boolVar = True;
        $nullVar = Null;
        $arrVar = ["Python", "PHP", "Laravel"];
        echo "<pre>";
        echo "<strong>String:</strong>"; var_dump($strVar);
        echo "<strong>Integer:</strong>"; var_dump($intVar);
        echo "<strong>Float:</strong>"; var_dump($floatVar);
        echo "<strong>Boolean:</strong>"; var_dump($boolVar);
        echo "<strong>Null:</strong>";
        echo gettype($nullVar) . "<br>";
        echo "<strong>Array:</strong>";var_dump($arrVar);
        echo "</pre><hr></div>";
        
        //Task 2 OPERATORS
        echo "<h1 style='color: #008080; text-align:center'><i>OPERATORS</i></h1><br>";
        /*1. Arithmetic Operators*/
        $a = 10;
        $b = 5;
        echo "<div style='text-align:center'>";
        echo "<h3 style='color:black'>Arithmetic Operators</h3><br>";
        echo "<pre>";
        echo "<b> Addition:</b> For a + b  The result is :" . ($a + $b) . "<br><br>";
        echo "<b> Subtraction:</b> For a - b The result is : " . ($a - $b) . "<br><br>";
        echo "<b> Multiplication:</b> For a * b The result is : " . ($a * $b) . "<br><br>";
        echo "<b> Exponentiation:</b> For a ** b The result is : " . ($a ** $b) . "<br><br>";
        echo "<b> Division:</b> For a / b The result is :" . ($a / $b) . "<br><br>";
        echo "<b> Modulus</b> For a % b The result is :" . ($a % $b) . "<br><hr>";
        echo "</pre></div>";

        /*2.Comparison Operators */
        $c = 10;
        $d = "10";
        echo "<div style='text-align:center'>";
        echo "<h3 style='color:black'>Comparison Operators</h3>";
        echo "<pre>";
        echo "<b> Equal:</b>"; var_dump($a == $b);
        echo "<b> Not Equal:</b>"; var_dump($a != $b);
        echo "<b> Not Equal:</b>"; var_dump($a <> $b);
        echo "<b> Identical:</b>"; var_dump($a === $b);
        echo "<b> Not Identical:</b>"; var_dump($a !== $b);
        echo "<b> Greater than:</b>"; var_dump($a > $b);
        echo "<b> Less than:</b>"; var_dump($a < $b);
        echo "<b> Greater than or equal to:</b>"; var_dump($a >= $b);
        echo "<b> Less than or equal to:</b>"; var_dump($a <= $b);
        echo "<b> Spaceship:</b>"; var_dump($a <=> $b);
        echo "</pre><hr></div>";
        /*3.Assignment Operators */
        $n = 10;
        echo "<div style='text-align:center'>";
        echo "<h3 style='color:black'>Assigment Operators</h3>";
        echo "<pre>";
        echo 'The Initial Value is : ' . $n . "<br>";
        $n += 9;
        echo 'The Value is += : ' . $n . "<br>";
        $n -= 8;
        echo 'The Value is -= : ' . $n . "<br>";
        $n *= 7;
        echo 'The Value is *= : ' . $n . "<br>";
        $n /= 5;
        echo 'The Value is /= : ' . $n . "<br>";
        $n %= 4;
        echo 'The Value is %= : ' . $n . "<br><hr>";
        echo "</pre></div>";

        /*4. Logocal Operators if,else operator*/
        $bool1 = true;
        $bool2 = false;
        echo "<div style='text-align:center'>";
        echo "<h3 class='text-dark'>Logical Operators</h3><br>";
        echo "<pre>";
        echo "<b>AND</b> (true && false): ";
        var_dump($bool1 && $bool2);
        echo "<b>OR</b>  (true || false): ";
        var_dump($bool1 || $bool2);
        echo "<b>NOT</b> (!true): ";
        var_dump(!$bool1) . "<br>";
        echo "<b>XOR</b> (true XOR false): ";
        var_dump($bool1 xor $bool2) . "<br><hr>";
        echo "</pre></div>";
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>

</html>