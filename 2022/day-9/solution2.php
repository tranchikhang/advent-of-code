<?php

$startX = 12;
$startY = 15;
$length = 30;
$result =[];
$head = [
    'x' => $startX,
    'y' => $startY
];
$tails = [];

$knotCount=9;
for ($i=0; $i <$knotCount ; $i++) {
    $tails[] = [
        'x' => $startX,
        'y' => $startY
    ];
}

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

        // loop through each step
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
            for ($j=0; $j <count($tails) ; $j++) {
                if ($j>0) {
                    $tempHead = $tails[$j-1];
                } else {
                    $tempHead = $head;
                }
                $tail = &$tails[$j];
                if (!checkTailNextToHead($tempHead['x'], $tempHead['y'], $tail['x'], $tail['y'])) {
                    // not touched
                    if (abs($tempHead['x']-$tail['x'])>1 && abs($tempHead['y']-$tail['y'])==0) {
                        $tail['x'] += $tempHead['x'] > $tail['x']? 1 : -1;
                    } elseif (abs($tempHead['y']-$tail['y'])>1 && abs($tempHead['x']-$tail['x'])==0) {
                        $tail['y'] += $tempHead['y'] > $tail['y']? 1 : -1;
                    } else {
                        $tail['x'] += $tempHead['x'] > $tail['x']? 1 : -1;
                        $tail['y'] += $tempHead['y'] > $tail['y']? 1 : -1;
                    }
                    if ($j==(count($tails)-1)) {
                        $result[] = $tail['x'] .'/' . $tail['y'];
                    }
                }
            }
        }
    }
    fclose($file);
}

function draw($result) {
    global $length;
    for ($i=0; $i < $length ; $i++) {
        for ($j=0; $j <$length ; $j++) {
            $str = $j . "/" . $i;
            if (in_array($str, $result)) {
                echo '#';
            } else  {
                echo ' . ';
            }
        }
        echo '<br>';
    }
}

print_r(count(array_unique($result)) + 1);
echo "<br>";
draw($result);

