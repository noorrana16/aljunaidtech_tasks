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
                    <button class="btn btn-outline-danger" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav><br>

    <body style="background-color: #FFC0CB;
            background-image:
                linear-gradient(62deg, #FF69B4 1%, #7FFF00 100%);">
        <?php
        //Task1:
        //Personal Information
        $name = "My name is Noreen";
        $gender = "My gender is Female";
        $age = "23 Years Old";
        $degree = "BS in Software Engineering";
        $address = "Green Town, Pakpattan";
        $DOB = "16/08/2025";

        echo "<div style='text-align:center'>";
        echo "<h3 style='color:#F6358A'>Personal Info</h3>";
        echo "<b>Name:</b> $name<br>";
        echo "<b>Gender:</b> $gender<br>";
        echo "<b>Age:</b>$age<br>";
        echo "<b>Degree:</b>$degree<br>";
        echo "<b>Address:</b> $address<br>";
        echo "<b>Date of Birth:</b> $DOB<br>";
        echo "<hr></div>";

        //2.Variable Juggling
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
        echo"<strong style='color:#091970'>Using gettype()</strong><br>";
        $strVar = "Pakistan";
        $intVar = 60;
        $floatVar = 3.14;
        $boolVar = True;
        $nullVar = Null;
        $arrVar = ["Python", "PHP", "Laravel"];

        echo "<strong>String:</strong>Type-"; echo gettype($strVar) . "<br>";
        echo "<strong>Integer:</strong>Type-"; echo gettype($intVar) . "<br>";
        echo "<strong>Float: </strong>Type-"; echo gettype($floatVar) . "<br>";
        echo "<strong>Boolean: </strong>Type-"; echo gettype($boolVar). "<br>";
        echo "<strong>Null: </strong>Type-"; echo gettype($nullVar) . "<br>";
        echo "<strong>Array: </strong>Type-"; echo gettype($arrVar) . "<br><br>";
        echo"<strong style='color:#091970'>Using var_dump()</strong>";

        $strVar = "Pakistan";
        $intVar = 80;
        $floatVar = 3.14;
        $boolVar = True;
        $nullVar = Null;
        $arrVar = ["Python", "PHP", "Laravel"];

        echo "<pre>";
        echo "<strong>String:</strong>";
        var_dump($strVar);
        echo "<strong>Integer:</strong>";
        var_dump($intVar);
        echo "<strong>Float:</strong>";
        var_dump($floatVar);
        echo "<strong>Boolean:</strong>";
        var_dump($boolVar);
        echo "<strong>Null:</strong>";
        var_dump($nullVar) . "<br>";
        echo "<strong>Array:</strong>";
        var_dump($arrVar);
        echo "</pre><hr></div>";
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>

</html>