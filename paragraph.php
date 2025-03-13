<?php include 'header.php'; ?>
<?php include 'footer.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Paragraph</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #97D9E1;
            background-image: linear-gradient(0deg, #97D9E1 0%);
            color: white;
            padding-left: 2%;
            margin: auto;
        }
        textarea{
            background-color:#D9AFD9;
        }
    </style>
</head>

<body>
<form action="paragraph.php" method="post">
    <label for="paragraph"><strong>Enter a paragraph (at least 500 words):</strong></label><br><br>
    <textarea id="paragraph" name="paragraph" rows="10" cols="100" required></textarea><br>
    <button type="submit" class=" btn bg-success-subtle text-success-emphasis">Submit</button>
    </form><br>
<?php
// Function to count the total number of words in a paragraph
function countWords($paragraph)
{
    return str_word_count($paragraph);
}

// Function to find and display the most repeated word in a paragraph
function mostRepeatedWord($paragraph)
{
    $words = str_word_count(strtolower($paragraph), 1);
    $wordFrequency = array_count_values($words);
    arsort($wordFrequency);
    return array_key_first($wordFrequency);
}

// Function to display the first and last word in a paragraph
function firstAndLastWord($paragraph)
{
    $words = explode(' ', $paragraph);
    return [
        'first' => reset($words),
        'last' => end($words)
    ];
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paragraph = $_POST['paragraph'];

    // Ensure the paragraph is at least 500 words
    if (countWords($paragraph) < 500) {
        echo "The paragraph must contain at least 500 words.<br>";
        exit;
    }

    // Count the total number of words
    $totalWords = countWords($paragraph);
    echo "Total number of words: <b>$totalWords</b><br>";

    // Find and display the most repeated word
    $mostRepeated = mostRepeatedWord($paragraph);
    echo "Most repeated word: <b>$mostRepeated</b><br>";

    // Display the first and last word in the paragraph
    $firstLastWords = firstAndLastWord($paragraph);
    echo "First word:<b> " . $firstLastWords['first'] . "</b><br>";
    echo "Last word: <b>" . $firstLastWords['last'] . "</b><br>";
}
?>
</body>

</html>