<?php

$x = 1;
$current = 1;

function isCycleCompleted($current, $x) {
    switch ($current) {
        case 20:
        return $x*20;
        break;
        case 60:
        return $x*60;
        break;
        case 100:
        return $x*100;
        break;
        case 140:
        return $x*140;
        break;
        case 180:
        return $x*180;
        break;
        case 180:
        return $x*180;
        break;
        case 220:
        return $x*220;
        break;
        default:
        return 0;
        break;
    }
    return 0;
}
$total = 0;

if ($file = fopen("input.txt", "r")) {
    while(!feof($file)) {
        $line = trim(fgets($file));
        $arr = explode(" ", $line);


        $current++;
        if ($arr[0]=='addx') {
            if (isCycleCompleted($current, $x)) {
                echo 'at cycle: ' . $current . ' x= ' . $x . '<br>';
                $total += isCycleCompleted($current, $x);
            }
            $x += $arr[1];
            $current++;
        }
        if (isCycleCompleted($current, $x)) {
            echo 'at cycle: ' . $current . ' x= ' . $x . '<br>';
            $total += isCycleCompleted($current, $x);
        }

    }
    fclose($file);
}

echo $total;