<?php

/**
    0   3   6
---------------
    X   Y   Z
A   3   4   8
B   1   5   9
C   2   6   7

 */

$val = [
    'A' => [3, 4 ,8],
    'B' => [1, 5, 9],
    'C' => [2, 6, 7]
];
$total = 0;

function getValue($param) {
    switch ($param) {
        case 'X':
            return 0;
            break;
        case 'Y':
            return 1;
            break;
        case 'Z':
            return 2;
            break;
    }
}

if ($file = fopen("input.txt", "r")) {
    while(!feof($file)) {
        $textperline = trim(fgets($file));
        $arr = explode(" ", $textperline);
        $total += $val[$arr[0]][getValue($arr[1])];
     }
    fclose($file);
}
echo $total;