<?php

$start = 500;
$result =[];
$head = [
    'x' => $start,
    'y' => $start
];
$tail = [
    'x' => $start,
    'y' => $start
];
function checkTailNextToHead($headX, $headY, $tailX, $tailY) {
    $dx = $headX - $tailX;
    $dy = $headY - $tailY;
    if (abs($dx)<=1 && abs($dy)<=1) {
        return true;
    }
    return false;
}


if ($file = fopen("input.txt", "r")) {
    while(!feof($file)) {
        $line = trim(fgets($file));
        $arr = explode(" ", $line);

        for ($i=0; $i <$arr[1] ; $i++) {
            if ($arr[0]=='R') {
                $head['x'] += 1;
            } elseif ($arr[0]=='L') {
                $head['x'] -= 1;
            } elseif ($arr[0]=='U') {
                $head['y'] -= 1;
            } elseif ($arr[0]=='D') {
                $head['y'] += 1;
            }
            if (!checkTailNextToHead($head['x'], $head['y'], $tail['x'], $tail['y'])) {
                // not touched
                if (abs($head['x']-$tail['x'])==2) {
                    $tail['x'] = ($head['x'] + $tail['x'])/2;
                    $tail['y'] = $head['y'];
                } elseif (abs($head['y']-$tail['y'])==2) {
                    $tail['y'] = ($head['y'] + $tail['y'])/2;
                    $tail['x'] = $head['x'];
                }
                $result[] = $tail['x'] .'/' . $tail['y'];
            }
        }
    }
    fclose($file);
}


print_r(count(array_unique($result)));