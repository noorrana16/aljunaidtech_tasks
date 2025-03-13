<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArrayController extends Controller
{
    //Task1-Part1
    public function indexedArray()
    {
        //Generate an indexed array
        $numbers = array_map(fn() => rand(1, 100), range(1, 10));
        //Find the Sum
        $sum = array_sum($numbers);
        //Remove Duplicates
        $uniqueNumbers = array_unique($numbers);
        //Find Maximum and Minimum Values
        $maxValue = max($uniqueNumbers);
        $minValue = min($uniqueNumbers);
        //Sort in Ascending Order
        sort($uniqueNumbers);
        return response()->json([
            'original_numbers' => $numbers,
            'sum' => $sum,
            'unique_numbers' => array_values($uniqueNumbers),
            'max_value' => $maxValue,
            'min_value' => $minValue,
            'sorted_numbers' => $uniqueNumbers
        ]);
    }
    //Task1-Part2
    public function Employees()
    {
        //Associative Array
        $employees = [
            'Ahmed' => 70000,
            'Osama' => 80000,
            'Hamza' => 90000,
            'Talha' => 65000,
            'Bilal' => 60000,
        ];
        //Ascending Order
        asort($employees);
        //Descending Order
        krsort($employees);
        //Find Employee with Highest Salary
        $highestEmployee = array_keys($employees, max($employees))[0];
        $highestSalary = max($employees);

        return response()->json([
            'sorted_by_salary' => $employees,
            'sorted_by_name_desc' => $highestEmployee,
            'highest_salary' => $highestSalary
        ]);
    }

    //Task1-Part3
    public function showBooks()
    {

        //Multidimensional Array
        $books = [
            [
                'title' => 'The Alchemist',
                'author' => 'Paulo Coelho',
                'price' => 599
            ],
            [
                'title' => 'The Power of Now',
                'author' => 'Eckhart Tolle',
                'price' => 400
            ],
            [
                'title' => 'Harry Potter',
                'author' => 'J.K.Rowling',
                'price' => 3800
            ],
        ];
        // Update the price of the Second Book
        $books[1]['price'] = 500;
        return response()->json(['books' => $books] );
    }
    //Task2-Part1: Loops
    //Associative Array
    public function Students()
    {
        $students = [
            'Noor' => 90,
            'Ayesha' => 85,
            'Hassan' => 78,
            'Fatima' => 49,
            'Ali' => 37,
        ];
        //Foreach Loop to display each student's names and marks
        $studentDetails = [];
        foreach ($students as $name => $marks) {
            $studentDetails[] = "$name scored $marks marks";
        }
        //Find student with the highest marks.
        $highestMarks = max($students);
        $topper = array_search($highestMarks, $students);

        //Identify students who scored less than 50.
        $failedStudents = [];
        foreach ($students as $name => $marks) {
            if ($marks < 50) {
                $failedStudents[] = $name;
            }
        }
        return response()->json([
            'student_details' => $studentDetails,
            'highest_scorer' => $topper,
            'highest_marks' => $highestMarks,
            'failed_students' => $failedStudents
        ]);
    }
    //Task2-Part2: Fibonacci Series
    public function fibonacciSeries()
    {
        $n = 10;
        $fibonacci = [0, 1];
        for ($i = 2; $i < $n; $i++) {
            $fibonacci[] = $fibonacci[$i - 1] + $fibonacci[$i - 2];
        }
        return response()->json([
            'fibonacci_series' => $fibonacci
        ]);
    }
    //Task2-Part3
    // Show the form to the user
    public function showTable()
    {
        return view('multi-table');
    }

    // Generate the multiplication table
    public function generateTable(Request $request)
    {
        $number = $request->input('number');

        if ($number < 1) {
            return redirect('/multi-table')->with('error', 'Please enter a positive number.');
        }

        // Generate multiplication table using while loop
        $i = 1;
        $table = [];
        while ($i <= 10) {
            $table[] = "$number x $i = " . ($number * $i);
            $i++;
        }
        return view('multi-table', compact('number','table'));
    }
    //Task3-Part1
    // Show the form to the user
    public function showGrade()
    {
        return view('grade-form');
    }

    // Assign the grade based on the marks
    public function assignGrade(Request $request)
    {
        $marks = $request->input('marks');
        $grade = '';

        if ($marks >= 90 && $marks <= 100) {
            $grade = 'A+';
        } elseif ($marks >= 80 && $marks <= 89) {
            $grade = 'A';
        } elseif ($marks >= 70 && $marks <= 79) {
            $grade = 'B';
        } elseif ($marks >= 60 && $marks <= 69) {
            $grade = 'C';
        } elseif ($marks < 60) {
            $grade = 'FAIL';
        }

        return view('grade', compact('marks', 'grade'));
    }


    //Task3-Part2
    public function showForm()
    {
        return view('paragraph-form');
    }

    // Process the submitted paragraph
    public function Paragraph(Request $request)
    {
        $paragraph = $request->input('paragraph');

        // Count the total number of words
        $wordCount = str_word_count($paragraph);

        //The paragraph is at least 500 words
        if ($wordCount < 500) {
            return back()->with('error', 'The paragraph must contain at least 500 words.');
        }

        // Find the most repeated word
        $words = str_word_count(strtolower($paragraph), 1);
        $wordFrequency = array_count_values($words);
        arsort($wordFrequency);
        $mostRepeatedWord = array_key_first($wordFrequency);

        // Find the first and last word
        $wordList = explode(' ', $paragraph);
        $firstWord = reset($wordList);
        $lastWord = end($wordList);

        return view('paragraph', compact('wordCount', 'mostRepeatedWord', 'firstWord', 'lastWord'));
    }
}
