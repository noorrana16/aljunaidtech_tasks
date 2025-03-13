<?php include 'header.php'; ?>
<?php include 'footer.php'; ?><br>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Associative Array Loop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color: darkcyan;
            color: white;
            padding-left: 2%;
            margin: auto;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Student Marks List</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-success">
                <tr>
                    <th>Student Name</th>
                    <th>Marks (Out of 100)</th>
                </tr>
            </thead>
            <tbody>

                <?php
                // Associative array: Student names as keys and marks as values
                $students = [
                    "Osama" => 92,
                    "Ahmed" => 85,
                    "Bilal" => 76,
                    "Hira" => 68,
                    "Zain" => 45
                ];
                // Finding the student with the highest marks
                $highestMarks = max($students);
                $topStudent = array_keys($students, $highestMarks)[0];
                ?>
                <?php foreach ($students as $name => $marks): ?>
                    <tr>
                        <td><?= htmlspecialchars($name); ?></td>
                        <td>
                            <?php
                            if ($marks < 50) {
                                echo "<b style='color:red;'>$marks (Fail)</b>";
                            } elseif ($marks == $highestMarks) {
                                echo "<b style='color:green;'>$marks (Topper)</b>";
                            } else {
                                echo $marks;
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
        <!-- Display Highest Scorer -->
        <h5 class="mt-4 text-light">Highest Scorer: <?= htmlspecialchars($topStudent); ?> (<?= $highestMarks; ?> Marks)</h5>

        <!-- Display Students Who Scored Less Than 50 -->
        <h5 class="mt-3 text-danger-emphasis">Students Who Failed:</h5>
        <ul>
            <?php
            foreach ($students as $name => $marks) {
                if ($marks < 50) {
                    echo "<li>$name ($marks Marks)</li>";
                }
            }
            ?>
        </ul>

    </div>
</body>

</html>
