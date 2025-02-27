<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    //Task1
    //Personal-Info
    public function showInfo()
    {
        $personalInfo = [
            'Name' => 'Noreen',
            'Gender' => 'Female',
            'Age' => 23,
            'DOB' => '16/08/2025',
            'Degree' => 'BS in Software Engineering',
            'Address' => 'Green Town, Pakpattan',
        ];
        return view('MyInfo', compact('personalInfo'));
    }
    //Swap-values
    public function swapValues()
    {
        $a = 10;
        $b = 30;
        $before = compact('a', 'b');

        $temp = $a;
        $a = $b;
        $b = $temp;

        $after = compact('a', 'b');

        return view('swap-values', compact('before', 'after'));
    }
    //Data-Types
    public function showdatatypes()
    {
        $data = [
            'Integer' => 80,
            'String' => 'Noreen',
            'Boolean' => True,
            'Array' => ['English', 'Computer', 'Maths'],
            'Object' => (object) ['name' => 'Noor', 'Degree' => 'BSSE']
        ];
        return view('data-types', compact('data'));
    }


    //Task 2:
    //Arthmetic-Operators
    public function Arithmetic()
    {
        $num1 = 15;
        $num2 = 10;
        $results = [
            'Addition' => $num1 + $num2,
            'Subtraction' => $num1 - $num2,
            'Multiplication' => $num1 * $num2,
            'Division' => $num1 / $num2,
            'Modulus' => $num1 % $num2
        ];
        return view('Arithmetic', compact('results'));
    }
    // Assignment-Operators
    public function operate()
    {
        $num = 10;
        $before = $num;
        $operations = [];
        $operations['+= 5'] = $num += 5;
        $operations['-= 3'] = $num -= 3;
        $operations['*= 2'] = $num *= 2;
        $operations['/= 4'] = $num /= 4;
        $operations['%= 3'] = $num %= 3;
        return view('Assignment', compact('before', 'operations'));
    }

    // Logical-Operators
    public function logical()
    {
        $Bool1 = True;
        $Bool2 = False;

        $ResultAND = $Bool1 && $Bool2;
        $ResultOR = $Bool1 || $Bool2;
        $notBool1 = !$Bool1;
        $notBool2 = !$Bool2;

        return view('Logical', compact('Bool1', 'Bool2', 'ResultAND', 'ResultOR', 'notBool1', 'notBool2'));
    }

}
