<?php

$total = 0;

function getValue($param) {
    switch ($param) {
        case 'X':
            return 1;
            break;
        case 'Y':
            return 2;
            break;
        case 'Z':
            return 3;
            break;
    }
}

function doCompare($left, $right) {
    if ($left=='A') {
        if ($right=='X') {
            return 3;
        } elseif ($right=='Y') {
            return 6;
        }
        return 0;
    } elseif ($left=='B') {
        if ($right=='X') {
            return 0;
        } elseif ($right=='Y') {
            return 3;
        }
        return 6;
    } elseif ($left=='C') {
        if ($right=='X') {
            return 6;
        } elseif ($right=='Y') {
            return 0;
        }
        return 3;
    }
}

if ($file = fopen("input.txt", "r")) {
    while(!feof($file)) {
        $textperline = trim(fgets($file));
        $arr = explode(" ", $textperline);
        $total += doCompare($arr[0], $arr[1]) + getValue($arr[1]);


     }
    fclose($file);
}
echo $total;