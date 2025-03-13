<!-- header.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<header>
<nav class="navbar navbar-expand-md bg-secondry border-bottom border-body">
  <div class="container-fluid">
    <a class="navbar-brand text-light" href="#">PHP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Arrays
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index-array.php">Index-Array</a></li>
            <li><a class="dropdown-item" href="AA.php">Associative Array</a></li>
            <li><a class="dropdown-item" href="books.php">Multidimensional Array</a></li>
            <li><hr class="dropdown-divider"></li>
          </ul>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Loops
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="students.php">Student marks</a></li>
            <li><a class="dropdown-item" href="fibonacci.php">Fibonacci series</a></li>
            <li><a class="dropdown-item" href="table.php">Muli-Tables</a></li>
            <li><a class="dropdown-item" href="grade.php">Grades</a></li>
            <li><hr class="dropdown-divider"></li>
          </ul>
        <li class="nav-item">
          <a class="nav-link text-light" href="paragraph.php">Paragraph</a>
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
</nav>
</header>